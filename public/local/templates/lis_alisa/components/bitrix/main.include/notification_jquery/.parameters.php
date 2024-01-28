<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"BUTTON_APPLY_TEXT" => array(
		"NAME" => Loc::getMessage('NOTIFICATION_BUTTON_APPLY'),
		"TYPE" => "STRING",
		"DEFAULT" => Loc::getMessage('NOTIFICATION_BUTTON_APPLY_DEFAULT')
	),
	"BUTTON_CLASS" => array(
		"NAME" => Loc::getMessage('NOTIFICATION_BUTTON_CLASS'),
		"TYPE" => "STRING",
	),
	"YA_METRIKA" => array(
		"NAME" => Loc::getMessage('NOTIFICATION_YA_METRIKA'),
		"TYPE" => "STRING",
	),
	'AREA_FILE_SHOW' => [
		"HIDDEN" => 'Y',
		"DEFAULT" => "file"
	],
	'PATH' => [
		"HIDDEN" => 'Y',
		"DEFAULT" => SITE_TEMPLATE_PATH . "/assets/include_areas/notification.php"
	]
);
