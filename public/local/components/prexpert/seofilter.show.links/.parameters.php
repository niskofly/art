<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SECTION_ID"),
			"DEFAULT" => '={$arCurSection["ID"]}',
		),
		"SORT_CATEGORY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SORT_CATEGORY"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"ASC" => 'А-Я',
				"DESC" => 'Я-А',
			),
		),
		"LINKS_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("LINKS_COUNT"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"10" => 10,
				"20" => 20,
				"30" => 30,
				"50" => 50,
				"100" => 100,
				"200" => 200,
				"500" => 500,
			),
			"DEFAULT" => 1,

		),
		"MULTIPLE_NAME" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MULTIPLE_NAME"),
			"TYPE" => "TEXT",
			"DEFAULT" => 'Популярное',

		),
		"MULTIPLE_PLACE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MULTIPLE_PLACE"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"TOP" => 'Сверху',
				"SORT" => 'В общем порядке',
				"BOTTOM" => 'Снизу',
			),
			"DEFAULT" => 'BOTTOM',

		),
		"SEPARATE_CATEGORIES" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SEPARATE_CATEGORIES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"CACHE_TIME" => array("DEFAULT" => 3600),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
?>
