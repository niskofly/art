<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?
// get section items count and subsections
$arItemFilter = CMedc2::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams, false);
$arSubSectionFilter = CMedc2::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, false);
$itemsCnt = CCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSubSections = CCache::CIBlockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")),
    $arSubSectionFilter, false, array("ID"));

// rss
if ($arParams['USE_RSS'] !== 'N') {
    CMedc2::ShowRSSIcon($arResult['FOLDER'] . $arResult['URL_TEMPLATES']['rss']);
}
?>
<? global $arTheme ?>
<? if ($arParams['SECTIONS_TYPE_VIEW'] != 'sections_3'): ?>
<div class="row">
    <? if ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
    <div class="col-md-9 col-sm-12 col-xs-12 content-md">
        <? CMedc2::get_banners_position('CONTENT_TOP'); ?>
        <? elseif ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
        <div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
            <? CMedc2::ShowPageType('left_block') ?>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 content-md">
            <? CMedc2::get_banners_position('CONTENT_TOP'); ?>
            <? endif; ?>
            <? endif ?>

            <? if (!$itemsCnt && !$arSubSections): ?>
                <div class="alert alert-warning"><?= GetMessage("SECTION_EMPTY") ?></div>
            <? else: ?>
                <? // intro text?>
                <div class="text_before_items">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "page",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => ""
                        )
                    ); ?>
                </div>

                <? // sections?>
                <? @include_once('page_blocks/' . $arParams["SECTIONS_TYPE_VIEW"] . '.php'); ?>

                <? // section elements?>
                <? if (strlen($arParams["FILTER_NAME"])): ?>
                    <? $GLOBALS[$arParams["FILTER_NAME"]] = array_merge((array)$GLOBALS[$arParams["FILTER_NAME"]], $arItemFilter); ?>
                <? else: ?>
                    <? $arParams["FILTER_NAME"] = "arrFilter"; ?>
                    <? $GLOBALS[$arParams["FILTER_NAME"]] = $arItemFilter; ?>
                <? endif; ?>

                <? @include_once('page_blocks/' . $arParams["SECTION_ELEMENTS_TYPE_VIEW"] . '.php'); ?>
            <? endif; ?>
            <? if ($arParams['SECTIONS_TYPE_VIEW'] != 'sections_3'): ?>
            <? if ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
            <? CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
        </div><? // class=col-md-9 col-sm-9 col-xs-8 content-md?>
        <? elseif ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
        <? CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
    </div><? // class=col-md-9 col-sm-9 col-xs-8 content-md?>
    <div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
        <? CMedc2::ShowPageType('left_block') ?>
    </div>
<? endif; ?>
</div>
<? endif ?>
