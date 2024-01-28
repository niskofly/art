<?php
/** @var Array $aMenuLinks */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	array(
		"ID" => $_REQUEST["ELEMENT_ID"],
		"IBLOCK_TYPE" => "aspro_medc2_catalog",
		"IBLOCK_ID" => "21",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"CACHE_TIME" => "3600",
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#",
		"DEPTH_LEVEL" => "1",
		"CACHE_TYPE" => "A"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
