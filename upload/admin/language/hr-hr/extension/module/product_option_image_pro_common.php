<?php

//  Product Option Image PRO / Изображения опций PRO
//  Support: support@liveopencart.com / Поддержка: help@liveopencart.ru

// Heading
$_['heading_title']    = 'LIVEOPENCART: '.$_['module_name'];
$_['text_edit']        = "Uredi \'.\$_[\'naziv_modula\'].\' Modul";
$_['poip_module_name'] = $_['module_name'];

// Text
$_['text_module']         = "Moduli";
$_['text_success']        = "Uspjeh: postavke modula su promijenjene!";
$_['text_content_top']    = "Sadržaj Vrh";
$_['text_content_bottom'] = "Sadržaj Dno";
$_['text_column_left']    = "Stupac lijevo";
$_['text_column_right']   = "Stupac desno";

// Column
$_['column_poip_ocfilter_option_value'] = "Vrijednost opcije za dobivanje odgovarajućih slika pomoću filtra proizvoda";

// Entry
$_['entry_settings']             = "Postavke modula";
$_['entry_custom_theme_id']      = "ID prilagođene teme";
$_['entry_custom_theme_id_help'] = "Treba se ispuniti samo ako je izvorni direktorij korištene teme preimenovan ili ako naziv direktorija tema nije jedinstven";
$_['entry_import']               = "Uvoz";
$_['entry_import_description']   = 'Format datoteke za uvoz: XLSX. Uvoz koristi samo prvi list za čitanje podataka.
<br>Prvi red (glava) treba sadržavati nazive polja: product_id, option_value_id, image (ne product_option_id)
<br>Sljedeći redovi trebaju sadržavati podatke u skladu s imenima u prvom retku.';
$_['entry_import_nothing_before'] = "Nemojte brisati slike opcija prije uvoza";
$_['entry_import_delete_before']  = "Izbrišite sve slike opcija prije uvoza";
$_['error_xlsx_lib_is_not_found'] = "Biblioteka %s nije pronađena (potrebna je samo za značajke uvoza/izvoza).";
//$_['error_php_excel_is_not_found']                = '<b><a href="https://liveopencart.com/PHPExcel" target="_blank">PHPExcel</a></b> nije pronađen (<b><a href="https://liveopencart.com/PHPExcel" target="_blank">Što je PHPExcel?</a></b>). Nije pronađena datoteka:';
$_['error_php_excel_is_necessary_for_xls'] = "(PHPExcel je neophodan za uvoz XLS-a)";
//$_['error_box_spout_is_not_found']    = 'Biblioteka "Kutija/izljev" nije pronađena (potrebna samo za značajke uvoza/izvoza).';
$_['error_source_file_is_not_found'] = "Izvorna datoteka nije pronađena";
$_['error_wrong_hash_remote']        = "Pogrešno hash udaljene datoteke";
$_['error_wrong_hash_local']         = "Pogrešno hash preuzete datoteke";
$_['button_install_xlsx_lib']        = "Kliknite za automatsku instalaciju %s";
$_['success_install_xlsx_lib']       = "%s je instaliran. Molimo ponovno učitajte stranicu.";
$_['button_upload']                  = "Uvezi datoteku";
$_['button_upload_help']             = "uvoz će započeti odmah nakon odabira datoteke";
$_['entry_server_response']          = "Odgovor poslužitelja";

$_['entry_import_result']                = "Obrađeni redovi/slike/preskočeno";
$_['entry_import_result_done']           = "Uvoz je završen, provjerite detalje";
$_['entry_import_result_details']        = "Uvoz pojedinosti (brojevi redaka)";
$_['entry_import_result_toggle_details'] = "Prikaži/sakrij detalje";
$_['entry_import_result_rows']           = "Obrađeni redovi:";
$_['entry_import_result_added']          = "Dodano:";
$_['entry_import_result_skipped']        = "Preskočeno (nepoznat razlog):";
$_['entry_import_result_not_found']      = "Opcija proizvoda nije pronađena:";
$_['entry_import_result_no_image']       = "Nema slike u redu:";
$_['entry_import_result_already_exist']  = "Slika je već postavljena za opciju:";

$_['entry_export']             = "Izvoz";
$_['button_export']            = "Izvoz podataka";
$_['entry_export_description'] = 'Izvoz podataka o slikama opcija proizvoda. Format datoteke: XLSX. Izvoz koristi samo prvi list za postavljanje podataka.
<br>Prvi red (glava) sadrži nazive polja: product_id, option_value_id, image (ne product_option_id)
<br>Sljedeći redovi sadrže podatke u skladu s imenima u prvom redu.';
$_['entry_export_options_without_images'] = "Uključi opcije proizvoda bez slika";
$_['entry_export_names']                  = "Uključite nazive proizvoda i opcija";
$_['entry_export_first_product_id']       = "Prvi ID proizvoda";
$_['entry_export_last_product_id']        = "Zadnji ID proizvoda";
$_['entry_export_min_product_id']         = "min ID:";
$_['entry_export_max_product_id']         = "max ID:";

$_['entry_layout']           = "Izgled:";
$_['entry_position']         = "Položaj:";
$_['entry_status']           = "Status:";
$_['entry_sort_order']       = "Redoslijed sortiranja:";
$_['entry_sort_order_short'] = "vrsta:";
$_['entry_settings_default'] = "globalne postavke";
$_['entry_settings_yes']     = "Na";
$_['entry_settings_no']      = "Isključeno";

$_['entry_no_value']       = "nema vrijednosti";
$_['entry_no_value_help']  = "prikaži sliku ako opcija nije odabrana (ima smisla samo ako je za sliku označena barem jedna vrijednost opcije)";
$_['entry_any_value']      = "bilo koju vrijednost";
$_['entry_any_value_help'] = "prikaži sliku ako je odabrana bilo koja vrijednost opcije (može biti korisno kada ova slika ne bi trebala biti prikazana dok se opcija ne odabere)";

$_['entry_options_images_edit']      = "Način uređivanja slika opcija";
$_['entry_options_images_edit_help'] = "postavite metodu (mjesto) za uređivanje slika opcija";
$_['entry_options_images_edit_v0']   = "Slike za opcije (uredite na kartici \'Opcija\' na stranici za uređivanje proizvoda)";
$_['entry_options_images_edit_v1']   = "Opcije za slike (uredite na kartici \'Slika\' na stranici za uređivanje proizvoda)";

$_['entry_tab_image_use_selects']      = "Koristite ulaze";
$_['entry_tab_image_use_selects_v0']   = "Potvrdni okviri";
$_['entry_tab_image_use_selects_v1']   = "Padajući izbornik odabire";
$_['entry_tab_image_use_selects_v2']   = "Onesposobljeno";
$_['entry_tab_image_use_selects_help'] = "Potvrdni okviri omogućuju povezivanje slike s nekoliko vrijednosti jedne opcije, padajući odabir zauzima manje prostora na stranici, ali dopušta povezivanje ne više od 1 vrijednosti ili svake opcije, \'Onemogućeno\' onemogućuje korištenje opcija za povezivanje sa slikama (može se definirati po opciji, na stranici za uređivanje opcija)";

$_['entry_images_for_ro']         = "Slike za povezane opcije";
$_['entry_images_for_ro_help']    = "postavite slike za kombinacije povezanih opcija (prema modulima Related Options ili Related Options PRO)";
$_['entry_images_for_ro_details'] = 'zahtijeva
<a href="https://liveopencart.com/opencart-extension/related-options" target="_blank">Srodne opcije</a>
(<a href="https://www.opencart.com/index.php?route=marketplace/extension/info&filter_member=liveopencart&extension_id=31606" target="_blank" title="Related Options on opencart.com">opencart.com</a>)
ili
<a href="https://liveopencart.com/opencart-extension/related-options-pro" target="_blank">Srodne opcije PRO</a>
(<a href="https://www.opencart.com/index.php?route=marketplace/extension/info&filter_member=liveopencart&extension_id=31605" target="_blank" title="Related Options PRO on opencart.com">opencart.com</a> | <a href="https://isenselabs.com/products/view/related-options-pro-take-product-options-to-the-next-level?pa=41075" target="_blank"  title="Related Options PRO on isenselabs.com">isenselabs.com</a>)';

$_['entry_img_use_v0'] = "Isključeno";
$_['entry_img_use_v1'] = "Uključeno (za sve)";
$_['entry_img_use_v2'] = "Uključeno (za odabrane vrijednosti opcije)";
$_['entry_img_use_v3'] = "Uključeno (za odabrane vrijednosti opcije, ali prisilno isključi ako opcija nije odabrana)";

$_['entry_img_first_v0'] = "Ne dirajte";
$_['entry_img_first_v1'] = "Zamijenite slikama prve opcije proizvoda";
$_['entry_img_first_v2'] = "Koristite slike opcija sličnih proizvoda";

// Entry Module Settings
$_['entry_img_change']                  = "Promijenite glavnu sliku proizvoda pri odabiru opcije";
$_['entry_img_change_help']             = "promijenite glavnu sliku proizvoda na stranici proizvoda u odjeljku za korisnike na odabiru opcije (koristite sliku prve opcije)";
$_['entry_img_hover']                   = "Zamijeni sliku pri prelasku miša";
$_['entry_img_hover_help']              = "promijenite glavnu sliku proizvoda na stranici proizvoda u odjeljku za kupce mišem preko dodatne slike proizvoda";
$_['entry_img_click']                   = "Zamijeni sliku na klik";
$_['entry_img_click_help']              = "promijeniti glavnu sliku proizvoda na stranici proizvoda u odjeljku za korisnike klikom na dodatnu sliku proizvoda (nisu sve teme podržane)";
$_['entry_img_main_to_additional']      = "Dodajte glavnu sliku dodatnoj";
$_['entry_img_main_to_additional_help'] = "dodajte glavnu sliku proizvoda na popis dodatnih slika proizvoda na stranici proizvoda u odjeljku za kupce";
$_['entry_img_main_to_additional_v0']   = "Onemogućeno (zadano)";
$_['entry_img_main_to_additional_v1']   = "Omogućeno";
$_['entry_img_main_to_additional_v2']   = "Omogućeno samo ako postoje druge dodatne slike proizvoda";

$_['entry_img_use']      = "Dodajte slike opcija proizvoda u dodatne";
$_['entry_img_use_help'] = "dodajte slike opcija proizvoda na popis dodatnih slika proizvoda na stranici proizvoda u odjeljku za kupce";

$_['entry_img_limit']                                = "Filtrirajte dodatne slike";
$_['entry_img_limit_help']                           = "Prikazi samo prikladne slike (prema odabranim opcijama proizvoda) na popisu dodatnih slika na stranici proizvoda u korisnickom dijelu. Radi samo uz opciju Dodajte slike opcija proizvoda u dodatne.";
$_['entry_img_limit_v0']                             = "Isključeno";
$_['entry_img_limit_v1']                             = "Sve dodatne slike";
$_['entry_img_limit_v2']                             = "Samo slike odabranih opcija";
$_['entry_img_limit_v3']                             = "Samo slike odabranih opcija, ali stroge (primjenjujući se i na identične slike proizvoda)";
$_['entry_img_filter_by_comb']                       = "Filtrirajte prema kompletnom skupu opcija";
$_['entry_img_filter_by_comb_help']                  = "Ako je slika povezana s vrijednostima nekoliko opcija, filtrirajte sliku dok se ne odaberu sve vrijednosti opcija";
$_['entry_img_filter_checkbox_use_exact_match']      = "Potpuno podudaranje za potvrdne okvire";
$_['entry_img_filter_checkbox_use_exact_match_help'] = "Filtrirajte sliku povezanu s opcijom potvrdnog okvira ako se vrijednosti provjerene za sliku ne podudaraju točno s vrijednostima koje je korisnik trenutno provjerio na stranici proizvoda";

$_['entry_img_gal']      = "Filtriraj skočnu galeriju";
$_['entry_img_gal_help'] = 'prikaži samo prikladne slike (u skladu s odabranim opcijama proizvoda) u skočnoj galeriji na stranici proizvoda u odjeljku za korisnike, preporučuje se korištenje sa značajkama "'.$_['entry_img_use'].'" i "'.$_['entry_img_limit'].'"';

$_['entry_img_option']      = "Opcija prikaza slika ispod";
$_['entry_img_option_v0']   = "Isključeno";
$_['entry_img_option_v1']   = "Uključeno (sve slike odabrane vrijednosti opcije)";
$_['entry_img_option_v2']   = "Uključeno (slike filtrirane prema svim odabranim opcijama)";
$_['entry_img_option_help'] = "prikaži relevantne slike opcija proizvoda ispod odabrane vrijednosti opcije odaberite/radio/potvrdni okvir na stranici proizvoda u odjeljku za korisnike";

$_['entry_img_load_outofstock']      = "Slike za opcije rasprodanih";
$_['entry_img_load_outofstock_help'] = "učitavanje slika za vrijednosti opcije rasprodaje (može biti korisno u slučaju izmjene koja prikazuje vrijednosti opcije rasprodaje čak i ako je \'Oduzimanje zaliha\' za njih postavljeno na \'Da\' ili u slučaju filtriranja slika proizvoda povezanih s vrijednostima opcije rasprodaje)";

$_['entry_img_category']            = "Prikaži opcije opcija na popisima proizvoda";
$_['entry_img_category_help']       = 'prikaz vrijednosti opcija proizvoda na popisima proizvoda (stranice kategorija, stranice proizvođača, standardni moduli "Najnovije", "Bestsellers", "Posebno", "Istaknuto", itd.)';
$_['entry_img_category_click']      = "Zamijenite sliku na popisu proizvoda klikom";
$_['entry_img_category_click_help'] = 'promjena glavne slike proizvoda na odgovarajuću sliku vrijednosti opcije na klik (inače, prelaskom miša), ima smisla samo u slučaju uključene postavke \''.$_['entry_img_category'].'\' ';
$_['entry_custom_thumb_size']       = "Prilagođena veličina sličica opcija na popisima proizvoda";
$_['entry_custom_thumb_size_help']  = 'postavite određenu širinu/visinu za palice vrijednosti opcije proizvoda prikazane na popisima proizvoda (inače će se veličina palca odrediti automatski), ima smisla samo u slučaju uključene postavke \''.$_['entry_img_category'].'\' ';
$_['entry_custom_thumb_width']      = "Širina (px)";
$_['entry_custom_thumb_height']     = "Visina (px)";

//$_['entry_img_sort']            = 'Сквозная сортировка изображений';
//$_['entry_img_sort_help']       = 'сортировать изображения в соответствии с указанным порядком вне зависимости от опций к которым они привязаны';
$_['entry_img_first']      = "Standardne slike opcija";
$_['entry_img_first_help'] = "koristiti standardne slike opcija dodane na stranici za uređivanje opcija (izbornik Katalog - Opcije - itd.)";
$_['entry_img_cart']       = "Slike opcija prikaza u košarici";
$_['entry_img_cart_help']  = "prikazati slike relevantne za odabrane opcije u košarici";

$_['entry_show_settings']                                 = "Postavke zaslona";
$_['entry_hide_settings']                                 = "Sakrij postavke";
$_['entry_show_hide']                                     = "pokazati/sakrij";
$_['entry_img_radio_checkbox']                            = "Prikaz minijatura za potvrdne okvire";
$_['entry_img_radio_checkbox_help']                       = "prikaži minijature za opcije s vrstom \'Checkbox\' kao što radi prema zadanim postavkama za vrstu opcije \'Radio\' (kompatibilno samo s nekim temama)";
$_['entry_dependent_thumbnails']                          = "Sličice ovisne opcije";
$_['entry_dependent_thumbnails_help']                     = "promijeniti sličice opcija na stranici proizvoda u odjeljku za korisnike ovisno o drugim odabranim opcijama";
$_['entry_disable_product_image_drag_and_drop_sort']      = "Nema sortiranja povuci i ispusti";
$_['entry_disable_product_image_drag_and_drop_sort_help'] = "onemogućite značajku sortiranja povlačenjem i ispuštanjem za slike proizvoda (kartica stranice za uređivanje proizvoda \'Slika\')";

$_['text_update_alert'] = "(nova verzija je dostupna)";

$_['button_select_images'] = "Odaberite označene slike (jednu ili više)";
$_['button_add_images']    = "Dodajte slike (jednu ili više)";

$_['entry_about']        = "Oko";
$_['module_description'] = 'Modul modula dizajniran je za poboljšanje standardne OpenCart funkcionalnosti slika proizvoda. Omogućuje dodjeljivanje slika opcijama proizvoda (od 1 do nekoliko slika po vrijednosti opcije) i njihovu upotrebu za bolju vizualizaciju proizvoda zajedno s njegovim opcijama za kupce.
<br>Kompatibilne vrste opcija: "Odaberi", "Radio", "Potvrdni okvir".';

$_['text_conversation'] = "Otvoreni smo za razgovor. Ako trebate modificirati ili integrirati naše module, dodati novu funkcionalnost ili razviti novo proširenje, pošaljite e-poruku na <b>support@liveopencart.com</b>.";

$_['entry_we_recommend'] = "Također preporučujemo:";
$_['text_we_recommend']  = '

';
$_['module_copyright'] = '"'.$_['module_name'].'". is a commercial extension. Resell or transfer it to other users is NOT ALLOWED.
<br>By purchasing this module, you get it for use on one site. 
If you want to use the module on multiple sites, you should purchase a separate copy for each site.
<br>Thank you for purchasing the module.
';

// Error
$_['error_permission'] = 'Upozorenje: Nemate dopuštenje za izmjenu modula "'.$_['module_name'].'"!';

$_['text_module_version'] = $_['module_name'].', version';
$_['text_module_support'] = 'Programer: <a href="http://liveopencart.com" target="_blank">liveopencart.com</a> | Podrška, pitanja i prijedlozi: <a href="mailto:support@liveopencart.com">support@liveopencart.com</a>';
