<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = array(
	"SHOW_ICON" => array(
		"NAME" => "Показать иконку",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"FROM_FILE" => array(
		"NAME" => "Выключи, если хочешь построить адрес из файла, а не мета данных",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"SCHEMA_ORG" => array(
		"NAME" => "schema.org",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"link" => array(
		"NAME" => "Сайт (обязательно для schema.org)",
		"TYPE" => "STRING",
	),
	"company_name" => array(
		"NAME" => "Название компании (обязательно для schema.org)",
		"TYPE" => "STRING",
	),
	"postalCode" => array(
		"NAME" => "Почтовый индекс (postalCode)",
		"TYPE" => "STRING",
	),
	"addressCountry" => array(
		"NAME" => "Страна (addressCountry)",
		"TYPE" => "STRING",
	),
	"addressLocality" => array(
		"NAME" => "Населённый пункт (addressLocality)",
		"TYPE" => "STRING",
	),
	"streetAddress" => array(
		"NAME" => "Адрес (streetAddress)",
		"TYPE" => "STRING",
	),
);
?>
