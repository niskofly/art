<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = array(
	"TITLE" => array(
		"NAME" => "Заголовок",
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"BUTTON_TEXT" => array(
		"NAME" => "Текст на кнопке",
		"TYPE" => "STRING",
		"DEFAULT" => "Отправить"
	),
	"FORM_ID" => array(
		"NAME" => "ID формы",
		"TYPE" => "STRING",
	),
	"IMG" => array(
		"PARENT" => "BASE",
		"NAME" => "Картинка",
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => "",
	),
	"PHONE" => array(
		"NAME" => "Телефон",
		"TYPE" => "STRING",
	)
);
?>
