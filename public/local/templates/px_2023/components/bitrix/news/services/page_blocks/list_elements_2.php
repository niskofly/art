<?// staff links?>
<?/*if(!empty($arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'])):?>
    <div class="wraps">
        <h4><?=count($arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE']) > 1 ? "Специалисты" : "Специалист";?></h4>
        <?global $arrrFilter; $arrrFilter = array('ID' => $arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE']);?>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "staff-slider", array(
            "IBLOCK_TYPE" => "aspro_medc2_content",
            "IBLOCK_ID" => 4,
            "NEWS_COUNT" => "30",
            "SORT_BY1" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "",
            "SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrrFilter",
            "FIELD_CODE" => array(
                0 => "NAME",
                1 => "PREVIEW_TEXT",
                2 => "PREVIEW_PICTURE",
                3 => "",
            ),
            "PROPERTY_CODE" => array(
                0 => "EMAIL",
                1 => "POST",
                2 => "PHONE",
                3 => "LINK_ADDRESS",
            ),
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "PREVIEW_TRUNCATE_LEN" => "",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "SET_TITLE" => "N",
            //"SET_TITLE"	=>	$arParams["SET_TITLE"],
            //"SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "Y",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "PAGER_TEMPLATE" => "",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            //"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "VIEW_TYPE" => "table",
            "SHOW_TABS" => "N",
            "SHOW_SECTION_PREVIEW_DESCRIPTION" => "N",
            "IMAGE_POSITION" => "left",
            "COUNT_IN_LINE" => "3",
            "AJAX_OPTION_ADDITIONAL" => "",
        ),
            false, array("HIDE_ICONS" => "Y")
        );?>
    </div>
<?endif;*/?>
<?
// Проставление title, description в head странице, а так же заголовка страницы и добавление его в хлебные крошки

if($arResult["VARIABLES"]["SECTION_ID"]) {
    $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
        $arParams["IBLOCK_ID"],
        $arResult["VARIABLES"]["SECTION_ID"]
    );

    $arSectionSeo = $ipropValues->getValues();

    $APPLICATION->SetPageProperty("title", $arSectionSeo["SECTION_META_TITLE"]);
    $APPLICATION->SetPageProperty("description", $arSectionSeo["SECTION_META_DESCRIPTION"]);

    $rsSect = CIBlockSection::GetList([], ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["VARIABLES"]["SECTION_ID"]], false, ["NAME", "SECTION_PAGE_URL"]);

    if($arSect = $rsSect->GetNext()) {
        $APPLICATION->SetTitle($arSect["NAME"]);
        $APPLICATION->AddChainItem($arSect["NAME"], $arSect["SECTION_PAGE_URL"]);
    }
}

?>

<?/*$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"elements-list-2",
	Array(
		"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
		"S_ORDER_SERVICE" => $arParams["S_ORDER_SERVICE"],
		"T_GALLERY" => $arParams["T_GALLERY"],
		"T_DOCS" => $arParams["T_DOCS"],
		"T_GOODS" => $arParams["T_GOODS"],
		"T_SERVICES" => $arParams["T_SERVICES"],
		"T_PROJECTS" => $arParams["T_PROJECTS"],
		"T_REVIEWS" => $arParams["T_REVIEWS"],
		"T_STAFF" => $arParams["T_STAFF"],
		"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
		"SHOW_SECTION_DESCRIPTION" => $arParams["SHOW_SECTION_DESCRIPTION"],
		"LINE_ELEMENT_COUNT_LIST" => $arParams["LINE_ELEMENT_COUNT_LIST"],
		"SHOW_IMAGE" => $arParams["SHOW_IMAGE"],
		"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	"50",
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	"N",
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"INCLUDE_SUBSECTIONS" => "N",
		"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
		"S_RECORD_ONLINE" => $arParams["S_RECORD_ONLINE"]
	),
	$component
);*/?>