<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
	"TITLE" => array(
		"NAME" => "Заголовок",
		"TYPE" => "STRING",
		"DEFAULT" => ""
	),
	"BUTTON_TEXT" => array(
		"NAME" => "Текст на кнопке",
		"TYPE" => "STRING",
		"DEFAULT" => "Список всех наших проектов"
	),
	"LINK" => array(
		"NAME" => "Ссылка с кнопки",
		"TYPE" => "STRING",
		"DEFAULT" => "Список всех наших проектов"
	),


);
