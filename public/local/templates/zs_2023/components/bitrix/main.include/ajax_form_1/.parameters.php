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
	)
);
?>
