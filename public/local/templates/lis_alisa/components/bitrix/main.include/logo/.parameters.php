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
	"HIDE_TEXT" => array(
		"NAME" => Loc::getMessage('LOGO_HIDE_TEXT'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"IMG" => array(
		"PARENT" => "BASE",
		"NAME" => Loc::getMessage('LOGO_IMAGE'),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png', 'svg'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => SITE_TEMPLATE_PATH . "/assets/images/logo.svg",
	),
	"IMG_BIG" => array(
		"PARENT" => "BASE",
		"NAME" => Loc::getMessage('LOGO_IMAGE_BIG'),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png', 'svg'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => "",
	),
	"ALT" => array(
		"NAME" => Loc::getMessage('LOGO_IMAGE_ALT'),
		"TYPE" => "STRING",
		"DEFAULT" => "Логотип компании",
	)
);
