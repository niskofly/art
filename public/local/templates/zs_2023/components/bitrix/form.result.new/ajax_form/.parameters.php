<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"SHOW_FORM_TITLE" => array(
		"NAME" => Loc::GetMessage('SHOW_FORM_TITLE'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"TITLE_IN_PLACEHOLDER" => array(
		"NAME" => Loc::GetMessage('SHOW_FORM_TITLE'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "",
	),
	"AGREEMENT_LINK" => array(
		"NAME" => Loc::GetMessage('AGREEMENT_LINK'),
		"TYPE" => "STRING",
		"DEFAULT" => "/privacy-policy/",
	),
	"YA_TARGET_ID" => array(
		"NAME" => Loc::GetMessage('YA_TARGET_ID'),
		"TYPE" => "STRING",
	),
	"GT_TARGET_ID" => array(
		"NAME" => Loc::GetMessage('GT_TARGET_ID'),
		"TYPE" => "STRING",
	),
	"BUTTON_TEXT" => array(
		"NAME" => Loc::GetMessage('BUTTON_TEXT'),
		"TYPE" => "STRING",
	),
	"IGNORE_CUSTOM_TEMPLATE" => Array(
		"HIDDEN" => 'Y',
	),
	"USE_EXTENDED_ERRORS" => Array(
		"HIDDEN" => 'Y',
	),
	"LIST_URL" => Array(
		"HIDDEN" => 'Y',
	),
	"EDIT_URL" => Array(
		"HIDDEN" => 'Y',
	),
	"SUCCESS_URL" => Array(
		"HIDDEN" => 'Y',
	),
	"CHAIN_ITEM_TEXT" => Array(
		"HIDDEN" => 'Y',
	),
	"CHAIN_ITEM_LINK" => Array(
		"HIDDEN" => 'Y',
	),
);
