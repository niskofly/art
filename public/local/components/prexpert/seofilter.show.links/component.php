<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Loader;
use Prexpert\Seofilter\RuleTable;

if (!Loader::includeModule('prexpert.seofilter') || !Loader::includeModule('iblock')) {
	return false;
}

if (empty($arParams['SECTION_ID'])) {
	$arParams['SECTION_ID'] = 0;
}

if (!isset($arParams['LINKS_COUNT'])) {
	$arParams['LINKS_COUNT'] = 500;
}

if (!$arParams['CACHE_TIME']) {
	$arParams['CACHE_TIME'] = '3600';
}


$cache_id = serialize(array($arParams, ($arParams['CACHE_GROUPS'] === 'N' ? false : $USER->GetGroups())));
$obCache = new CPHPCache;

if ($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, '/seofilter.show.links/')) {
	$vars = $obCache->GetVars();
	$arResult = $vars;
} elseif ($obCache->StartDataCache()) {
	$arSelect = ['ID', 'NAME', 'CATEGORY', 'SORT', 'NEW_URL', 'META_TITLE_WINDOW'];

	if (empty($arParams["SORT_BY"]) || empty($arParams["SORT_ORDER"])) {
		$arParams["SORT_BY"] = 'NAME';
		$arParams["SORT_ORDER"] = 'ASC';
	}

	$arRows = RuleTable::getList([
		'select' => $arSelect,
		'filter' => [
			'ACTIVE' => 'Y',
			'LID' => SITE_ID,
			'IBLOCK_ID' =>
				$arParams['IBLOCK_ID'],
			'SECTION_ID' => $arParams['SECTION_ID']
		],
		'order' => [
			$arParams["SORT_BY"] =>
				$arParams["SORT_ORDER"]
		],
		'limit' => $arParams['LINKS_COUNT']
	])->fetchAll();

	//// RESTRUCTURE ARRAY
	foreach ($arRows as $arRow) {
		$arResult[$arRow['CATEGORY']][] = $arRow;
	}

	//// SORT
	if ($arParams['SORT_CATEGORY'] == 'ASC') {
		ksort($arResult);
	} else {
		krsort($arResult);
	}

	//// MOVE POPULAR
	if ($arParams['MULTIPLE_PLACE'] != 'SORT' && isset($arParams['MULTIPLE_NAME'])) {
		$MultipleName = $arParams['MULTIPLE_NAME'];
		$arMultiple = [
			$MultipleName => $arResult[$arParams['MULTIPLE_NAME']]
		];

		unset($arResult[$MultipleName]);

		// TO TOP
		if ($arParams['MULTIPLE_PLACE'] == 'TOP') {
			$arResult = array_merge($arMultiple, $arResult);
		}
		// TO BOTTOM
		if ($arParams['MULTIPLE_PLACE'] == 'BOTTOM') {
			$arResult = array_merge($arResult, $arMultiple);
		}

		unset($arMultiple);
	}

	$obCache->EndDataCache($arResult);
}

$this->includeComponentTemplate();
?>
