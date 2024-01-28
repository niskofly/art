<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = array(
	"BG_COLOR" => array(
		"PARENT" => "BASE",
		"NAME" => "Цвет фона",
		"TYPE" => "COLORPICKER",
		"DEFAULT" => 'FFFF00'
	),
	"BG_FILE" => array(
		"PARENT" => "BASE",
		"NAME" => "Файл для фона",
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => "",
	),
);
