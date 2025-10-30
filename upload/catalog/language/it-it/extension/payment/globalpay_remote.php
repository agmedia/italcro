<?php
// Text
$_['text_title']				= 'Carta di Credito o Debito';
$_['text_credit_card']			= 'Dettagli carta di credito';
$_['text_wait']					= 'Attendere!';
$_['text_result']				= 'Risultato';
$_['text_message']				= 'Messaggio';
$_['text_cvn_result']			= 'Risultato CVN';
$_['text_avs_postcode']			= 'Codice Postale AVS';
$_['text_avs_address']			= 'IndirizzoAVS';
$_['text_eci']					= 'Risultato ECI (3D secure)';
$_['text_tss']					= 'Risultato TSS';
$_['text_card_bank']			= 'Banca emisssione carta';
$_['text_card_country']			= 'Nazione Carta';
$_['text_card_region']			= 'Provincia Carta';
$_['text_last_digits']			= 'Ultime 4 cifre';
$_['text_order_ref']			= 'Rif Ordine';
$_['text_timestamp']			= 'Timestamp';
$_['text_card_visa']			= 'Visa';
$_['text_card_mc']				= 'Mastercard';
$_['text_card_amex']			= 'American Express';
$_['text_card_switch']			= 'Switch';
$_['text_card_laser']			= 'Laser';
$_['text_card_diners']			= 'Diners';
$_['text_auth_code']			= 'Auth code';
$_['text_3d_s1']				= 'Cardholder Not Enrolled, liability shift';
$_['text_3d_s2']				= 'Unable To Verify Enrolment, no liability shift';
$_['text_3d_s3']				= 'Invalid Response From Enrolment Server, no liability shift';
$_['text_3d_s4']				= 'Enrolled, But Invalid Response From ACS (Access Control Server), no liability shift';
$_['text_3d_s5']				= 'Successful Authentication, liability shift';
$_['text_3d_s6']				= 'Authentication Attempt Acknowledged, liability shift';
$_['text_3d_s7']				= 'Incorrect Password Entered, no liability shift';
$_['text_3d_s8']				= 'Autenticazione non disponibile, no liability shift';
$_['text_3d_s9']				= 'Risposta non valida da parte di ACS. Non ci si assume nessuna responsabilità';
$_['text_3d_s10']				= 'Errore fatale RealMPI. Nessun cambiamento di responsabilità';

// Entry
$_['entry_cc_type']				= 'Tipo di Carta';
$_['entry_cc_number']			= 'Numero Carta';
$_['entry_cc_name']				= 'Nome Intestatario Carta';
$_['entry_cc_expire_date']		= 'Data di Scadenza della Carta';
$_['entry_cc_cvv2']				= 'Codice di Sicurezza Carta (CVV2)';
$_['entry_cc_issue']			= 'Numero di emissione della Carta';

// Help
$_['help_start_date']			= '(se disponibile)';
$_['help_issue']				= '(Unicamente per carte Maestro e Solo)';

// Error
$_['error_card_number']			= 'verificare il numero della carta';
$_['error_card_name']			= 'Verificare che l\'intestatario della carta sia valido';
$_['error_card_cvv']			= 'Controllare the CVV2 is valid';
$_['error_3d_unable']			= 'Il venditore richiede 3D secure per fare verifiche con la tua banca. Riprova più tardi';
$_['error_3d_500_response_no_payment'] = 'E\' stata ricevuta una risposta non valida dal gateway. Non vi è stato nessun addebito';
$_['error_3d_unsuccessful']		= '3D secure authorisation failed';