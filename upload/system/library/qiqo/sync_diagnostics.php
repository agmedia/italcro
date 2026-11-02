<?php

/** Private incident history and opt-in alerts. Never stores raw ERP/customer rows. */
final class QiqoSyncDiagnostics
{
    /**
     * Record an outcome even when email is disabled. A notification is sent only
     * for a new/changed incident, and retried after an unsuccessful mail attempt.
     * The injected sender is for tests; production uses configured OpenCart Mail.
     */
    public static function observe(string $directory, string $task, array $result, $config = null, ?callable $sender = null): array
    {
        if (!preg_match('/^[a-z_]{1,32}$/', $task)) throw new InvalidArgumentException('Invalid diagnostic task.');
        if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
            throw new RuntimeException('Cannot create diagnostic directory.');
        }
        @chmod($directory, 0700);
        $lock = fopen($directory . '/alerts.lock', 'c');
        if (!$lock || !flock($lock, LOCK_EX)) throw new RuntimeException('Cannot lock diagnostic state.');
        @chmod($directory . '/alerts.lock', 0600);
        try {
            $path = $directory . '/alerts-state.json';
            $state = is_file($path) ? json_decode((string)file_get_contents($path), true) : [];
            if (!is_array($state)) $state = [];
            if (!isset($state['tasks']) || !is_array($state['tasks'])) $state['tasks'] = [];
            if (!isset($state['notified']) || !is_array($state['notified'])) $state['notified'] = [];
            $incidents = self::incidents($task, $result);
            $state['tasks'][$task] = ['status' => empty($result['success']) ? 'failure' : ($incidents ? 'warning' : 'success'),
                'checked_at' => gmdate('c'), 'incidents' => $incidents];

            // The action feed is also imported by the partners task. Share its
            // incident identity so these jobs do not email the same discrepancy.
            $active = [];
            foreach ($state['tasks'] as $outcome) {
                foreach (($outcome['incidents'] ?? []) as $id => $incident) $active[$id] = true;
            }
            foreach (array_keys($state['notified']) as $id) {
                if (!isset($active[$id])) unset($state['notified'][$id]);
            }

            $email = $config ? trim((string)$config->get('qiqo_alert_email')) : '';
            $enabled = (bool)filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/[\r\n]/', $email);
            $pending = [];
            foreach ($incidents as $id => $incident) {
                $fingerprint = hash('sha256', json_encode($incident));
                $recipient = hash('sha256', strtolower($email));
                if (($state['notified'][$id]['fingerprint'] ?? '') !== $fingerprint
                    || ($state['notified'][$id]['recipient'] ?? '') !== $recipient) {
                    $pending[$id] = $incident;
                }
            }
            $notification = ['enabled' => $enabled, 'sent' => false, 'pending_incidents' => count($pending)];
            if ($enabled && $pending) {
                try {
                    $subject = '[Italcro ERP] ' . (empty($result['success']) ? 'Neuspjelo ažuriranje' : 'Nepravilnost u podacima');
                    $body = self::message($task, $pending);
                    if ($sender) {
                        if ($sender($email, $subject, $body) === false) throw new RuntimeException('Mail was not accepted.');
                    } else {
                        self::sendMail($config, $email, $subject, $body);
                    }
                    foreach ($pending as $id => $incident) {
                        $state['notified'][$id] = ['fingerprint' => hash('sha256', json_encode($incident)),
                            'recipient' => $recipient, 'sent_at' => gmdate('c')];
                    }
                    $notification['sent'] = true;
                    $notification['pending_incidents'] = 0;
                } catch (Throwable $error) {
                    // An unavailable mail server must not fail a successful import
                    // or leak SMTP credentials through the HTTP cron response.
                    $notification['error'] = 'mail_failed';
                }
            }
            $state['tasks'][$task]['notification'] = $notification;
            $encoded = json_encode($state, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $temporary = tempnam($directory, '.alerts-');
            if ($temporary === false || $encoded === false || file_put_contents($temporary, $encoded, LOCK_EX) === false) {
                if ($temporary) @unlink($temporary);
                throw new RuntimeException('Cannot write diagnostic state.');
            }
            @chmod($temporary, 0600);
            if (!rename($temporary, $path)) {
                @unlink($temporary);
                throw new RuntimeException('Cannot replace diagnostic state.');
            }
            return ['status' => $state['tasks'][$task]['status'], 'notification' => $notification];
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }

    private static function incidents(string $task, array $result): array
    {
        $incidents = [];
        if (empty($result['success'])) {
            $reason = in_array(($result['error'] ?? ''), [
                'erp_fetch_failed', 'catalog_snapshot_empty', 'catalog_snapshot_too_small',
                'catalog_deactivation_limit', 'catalog_snapshot_not_confirmed', 'catalog_snapshot_date_required',
                'invalid_catalog_snapshot_policy', 'missing_catalog_name', 'catalog_sync_failed',
                'catalog_cycle_failed', 'catalog_cycle_interrupted', 'catalog_preview_failed', 'catalog_apply_failed',
                'maintenance_backup_required', 'sync_busy',
            ], true) ? $result['error'] : 'sync_failed';
            // A site held closed is a new, actionable incident after an earlier
            // feed/preflight failure. Subsequent review-required cycles refer to
            // that same incident even if their outer error/phase differs.
            $held = !empty($result['maintenance_held']);
            $incidents['failure:' . $task] = ['code' => 'sync_failed', 'task' => $task,
                'reason' => $held ? 'maintenance_review_required' : $reason, 'maintenance_held' => $held];
        }
        foreach (($result['warnings'] ?? []) as $warning) {
            if (!is_array($warning)) continue;
            $code = $warning['code'] ?? '';
            if (!in_array($code, ['duplicate_action_net_price', 'deferred_catalog_name'], true)) continue;
            $article = trim((string)($warning['article'] ?? ''));
            if ($article === '' || strlen($article) > 64 || preg_match('/[\x00-\x1F\x7F]/', $article)) continue;
            if ($code === 'deferred_catalog_name') {
                if ($task !== 'catalog') continue;
                $incidents['catalog_name:' . hash('sha256', $article)] = ['code' => $code, 'article' => $article];
                continue;
            }
            $quantity = $warning['quantity'] ?? null;
            $prices = $warning['prices'] ?? null;
            if (!is_numeric($quantity) || !is_finite((float)$quantity) || (float)$quantity < 0
                || (float)$quantity > 99999999999.9999 || !is_array($prices)) continue;
            $values = [];
            foreach ($prices as $price) {
                if (!is_numeric($price) || !is_finite((float)$price) || $price <= 0 || $price > 99999999.9999999) continue;
                $values[number_format((float)$price, 7, '.', '')] = round((float)$price, 7);
            }
            $values = array_values($values);
            sort($values, SORT_NUMERIC);
            if (count($values) < 2) continue;
            $incident = ['code' => 'duplicate_action_net_price', 'article' => $article, 'indicator' => 'C',
                'quantity' => round((float)$quantity, 4), 'prices' => $values, 'selected_price' => $values[0]];
            $id = 'action_net:' . hash('sha256', $article . '|' . number_format((float)$quantity, 4, '.', ''));
            $incidents[$id] = $incident;
        }
        ksort($incidents, SORT_STRING);
        return $incidents;
    }

    private static function message(string $task, array $incidents): string
    {
        $lines = ['Automatska provjera ERP ažuriranja.', 'Postupak: ' . $task, 'Vrijeme (UTC): ' . gmdate('c'), ''];
        foreach ($incidents as $incident) {
            if ($incident['code'] === 'sync_failed') {
                $lines[] = 'Ažuriranje nije uspješno dovršeno. Provjerite privatni zapis postupka i odgovor ERP-a.';
                $lines[] = 'Razlog: ' . $incident['reason'] . '.';
                if ($incident['maintenance_held']) {
                    $lines[] = 'Webshop je zadržan u načinu održavanja zbog nepotvrđenog ishoda ažuriranja. Potreban je pregled prije ponovnog otvaranja.';
                }
            } elseif ($incident['code'] === 'duplicate_action_net_price') {
                $format = static function ($value) { return rtrim(rtrim(number_format($value, 7, '.', ''), '0'), '.'); };
                $lines[] = 'Artikl ' . $incident['article'] . ', C, količina ' . $format($incident['quantity'])
                    . ': ERP vraća različite neto cijene ' . implode(', ', array_map($format, $incident['prices']))
                    . '. Odabrana je niža cijena ' . $format($incident['selected_price']) . '. Provjerite zapise u ERP-u.';
            } elseif ($incident['code'] === 'deferred_catalog_name') {
                $lines[] = 'Artikl ' . $incident['article'] . ': novi aktivni artikl privremeno je izuzet iz uvoza jer ERP ne šalje naziv.'
                    . ' Dopunite naziv artikla ili pripadajuće kataloške grupe u ERP-u, zatim ponovno pokrenite ažuriranje kataloga.';
            }
        }
        $lines[] = '';
        $lines[] = 'Ista nepromijenjena nepravilnost neće ponovno slati obavijest. Nakon uklanjanja pa ponovnog pojavljivanja poslat će se nova obavijest.';
        return implode("\n", $lines);
    }

    private static function sendMail($config, string $recipient, string $subject, string $body): void
    {
        $from = trim((string)$config->get('config_email'));
        if (!filter_var($from, FILTER_VALIDATE_EMAIL) || preg_match('/[\r\n]/', $from)) {
            throw new RuntimeException('Store mail sender is not configured.');
        }
        $engine = (string)$config->get('config_mail_engine');
        if (!in_array($engine, ['mail', 'smtp'], true)) throw new RuntimeException('Unsupported mail engine.');
        // Scheduled workers do not install OpenCart's frontend library autoloader.
        require_once DIR_SYSTEM . 'library/mail.php';
        require_once DIR_SYSTEM . 'library/mail/' . $engine . '.php';
        $mail = new Mail($engine);
        $mail->parameter = $config->get('config_mail_parameter');
        foreach (['hostname', 'username', 'password', 'port', 'timeout'] as $key) {
            $value = $config->get('config_mail_smtp_' . $key);
            if ($key === 'password') $value = html_entity_decode((string)$value, ENT_QUOTES, 'UTF-8');
            $mail->{'smtp_' . $key} = $value;
        }
        $mail->setTo($recipient);
        $mail->setFrom($from);
        $name = html_entity_decode((string)$config->get('config_name'), ENT_QUOTES, 'UTF-8');
        $mail->setSender(str_replace(["\r", "\n"], '', $name ?: 'Italcro'));
        $mail->setSubject($subject);
        $mail->setText($body);
        $mail->send();
    }
}
