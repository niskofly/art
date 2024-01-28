<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = array(
	"LINK" => array(
		"NAME" => "Ссылка",
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"TARGET" => array(
		"NAME" => "Открыть в новом окне",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	),
	"DOWNLOAD" => array(
		"NAME" => "Не открывать, а сразу скачивать",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	),
	"NAME" => array(
		"NAME" => "Надпись на кнопке",
		"TYPE" => "STRING",
		"DEFAULT" => "Подробнее"
	),
	"CLASS" => array(
		"NAME" => "Класс кнопки",
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"ICON" => array(
		"NAME" => "Иконка",
		"TYPE" => "STRING",
		"DEFAULT" => "download"
	),
	"BG_COLOR" => array(
		"PARENT" => "BASE",
		"NAME" => "Фон",
		"TYPE" => "COLORPICKER",
		"DEFAULT" => 'FFFF00'
	),
);
