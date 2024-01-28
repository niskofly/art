<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

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


foreach ($arResult["ITEMS"] as $key => $arItem) {
	$jobsText = '';
	$jobsMin = (int)$arItem['PROPERTIES']['JOBS_MIN']['VALUE'] ?? 0;
	$jobsMax = (int)$arItem['PROPERTIES']['JOBS_MAX']['VALUE'] ?? 0;
	if ($jobsMax > 0 || $jobsMin > 0) {
		if ($jobsMax <= 0) {
			$jobsText = Loc::getMessage('AL_LICENSES_MORE', ['num' => $jobsMin]);
		} else {
			$jobsText = $jobsMin . '-' . $jobsMax;
		}

		$jobsText .= Loc::getMessage('AL_LICENSES_JOBS');
	}

	$arResult["ITEMS"][$key]['AL_DISPLAY_PROPERTIES']['JOBS'] = $jobsText;


	$analyzersText = '';
	$analyzersMin = (int)$arItem['PROPERTIES']['ANALYZERS_MIN']['VALUE'] ?? 0;
	$analyzersMax = (int)$arItem['PROPERTIES']['ANALYZERS_MAX']['VALUE'] ?? 0;

	if ($analyzersMax > 0 || $analyzersMin > 0) {
		if ($analyzersMax <= 0) {
			$analyzersText = Loc::getMessage('AL_LICENSES_MORE', ['num' => $analyzersMin]);
		} else {
			$analyzersText = $analyzersMin . '-' . $analyzersMax;
		}

		$analyzersText .= ' ' . Loc::getMessage('AL_LICENSES_ANALYZERS');
	}
	$arResult["ITEMS"][$key]['AL_DISPLAY_PROPERTIES']['ANALYZERS'] = $analyzersText;


	$priceText = '';
	$priceMin = number_format((int)$arItem['PROPERTIES']['PRICE_MIN']['VALUE'] ?? 0, 0, ',', ' ');
	$priceMax = number_format((int)$arItem['PROPERTIES']['PRICE_MAX']['VALUE'] ?? 0, 0, ',', ' ');


	if ($priceMax > 0 || $priceMin > 0) {
		if ($priceMax <= 0) {
			$priceText = Loc::getMessage('AL_LICENSES_MORE', ['num' => $priceMin]);
		} else {
			$priceText = $priceMin . ' - ' . $priceMax;
		}
		$priceText .= ' ' . Loc::getMessage('AL_LICENSES_PRICE');
	}
	$arResult["ITEMS"][$key]['AL_DISPLAY_PROPERTIES']['PRICE'] = $priceText;
}
