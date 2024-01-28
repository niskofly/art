<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"IMAGE" => array(
		"PARENT" => "BASE",
		"NAME" => Loc::getMessage('WITH_IMAGE_IMAGE'),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => ['jpg', 'jpeg', 'png', 'svg'],
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
		"FD_MEDIALIB_TYPES" => array('image'),
		"DEFAULT" => "",
	),
	"TITLE" => array(
		"NAME" => "Закголовок",
		"TYPE" => "STRING",
	),
	"BUTTON_TEXT" => array(
		"NAME" => "Текст кнопки",
		"TYPE" => "STRING",
	),
	"BUTTON_LINK" => array(
		"NAME" => "Ссылка кнопки",
		"TYPE" => "STRING",
	),
);
