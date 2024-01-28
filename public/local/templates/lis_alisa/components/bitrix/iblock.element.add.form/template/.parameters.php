<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 * */

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
	throw new Exception('Не загружены модули необходимые для работы компонента');
}


$arTemplateParameters = [

	"PROP_COLOR_PLACEHOLDER" => [
		"PARENT" => "VISUAL",
		"NAME" => 'код цвета placeholder',
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_HIDE_HEADER" => [
		"PARENT" => "VISUAL",
		"NAME" => 'скрыть заголовок',
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "N",
		"COLS" => 25
	],
	"PROP_HIDE_DISCRIPT" => [
		"PARENT" => "VISUAL",
		"NAME" => 'скрыть описание',
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_HIDE_NAME_FIELD" => [
		"PARENT" => "VISUAL",
		"NAME" => 'скрыть названия полей',
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_HIDE_AGREEMENT" => [
		"PARENT" => "VISUAL",
		"NAME" => 'скрыть соглашение',
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_LINK_AGREEMENT" => [
		"PARENT" => "VISUAL",
		"NAME" => 'Ссылка на страницу соглашения',
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_CSS_CLASS" => [
		"PARENT" => "VISUAL",
		"NAME" => 'класс темы (CSS класс для использования в темах)',
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
	"PROP_EVENT_NAME" => [
		"PARENT" => "ADDITIONAL_SETTINGS",
		"NAME" => 'Событие отправки почты',
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],

];
