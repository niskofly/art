<?php

use Bitrix\Main\Localization\Loc;

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
$this->setFrameMode(true);

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/tail_doc.css');

$output = [];
foreach ($arResult['TREE'] as $arSection) {

	if (!isset($arSection['ITEMS']) || empty($arSection['ITEMS'])) {
		continue;
	}
	$output[] = [
		$arSection['NAME'],
		$arSection['SECTION_PAGE_URL'],
		[$arSection['SECTION_PAGE_URL']],
		[
			'FROM_IBLOCK' => true,
			'IS_PARENT' => true,
			'DEPTH_LEVEL' => 1,
		],

	];


	foreach ($arSection['ITEMS'] as $arItem) {
		$output[] = [
			$arItem['NAME'],
			$arItem['DETAIL_PAGE_URL'],
			[$arItem['DETAIL_PAGE_URL']],
			[
				'FROM_IBLOCK' => true,
				'IS_PARENT' => false,
				'DEPTH_LEVEL' => 2,
			],

		];
	}
}
$arResult['OUTPUT'] = $output;
$this->getComponent()->SetResultCacheKeys(['OUTPUT']);
