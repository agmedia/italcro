<?php
// Heading
$_['heading_title']     = "AI Generator";
$_['text_extension']    = "SEO proširenja";

// Success Messages
$_['text_success']      = "Uspjeh: Promjene su uspješno ažurirane!";

// Tabs
$_['tab_product']       = "Proizvodi";
$_['tab_category']      = "kategorije";
$_['tab_manufacturer']  = "Proizvođači";
$_['tab_information']   = "Informacija";
$_['tab_items']         = "Predmeti generirani umjetnom inteligencijom";
$_['tab_setting']       = "postavke"; 
$_['tab_logs']          = "Dnevnici";

// Buttons
$_['button_doc']                = "dokumenti";
$_['button_generate']           = "Generirati";
$_['button_generate_selected']  = "Generiraj odabrano";

$_['button_restore']            = "Vratiti";
$_['button_restore_selected']   = "Vrati odabrano";
$_['button_restore_all']        = "Vrati sve";

$_['button_accept']             = "Prihvatiti";
$_['button_accept_selected']    = "Prihvati odabrano";
$_['button_accept_all']         = "Prihvati sve";

$_['button_delete']             = "Izbrisati";
$_['button_delete_selected']    = "Izbriši odabrano";
$_['button_delete_all']         = "Izbriši sve";

$_['button_prompt_preview']     = "Brzi pregled";

// Columns
$_['column_id']                 = "ID";
$_['column_type']               = "Tip";
$_['column_item_id']            = "ID stavke";
$_['column_element']            = "Element";
$_['column_language']           = "Jezik";
$_['column_value']              = "Vrijednost generirana umjetnom inteligencijom";
$_['column_previous_value']     = "Prethodna vrijednost";
$_['column_date_added']         = "Datum dodavanja";

$_['column_name']               = "Ime";
$_['column_model']              = "Model";
$_['column_meta_title']         = "Meta naslov";
$_['column_meta_description']   = "Meta opis";
$_['column_meta_keyword']       = "Meta ključna riječ";
$_['column_action']             = "Akcijski";

// Text
$_['text_search_product']       = "Pretražite proizvod prema ID-u, nazivu ili modelu";
$_['text_search_category']      = "Tražite kategoriju prema ID-u ili nazivu";
$_['text_search_manufacturer']  = "Pretražite proizvođača po ID-u ili nazivu";
$_['text_search_information']   = "Pretraživanje informacija prema ID-u ili naslovu";
$_['text_search_items']         = "Pretražujte stavke prema ID-u, vrsti, vrijednosti, prethodnoj vrijednosti ili elementu";

$_['text_status']               = "Status";
$_['text_enable_logs']          = "Omogući zapisnike";
$_['text_api']                  = "API za ChatGPT";
$_['text_api_help']             = "Ovdje unesite ChatGPT API ključ. Možete ga nabaviti na <a href=\"https://platform.openai.com/api-keys\" target=\"_blank\">https://platform.openai.com/api-keys</a>.";
$_['text_gpt_model']            = "GPT model";
$_['text_gpt_max_tokens']       = "Maksimalan broj tokena po zahtjevu";
$_['text_language']             = "Zadani jezik";
$_['text_cron_key']             = "Ključ CRON";
$_['text_cron_limit']           = "CRON ograničenje";
$_['text_cron_limit_help']      = "Broj proizvoda obrađenih po izvođenju CRON-a.";
$_['text_cron_command']         = "CRON naredba";
$_['text_description_max_length'] = "Brz opis Maks. duljina";
$_['text_simulate']             = "Način simulacije. Vrijednosti su pohranjene u zasebnoj tablici i ne ažuriraju se u glavnoj bazi podataka. Kasnije ih možete spremiti ručno.";
$_['text_prompt_template']      = "Unesite predložak za upit ChatGPT.";

$_['text_description']          = "Opis";
$_['text_meta_title']           = "Meta naslov";
$_['text_meta_description']     = "Meta opis";
$_['text_meta_keyword']         = "Meta ključna riječ";
$_['text_h1']                   = "H1";
$_['text_h2']                   = "H2";
$_['text_product_tags']         = "Oznake proizvoda";
$_['text_sections']             = "Sekcije";
$_['text_preview']              = "Brzi pregled";

$_['text_product_prompt_template']       = "Predložak upita za proizvod";
$_['text_product_prompt_template_help']  = "Možete koristiti sljedeće varijable: <br>{name}, {model}, {description}";

$_['text_category_prompt_template']      = "Predložak upita kategorije";
$_['text_category_prompt_template_help'] = "Možete koristiti sljedeće varijable:<br>{name}, {description}";

$_['text_manufacturer_prompt_template']  = "Predložak upita proizvođača";
$_['text_manufacturer_prompt_template_help'] = "Možete koristiti sljedeću varijablu:<br>{name}";

$_['text_information_prompt_template']   = "Predložak obavijesti";
$_['text_information_prompt_template_help'] = "Možete koristiti sljedeće varijable:<br>{title}, {description}";

$_['text_one_language']        = "Generiraj samo za zadani jezik.";
$_['text_overwrite']           = "Prebrišite postojeće vrijednosti.";
$_['text_restore']             = "Vratite sve vrijednosti.";
$_['text_restore_confirm']     = "Jeste li sigurni da želite vratiti sve vrijednosti?";

$_['text_confirm_generate']    = "Jeste li sigurni da želite generirati vrijednosti za odabrane stavke?";
$_['text_confirm_delete']      = "Jeste li sigurni da želite izbrisati odabrane stavke?";

$_['text_no_records']          = "Nema pronađenih zapisa!";

// Success Messages
$_['success_restore_success']  = "Sve vrijednosti uspješno vraćene!";
$_['text_success_logs']        = "Uspjeh: Dnevnici su uspješno izbrisani!";
$_['success_accept']           = "Uspjeh: vrijednosti generirane umjetnom inteligencijom ažurirane su u glavnim tablicama!";
$_['success_accept_all']       = "Uspjeh: Sve vrijednosti generirane umjetnom inteligencijom ažurirane su u glavnim tablicama!";
$_['success_restore']          = "Uspjeh: vrijednosti su uspješno vraćene!";
$_['success_restore_all']      = "Uspjeh: Sve su vrijednosti uspješno vraćene!";
$_['success_delete']           = "Uspjeh: Stavke su uspješno izbrisane!";
$_['success_delete_all']       = "Uspjeh: Sve stavke su uspješno izbrisane!";

// Error Messages
$_['error_permission']         = "Upozorenje: nemate dopuštenje za izmjenu ovog proširenja!";
$_['error_no_record_selected'] = "Upozorenje: Nema odabranih zapisa!";
$_['error_accept_failed']      = "Upozorenje: ažuriranje vrijednosti nije uspjelo! Za više detalja provjerite zapisnike.";
$_['error_restore_failed']     = "Upozorenje: vraćanje vrijednosti nije uspjelo! Za više detalja provjerite zapisnike.";
?>
