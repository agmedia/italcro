<?php

//  Product Option Image Ultimate / Изображения опций Ultimate
//  Support: support@liveopencart.com / Поддержка: help@liveopencart.ru

$_['module_name'] = 'Product option image Ultimate';
$_['module_page'] = '
<a href="https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=32391" target="_blank">'.$_['module_name'].' on opencart.com</a>
';

$_lang_file = __DIR__.'/product_option_image_pro_common.php';
//if ( file_exists($_lang_file) ) {
//	require($_lang_file);
//}
if (substr($_lang_file, 0, strlen(DIR_MODIFICATION)) == DIR_MODIFICATION) {
	$_lang_file = dirname(DIR_APPLICATION).'/'.substr($_lang_file, strlen(DIR_MODIFICATION));
}
include(modification($_lang_file));
