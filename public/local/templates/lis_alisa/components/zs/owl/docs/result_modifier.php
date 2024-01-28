<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */

$filters = [];

if ($arParams['USE_JS_FILTER'] == "Y") {
	$ar_sections = [];
	$res_sections = CIBlockSection::GetList(
		["SORT" => "ASC"],
		$arFilter = [
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'GLOBAL_ACTIVE' => 'Y',
			'DEPTH_LEVEL' => 1,

		],
		$bIncCnt = false,
		$Select = ['IBLOCK_ID', 'ID', 'NAME'],
		$NavStartParams = false
	);

	if ($arParams['JS_FILTER_SHOW_ALL'] == "Y") {
		$filters['ITEMS'][] = ["NAME" => $arParams['JS_FILTER_SHOW_ALL_TEXT'], "ID" => "all"];
	}

	while ($ar_section = $res_sections->fetch()) {
		$filters['ITEMS'][] = $ar_section;
	}
	$arResult['MOD_FILTER'] = $filters;
}
