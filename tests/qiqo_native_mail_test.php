<?php
namespace Mail {
    // Calls from the actual native adaptor resolve to this fake. No real email
    // is sent, including when exercising the optional sendmail parameters.
    function mail(...$arguments) {
        $GLOBALS['qiqo_mail_test_calls'][] = $arguments;
        return $GLOBALS['qiqo_mail_test_accept'];
    }
}
namespace {
    require_once __DIR__ . '/../upload/system/library/mail.php';
    require_once __DIR__ . '/../upload/system/library/mail/mail.php';
    $GLOBALS['qiqo_mail_test_calls'] = [];
    foreach (['', '-fshop@example.test'] as $parameter) {
        $message = new \Mail('mail');
        $message->setTo('owner@example.test');
        $message->setFrom('shop@example.test');
        $message->setSender('Italcro');
        $message->setSubject('ERP alert');
        $message->setText('A synthetic test body used only by the fake transport.');
        $message->parameter = $parameter;
        $GLOBALS['qiqo_mail_test_accept'] = true;
        $message->send();
        $last = end($GLOBALS['qiqo_mail_test_calls']);
        if (count($last) !== ($parameter ? 5 : 4) || $last[0] !== 'owner@example.test') {
            throw new \RuntimeException('The native adaptor must preserve recipients and optional parameters.');
        }
        $GLOBALS['qiqo_mail_test_accept'] = false;
        try {
            $message->send();
            throw new \LogicException('A rejected native mail call was silently reported as accepted.');
        } catch (\RuntimeException $expected) {
            if ($expected->getMessage() !== 'Mail transport did not accept the message.') throw $expected;
        }
    }
    echo "Native mail acceptance and rejection checks passed without sending email.\n";
}
