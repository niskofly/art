<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters = array(
	"SHOW_ICON" => array(
		"NAME" => "Показать иконку",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"LINK" => array(
		"NAME" => 'Url компании',
		"TYPE" => "STRING",
		"DEFAULT" => "https://www.prexpert.com/",
	),
	"SVG_SPRITE" => array(
		"NAME" => 'Спрайт svg',
		"TYPE" => "STRING",
		"DEFAULT" => "/local/templates/px_2023/assets/icons/svg-sprite.svg#prExpert",
	),
);
?>
