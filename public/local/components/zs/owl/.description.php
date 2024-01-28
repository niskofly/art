<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
	"NAME" => Loc::getMessage("ZS_OWL_NAME"),
	"DESCRIPTION" => Loc::getMessage("ZS_OWL_DESCRIPTION"),
	"COMPLEX" => "N",
	"PATH" => [
		"ID" => Loc::getMessage("ZS_OWL_PATH_ID"),
		"NAME" => Loc::getMessage("ZS_OWL_PATH_NAME"),
	],
];
