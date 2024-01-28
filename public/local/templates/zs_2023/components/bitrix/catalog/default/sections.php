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

$this->setFrameMode(true);

$sectionListParams = [
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
	"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
	"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
	"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
	"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
	"HIDE_SECTION_NAME" => ($arParams["SECTIONS_HIDE_SECTION_NAME"] ?? "N"),
	"ADD_SECTIONS_CHAIN" => ($arParams["ADD_SECTIONS_CHAIN"] ?? '')
];
if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
	$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
	if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
	}
}
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"default",
	$sectionListParams,
	$component,
	($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? ["HIDE_ICONS" => "Y"] : [])
);
unset($sectionListParams);
?>
<div class="block">
	<?php
	$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"with_image",
	array(
		"PATH" => SITE_TEMPLATE_PATH."/assets/include_areas/company_text.php",
		"COMPONENT_TEMPLATE" => "with_image",
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"SHOW_ICON" => "N",
		"SCHEMA_ORG" => "N",
		"IMAGE" => "/upload/medialibrary/3c1/p5atu3bj3h420akw1lsrfjvi6ujuq3xd/comp.png",
		"TITLE" => "Уважаемые покупатели!"
	),
	false
); ?>
</div>
