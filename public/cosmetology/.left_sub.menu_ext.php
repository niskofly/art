<?php
/** @var Array $aMenuLinks */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"prexpert:menu.sections.elements",
	"new-sections",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DEPTH_LEVEL" => "4",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#",
		"IBLOCK_ID" => "33",
		"IBLOCK_TYPE" => "aspro_medc2_content",
		"ID" => $_REQUEST["ID"],
		"IS_SEF" => "Y",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"SECTION_URL" => "",
		"SEF_BASE_URL" => "/cosmetology/"
	)
);






$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
