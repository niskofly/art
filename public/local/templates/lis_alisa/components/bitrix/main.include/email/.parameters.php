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
	"SCHEMA_ORG" => array(
		"NAME" => "schema.org",
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
);
