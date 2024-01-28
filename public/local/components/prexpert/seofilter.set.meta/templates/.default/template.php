<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
global $APPLICATION;

// TITLE
if (!empty($arParams['OWN']['TITLE_WINDOW'])) {
	$APPLICATION->SetTitle($arParams['OWN']['TITLE_WINDOW']);
} else {
	if (!empty($arResult['META_TITLE_WINDOW'])) {
		$APPLICATION->SetTitle($arResult['META_TITLE_WINDOW']);
	}
}

// H1
if (!empty($arParams['OWN']['TITLE_H1'])) {
	$APPLICATION->SetPageProperty("title", $arParams['OWN']['TITLE_H1']);
} else {
	if (!empty($arResult['META_TITLE_H1'])) {
		$APPLICATION->SetPageProperty("title", $arResult['META_TITLE_H1']);
	}
}

// BREADCRUMBS
if (!empty($arParams['OWN']['BREADCRUMBS'])) {
	$APPLICATION->AddChainItem($arParams['OWN']['BREADCRUMBS'], '');
} else {
	if (!empty($arResult['META_BREADCRUMBS'])) {
		$APPLICATION->AddChainItem($arResult['META_BREADCRUMBS'], '');
	}
}

// KEYWORDS
if (!empty($arParams['OWN']['KEYWORDS'])) {
	$APPLICATION->SetPageProperty("keywords", $arParams['OWN']['KEYWORDS']);
} else {
	if (!empty($arResult['META_KEYWORDS'])) {
		$APPLICATION->SetPageProperty("keywords", $arResult['META_KEYWORDS']);
	}
}

// DESCRIPTION
if (!empty($arParams['OWN']['DESCRIPTION'])) {
	$APPLICATION->SetPageProperty("description", $arParams['OWN']['DESCRIPTION']);
} else {
	if (!empty($arResult['META_DESCRIPTION'])) {
		$APPLICATION->SetPageProperty("description", $arResult['META_DESCRIPTION']);
	}
}

// TEXT_TOP
if ($arParams['OWN']['TEXT_TOP_TYPE'] == 'text') {
	$arResult['META_TEXT_TOP'] = $arParams['OWN']['TEXT_TOP'];
} else {
	if ($arResult['META_TEXT_TOP_TYPE'] == 'text') {
		$arResult['META_TEXT_TOP'] = $arResult['META_TEXT_TOP'];
	}
}
if ($arParams['OWN']['TEXT_TOP_TYPE'] == 'html') {
	$arResult['META_TEXT_TOP'] = html_entity_decode($arParams['OWN']['TEXT_TOP']);
} else {
	if ($arResult['META_TEXT_TOP_TYPE'] == 'html') {
		$arResult['META_TEXT_TOP'] = html_entity_decode($arResult['META_TEXT_TOP']);
	}
}
$APPLICATION->AddViewContent('META_TEXT_TOP', $arResult['META_TEXT_TOP']);

// TEXT_BOTTOM
if ($arParams['OWN']['TEXT_BOTTOM_TYPE'] == 'text') {
	$arResult['META_TEXT_BOTTOM'] = $arParams['OWN']['TEXT_BOTTOM'];
} else {
	if ($arResult['META_TEXT_BOTTOM_TYPE'] == 'text') {
		$arResult['META_TEXT_BOTTOM'] = $arResult['META_TEXT_BOTTOM'];
	}
}
if ($arParams['OWN']['TEXT_BOTTOM_TYPE'] == 'html') {
	$arResult['META_TEXT_BOTTOM'] = html_entity_decode($arParams['OWN']['TEXT_BOTTOM']);
} else {
	if ($arResult['META_TEXT_BOTTOM_TYPE'] == 'html') {
		$arResult['META_TEXT_BOTTOM'] = html_entity_decode($arResult['META_TEXT_BOTTOM']);
	}
}
$APPLICATION->AddViewContent('META_TEXT_BOTTOM', $arResult['META_TEXT_BOTTOM']);

// TEXT_ADD
if ($arParams['OWN']['TEXT_ADD_TYPE'] == 'text') {
	$arResult['META_TEXT_ADD'] = $arParams['OWN']['TEXT_ADD'];
} else {
	if ($arResult['META_TEXT_ADD_TYPE'] == 'text') {
		$arResult['META_TEXT_ADD'] = $arResult['META_TEXT_ADD'];
	}
}
if ($arParams['OWN']['TEXT_ADD_TYPE'] == 'html') {
	$arResult['META_TEXT_ADD'] = html_entity_decode($arParams['OWN']['TEXT_ADD']);
} else {
	if ($arResult['META_TEXT_ADD_TYPE'] == 'html') {
		$arResult['META_TEXT_ADD'] = html_entity_decode($arResult['META_TEXT_ADD']);
	}
}
$APPLICATION->AddViewContent('META_TEXT_ADD', $arResult['META_TEXT_ADD']);
