<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"LINK" => array(
		"NAME" => Loc::getMessage('LOGO_LINK'),
		"TYPE" => "STRING",
		"DEFAULT" => "/",
	),
	"NO_FOLLOW" => array(
		"NAME" => Loc::getMessage('LOGO_NO_FOLLOW'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"IMG" => array(
		"NAME" => Loc::getMessage('LOGO_IMAGE'),
		"TYPE" => "STRING",
		"DEFAULT" => SITE_TEMPLATE_PATH . "/assets/images/logo.png",
	),
	"IMG_BIG" => array(
		"NAME" => Loc::getMessage('LOGO_IMAGE_BIG'),
		"TYPE" => "STRING",
		"DEFAULT" => SITE_TEMPLATE_PATH . "/assets/images/logo.png",
	),
	"ALT" => array(
		"NAME" => Loc::getMessage('LOGO_IMAGE_ALT'),
		"TYPE" => "STRING",
		"DEFAULT" => "Логотип компании",
	)
);
