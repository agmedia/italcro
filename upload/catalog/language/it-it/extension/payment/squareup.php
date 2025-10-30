<?php
// Text
$_['text_new_card']                     = '+ Add new card';
$_['text_loading']                      = 'Caricamento ... Attendere ...';
$_['text_card_details']                 = 'Dettagli Carta';
$_['text_saved_card']                   = 'Use Saved Card:';
$_['text_card_ends_in']                 = 'Pay with existing %s card that ends on XXXX XXXX XXXX %s';
$_['text_card_number']                  = 'Numero Carta:';
$_['text_card_expiry']                  = 'Scadenza Carta (MM/AA):';
$_['text_card_cvc']                     = 'Card Security Code (CVC):';
$_['text_card_zip']                     = 'CAP Carta:';
$_['text_card_save']                    = 'Salva la carta per utilizzo futuro?';
$_['text_trial']                        = '%s ogni %s %s per %s pagamenti e poi ';
$_['text_recurring']                    = '%s ogni %s %s';
$_['text_length']                       = ' per %s pagamenti';
$_['text_cron_subject']                 = 'Resoconto Square CRON job';
$_['text_cron_message']                 = 'Di seguito è riportato un elenco di tutte le attività CRON eseguite dall&apos;estensione Square:';
$_['text_squareup_profile_suspended']   = ' I tuoi pagamenti ricorrenti sono stati sospesi. Vi preghiamo di contattarci per maggiori dettagli.';
$_['text_squareup_trial_expired']       = ' Periodo di prova terminato.';
$_['text_squareup_recurring_expired']   = ' I tuoi pagamenti ricorrenti sono scaduti. Questo è stato il tuo ultimo pagamento.';
$_['text_cron_summary_token_heading']   = 'Aggiornamento del token di accesso:';
$_['text_cron_summary_token_updated']   = 'Token di accesso aggiornato correttamento!';
$_['text_cron_summary_error_heading']   = 'Errori di Transazione:';
$_['text_cron_summary_fail_heading']    = 'Transazioni Fallite (Profili Sospesi):';
$_['text_cron_summary_success_heading'] = 'Transazioni avvenute con Successo:';
$_['text_cron_fail_charge']             = 'Il Profilo <strong>#%s</strong> NON pu&ograve; avere un addebito di <strong>%s</strong>';
$_['text_cron_success_charge']          = 'Il Profilo <strong>#%s</strong> ha avuto un addebito di <strong>%s</strong>';
$_['text_card_placeholder']             = 'XXXX XXXX XXXX XXXX';
$_['text_cvv']                          = 'CVV';
$_['text_expiry']                       = 'MM/YY';
$_['text_default_squareup_name']        = 'Carta di Credito/Debito';
$_['text_token_issue_customer_error']   = 'Stiamo avendo dei problemi con il sistema di pagamento. Si prega di riprovare.';
$_['text_token_revoked_subject']        = 'Il tuo token di accesso Square &egrave; stato revocato!';
$_['text_token_revoked_message']        = "L&apos;accesso dell&apos;estensione di pagamento Square al tuo account Square &egrave; stata revocata tramite la Dashboard Square. Devi verificare le tue credenziali dell&apos;applicazione nelle impostazioni dell&apos;estensione e ricollegarti.";
$_['text_token_expired_subject']        = 'Il tuo token di accesso Square &egrave; scaduto!';
$_['text_token_expired_message']        = "&Egrave; scaduto il token di accesso della tua estensione che si collega al tuo account Square. Devi verificare le tue credenziali e il job CRON nelle impostazioni estensione e ricollegarti.";

// Error
$_['error_browser_not_supported']       = 'Errore: Il sistema di pagamento non supporta pi&ugrave; il tuo browser. Aggiornalo o usane un altro.';
$_['error_card_invalid']                = 'Errore: Carta non valida!';
$_['error_squareup_cron_token']         = 'Errore: Il tuo toke dn di Accesso non pu&ograve; essere aggiornato. Collega la tua estensione di pagamento Square tramite il pannello di controllo.';

// Warning
$_['warning_test_mode']                 = 'Attenzione: Modalit&agrave; Sandbox abilitata! Le transazioni avverranno normalmente ma non verranno effettuati addebiti.';

// Statuses
$_['squareup_status_comment_authorized']    = 'La transazione per la carta &egrave; stata autorizzata ma non ancora acquisita.';
$_['squareup_status_comment_captured']      = 'La transazione per la carta &egrave; stata autorizzata e successivamente acquisita (es. completato).';
$_['squareup_status_comment_voided']        = 'La transazione per la carta &egrave; stata autorizzata e successivamente annullata (es. annullato).   ';
$_['squareup_status_comment_failed']        = 'Transazione per la carta fallita.';

// Override errors
$_['squareup_override_error_billing_address.country']       = 'Nazione indirizzo di Pagamento non valida. Si prega di modificare e riprovare.';
$_['squareup_override_error_shipping_address.country']      = 'Nazione indirizzo di spedizione non valida. Si prega di modificare e riprovare.';
$_['squareup_override_error_email_address']                 = 'L&apos;indirizzo e-mail del cliente non &egrave; valido. Si prega di modificare e riprovare.';
$_['squareup_override_error_phone_number']                  = 'Il nr di telefono del cliente non &egrave; valido. Si prega di modificare e riprovare.';
$_['squareup_error_field']                                  = ' Campo: %s';