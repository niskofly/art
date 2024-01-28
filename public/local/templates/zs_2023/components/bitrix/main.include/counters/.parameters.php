<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"MESSAGE" => array(
		"NAME" => Loc::getMessage('COUNTERS_MESSAGE'),
		"TYPE" => "STRING",
		"DEFAULT" => Loc::getMessage('COUNTERS_MESSAGE_DEFAULT'),
	),
	"OFF_FOR_ADMIN" => array(
		"NAME" => Loc::getMessage('COUNTERS_OFF_FOR_ADMIN'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => 'N',
	)
);
