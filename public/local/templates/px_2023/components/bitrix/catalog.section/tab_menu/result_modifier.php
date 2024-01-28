<?php

/** @var array $arParams */

/** @var array $arResult */

$arSection = [];

$arSectionFilter = [
	'IBLOCK_ID' => $arParams["IBLOCK_ID"],
	'DEPTH_LEVEL' => 2
];

$arSelect = ['IBLOCK_ID', 'ID', 'NAME'];
$arSectionResult = CIBlockSection::GetList(
	array("SORT" => "ASC"),
	$arSectionFilter,
	false,
	$arSelect
);
while ($sectionObj = $arSectionResult->Fetch()) {
	$arSection [$sectionObj['ID']]["NAME"] = $sectionObj['NAME'];
}


foreach ($arResult["ITEMS"] as $arItem) {
	$arSection [$arItem['IBLOCK_SECTION_ID']]["ITEMS"][] = $arItem;
}

if (empty($arSection)) {
	$arSection[] = [
		'NAME' => 'noname',
		'ITEMS' => $arResult["ITEMS"]
	];
}

$arResult['SECTIONS'] = $arSection;

