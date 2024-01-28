<?php

const VENDORS_LIB_TEMPLATE_PATH = '/local/vendor';


/* Рабочий вариант */
$include_path = __DIR__ . '/';
$include_files = [
	['name' => 'debug', 'path' => 'include/'],
//	['name' => 'is_mobile', 'path' => 'include/function/' ],
//	['name' => 'redirects', 'path' => 'include/'],
    ['name' => 'get_phone', 'path' => 'include/function/' ],
    ['name' => 'crop_text', 'path' => 'include/function/' ],
];

foreach ($include_files as $include_file) {
	$current_include_path = $include_path;
	if ($include_file['path']) {
		$current_include_path = $include_path . $include_file['path'];
	}

	if (file_exists($current_include_path . $include_file['name'] . '.php')) {
		require_once($current_include_path . $include_file['name'] . '.php');
	}
}
//if (file_exists(__DIR__ . "/include/form/validators/ru_en_text.php")) {
//	require_once(__DIR__ . "/include/form/validators/ru_en_text.php");
//}
//if (file_exists(__DIR__ . "/include/form/validators/ru_text.php")) {
//	require_once(__DIR__ . "/include/form/validators/ru_text.php");
//}


// START -- СЕО вырезаем type="text/javascript" для прохождения валидации.
// TODO проверить нагрузку на страницу
AddEventHandler("main", "OnEndBufferContent", "removeType");

function removeType(&$content)
{
	$content = replace_output($content);
}

function replace_output($d)
{
	return str_replace(' type="text/javascript"', "", $d);
}
// END -- СЕО вырезаем type="text/javascript" для прохождения валидации.
