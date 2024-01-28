<?php

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Prexpert\Seofilter\RuleTable;
use Bitrix\Main\Context;
use Bitrix\Main\Application;
use \Bitrix\Main\Web\Uri;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/** @var array $arParams */


global $APPLICATION, $USER;

try {
	Loader::includeModule('prexpert.seofilter');
} catch (LoaderException $e) {
}
try {
	Loader::includeModule('iblock');
} catch (LoaderException $e) {
}

$request = Context::getCurrent()->getRequest();
$url = $request->getRequestedPageDirectory();

if (!$arParams['CACHE_TIME']) {
	$arParams['CACHE_TIME'] = '0';
}

$cache_id = serialize(array($arParams, ($arParams['CACHE_GROUPS'] === 'N' ? false : $USER->GetGroups())));
$obCache = new CPHPCache;

if ($obCache->InitCache($arParams['CACHE_TIME'], $cache_id, '/seofilter.set.meta/')) {
	$vars = $obCache->GetVars();
	$arResult = $vars;
} elseif ($obCache->StartDataCache()) {
	$arSelect = [
		"META_TITLE_WINDOW",
		"META_TITLE_H1",
		"META_BREADCRUMBS",
		"META_DESCRIPTION",
		"META_KEYWORDS",
		"META_TEXT_TOP",
		"META_TEXT_TOP_TYPE",
		"META_TEXT_BOTTOM",
		"META_TEXT_BOTTOM_TYPE",
		"META_TEXT_ADD",
		"META_TEXT_ADD_TYPE"
	];

	$arResult = RuleTable::getList([
		'order' => ['sort' => 'asc'],
		'filter' => [
			'ACTIVE' => 'Y',
			'LID' => SITE_ID,
			'FILTER_URL' => $url
		],
		'select' => $arSelect
	])->fetch();


	if (empty($arResult)) {
		return false;
	}

	$obCache->EndDataCache($arResult);
}

$this->includeComponentTemplate();
