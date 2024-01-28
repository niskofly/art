<?php

use Bitrix\Iblock\SectionTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/** @var array $arParams */
/** @var array $arResult */

$arSections = [];
$rsSection = SectionTable::getList(
	[
		'filter' => [
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		],
		'select' => ['ID', 'NAME', 'PICTURE'],
	]
);

while ($arSectionValue = $rsSection->fetch()) {
	$arSections[$arSectionValue['ID']] = $arSectionValue;
}

foreach ($arResult['ITEMS'] as $arItem) {
	$arSections[$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}
foreach ($arSections as $arSectionKey => $arSectionValue) {
	if (!isset($arSectionValue['ITEMS']) || empty($arSectionValue['ITEMS'])) {
		unset($arSections[$arSectionKey]);
	}
}
$arResult['TREE'] = $arSections;
