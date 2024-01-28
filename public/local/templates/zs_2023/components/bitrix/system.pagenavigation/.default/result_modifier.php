<?php

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

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);

$arPages = [];

const FIRST_PAGE_NUM = 1;
const SHOW_PAGES_DEFAULT = 3; // Отобразить n страниц, Должно быть нечётным, иначе будет плохо делиться. Ниже принудительно приведём к нечётному

$showPagesDefault = (SHOW_PAGES_DEFAULT % 2 === 0) ? SHOW_PAGES_DEFAULT - 1 : SHOW_PAGES_DEFAULT;

if ($arResult['NavPageCount'] > 1 || $arResult['NavShowAlways']) {
	$currentPageNum = (int) $arResult["NavPageNomer"];
	$lastPageNum = (int) $arResult['NavPageCount'];

	$showPages = ($showPagesDefault > $lastPageNum) ? $lastPageNum : $showPagesDefault;

	$startShowPagesNum = $currentPageNum - floor($showPages / 2);
	if ($startShowPagesNum < FIRST_PAGE_NUM) {
		$startShowPagesNum = FIRST_PAGE_NUM;
	}

	$finishShowPagesNum = $currentPageNum + floor($showPages / 2);
	if ($finishShowPagesNum > $lastPageNum) {
		$finishShowPagesNum = $lastPageNum;
	}

	$backSeparator = ($currentPageNum >= $showPagesDefault);
	$forwardSeparator = ($currentPageNum < $lastPageNum-floor($showPages / 2));

	if ($startShowPagesNum < 0) {
		$startShowPagesNum = FIRST_PAGE_NUM;
	} elseif (($startShowPagesNum + $showPages) > $lastPageNum) {
		$startShowPagesNum = $lastPageNum - $showPages + 1;
	}
	$arPages['first'] = [
		'name' => 'Первая страница',
		'label' => '<<',
		'num' => FIRST_PAGE_NUM,
		'url' => $uri->addParams(['PAGEN_' . $arResult["NavNum"] => FIRST_PAGE_NUM])->getUri(),
		'class' => [],
	];
	$arPages['previous'] = [
		'name' => 'Предыдущая страница',
		'label' => '<',
		'num' => $currentPageNum - 1,
		'url' => $uri->addParams(['PAGEN_' . $arResult["NavNum"] => $currentPageNum - 1])->getUri(),
		'class' => [],
	];
	if($currentPageNum === FIRST_PAGE_NUM) {
		$arPages['first']['class'][] = $arPages['previous']['class'][] = "disabled";
		unset(
			$arPages['first']['url'],
			$arPages['previous']['url']
		);
	}

	if ($backSeparator) {
		$arPages['separator_back'] = [
			'name' => '',
			'label' => '...',
			'class' => ['separator'],
		];
	}

	for ($i = 1; $i <= $showPages; $i++) {
		$page = $startShowPagesNum++;
		$arPages[$page] = [
			'name' => 'Cтраница ' . $page,
			'label' => $page,
			'num' => $page,
			'class' => [],
		];

		if ($page == $currentPageNum) {
			$arPages[$page]['class'][] = 'active';
		} else {
			if ($page == 1) {
				$arPages[$page]['url'] = $uri->deleteParams(['PAGEN_' . $arResult["NavNum"]])->getUri();
			} else {
				$arPages[$page]['url'] = $uri->addParams(['PAGEN_' . $arResult["NavNum"] => $page])->getUri();
			}
		}
	}

	if ($forwardSeparator) {
		$arPages['separator_forward'] = [
			'name' => '',
			'label' => '...',
			'class' => ['separator'],
		];
	}

	$arPages['next'] = [
		'name' => 'Следующая страница',
		'label' => '>',
		'num' => $currentPageNum + 1,
		'url' => $uri->addParams(['PAGEN_' . $arResult["NavNum"] => $currentPageNum + 1])->getUri(),
		'class' => [],
	];
	$arPages['last'] = [
		'name' => 'Последняя страница',
		'label' => '>>',
		'num' => $lastPageNum,
		'url' => $uri->addParams(['PAGEN_' . $arResult["NavNum"] => $lastPageNum])->getUri(),
		'class' =>[],
	];
	if($currentPageNum === $lastPageNum) {
		$arPages['next']['class'][] = $arPages['last']['class'][] = "disabled";
		unset(
			$arPages['next']['url'],
			$arPages['last']['url']
		);
	}
}

$arResult['MOD']['PAGES'] = $arPages;
