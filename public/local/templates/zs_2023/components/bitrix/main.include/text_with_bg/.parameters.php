<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"BG" => array(
		"NAME" => Loc::getMessage('TEXT_WITH_BG_BG'),
		"PARENT" => "BASE",
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => "",
	),
	"TEXT_POSITION" => array(
		"NAME" => Loc::getMessage("TEXT_WITH_BG_TEXT_POSITION"),
		"TYPE" => "LIST",
		'VALUES' => [
			'left' => Loc::getMessage('TEXT_WITH_BG_TEXT_POSITION_LEFT'),
			'right' => Loc::getMessage('TEXT_WITH_BG_TEXT_POSITION_RIGHT'),
		],
		'DEFAULT' => 'left',
	),
);
