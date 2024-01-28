<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$photos = [];
$thumbs = [];


foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo_id) {
	$photo = CFile::ResizeImageGet(
		$photo_id,
		['width' => 2500, 'height' => 2500],
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true,
		["name" => "sharpen", "precision" => 0],
		false,
		85
	);
	if (!isset($photo['src'])) {
		$photo['src'] = CFile::GetPath($photo_id);
	}
	$photos[$photo_id] = $photo;

	$thumb = CFile::ResizeImageGet(
		$photo_id,
		['width' => 300, 'height' => 900],
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true,
		["name" => "sharpen", "precision" => 0],
		false,
		90
	);
	if (!isset($thumb['src'])) {
		$thumb['src'] = $photos[$photo_id];
	}
	$thumbs[$photo_id] = $thumb;
}

$arResult['MOD']['PHOTOS'] = [
	'THUMBS' => $thumbs,
	'BIG' => $photos
];

// Получаем соседние элементы preview и next

$arFilter_neighbors = array(
	"IBLOCK_ID" => IntVal($arParams['IBLOCK_ID']),
	"ACTIVE_DATE" => "Y",
	"ACTIVE" => "Y",
);
if ($arResult['IBLOCK_SECTION_ID']) {
	$arFilter_neighbors['IBLOCK_SECTION_ID'] = $arResult['IBLOCK_SECTION_ID'];
}
$arOrder_neighbors = array("SORT" => "ASC", "ID" => 'ASC');
$res_neighbors = CIBlockElement::GetList(
	$arOrder_neighbors,
	$arFilter_neighbors,
	false,
	array("nElementID" => IntVal($arResult['ID']), "nPageSize" => 1),
	array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL")
);
$res_neighbors->SetUrlTemplates($urlTemplates);

$i = 0;
while ($ob_neighbors = $res_neighbors->GetNext()) {
	++$i;
	if ($ob_neighbors['ID'] == $arResult['ID']) {
		continue;
	}

	$goto = ($i === 1) ? 'prew' : 'next';
	$neighbors['ITEMS'][$goto] = array(
		'ID' => $ob_neighbors['ID'],
		'NAME' => $ob_neighbors['NAME'],
		'DETAIL_PAGE_URL' => $ob_neighbors['DETAIL_PAGE_URL'],
	);
}

$arResult['MOD']['NEIGHBORS'] = $neighbors;
