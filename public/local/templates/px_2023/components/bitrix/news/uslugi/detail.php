<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;


Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services.css");


?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
	),
	$component
);?>
<?if($arParams["USE_RATING"]=="Y" && $ElementID):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.vote",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_ID" => $ElementID,
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);?>
<?endif?>
<?if($arParams["USE_CATEGORIES"]=="Y" && $ElementID):
	global $arCategoryFilter;
	$obCache = new CPHPCache;
	$strCacheID = $componentPath.LANG.$arParams["IBLOCK_ID"].$ElementID.$arParams["CATEGORY_CODE"];
	if(($tzOffset = CTimeZone::GetOffset()) <> 0)
		$strCacheID .= "_".$tzOffset;
	if($arParams["CACHE_TYPE"] == "N" || $arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "N")
		$CACHE_TIME = 0;
	else
		$CACHE_TIME = $arParams["CACHE_TIME"];
	if($obCache->StartDataCache($CACHE_TIME, $strCacheID, $componentPath))
	{
		$rsProperties = CIBlockElement::GetProperty($arParams["IBLOCK_ID"], $ElementID, "sort", "asc", array("ACTIVE"=>"Y","CODE"=>$arParams["CATEGORY_CODE"]));
		$arCategoryFilter = array();
		while($arProperty = $rsProperties->Fetch())
		{
			if(is_array($arProperty["VALUE"]) && count($arProperty["VALUE"])>0)
			{
				foreach($arProperty["VALUE"] as $value)
					$arCategoryFilter[$value]=true;
			}
			elseif(!is_array($arProperty["VALUE"]) && $arProperty["VALUE"] <> '')
				$arCategoryFilter[$arProperty["VALUE"]]=true;
		}
		$obCache->EndDataCache($arCategoryFilter);
	}
	else
	{
		$arCategoryFilter = $obCache->GetVars();
	}
	if(count($arCategoryFilter)>0):
		$arCategoryFilter = array(
			"PROPERTY_".$arParams["CATEGORY_CODE"] => array_keys($arCategoryFilter),
			"!"."ID" => $ElementID,
		);
		?>
		<hr /><h3><?=GetMessage("CATEGORIES")?></h3>
		<?foreach($arParams["CATEGORY_IBLOCK"] as $iblock_id):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				$arParams["CATEGORY_THEME_".$iblock_id],
				Array(
					"IBLOCK_ID" => $iblock_id,
					"NEWS_COUNT" => $arParams["CATEGORY_ITEMS_COUNT"],
					"SET_TITLE" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"FILTER_NAME" => "arCategoryFilter",
					"CACHE_FILTER" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
				),
				$component
			);?>
		<?endforeach?>
	<?endif?>
<?endif?>
<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<hr />
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"DATE_TIME_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"ELEMENT_ID" => $ElementID,
		"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"URL_TEMPLATES_DETAIL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);?>
<?endif?>
<?php

if($GLOBALS['EQUIPMENT_BLOCK_ELEMENT_TEXT']){
	?>
	<div class="equipment-top">
		<?php echo $GLOBALS['EQUIPMENT_BLOCK_ELEMENT_TEXT'];

		global $arrFilterEquipment;

		$GLOBALS['arrFilterEquipment']=array("ID"=> $GLOBALS['LINKS_FOR_EQUIP']);


		if ($GLOBALS['arrFilterEquipment']){
			?>
			<div class="equipment-top__carusel">
				<?
				$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"equipment",
						array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "/oborudovanie/#CODE#",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "N",
								"DISPLAY_PICTURE" => "N",
								"DISPLAY_PREVIEW_TEXT" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array(
										0 => "NAME",
										1 => "PREVIEW_TEXT",
										2 => "PREVIEW_PICTURE",
										3 => "",
								),
								"FILTER_NAME" => "arrFilterEquipment",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "10",
								"IBLOCK_TYPE" => "aspro_medc2_content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "7",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"PAGER_TITLE" => "Оборудование и технологии",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array(
										0 => "",
										1 => "",
								),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => "ACTIVE_FROM",
								"SORT_BY2" => "SORT",
								"SORT_ORDER1" => "DESC",
								"SORT_ORDER2" => "ASC",
								"STRICT_SECTION_CHECK" => "N",
								"COMPONENT_TEMPLATE" => "equipment"
						),
						false
				); ?>
			</div>
		<? } ?>
	</div>
	<?php
}

?>

<h2 class="title section-site__title">Акции</h2>
<?php

if ($GLOBALS['TEXT_UPPER_STOCK']) {
	?>
	<div class="uslugi_additional-text">
		<?
		echo $GLOBALS['TEXT_UPPER_STOCK'];

		?>
	</div>
	<?
}

global $arrFilterPromo;
$arrFilterPromo['PROPERTY_LINK_SERVICES'] = $serviceId;

$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"promo",
		array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "N",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", ""),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "9",
				"IBLOCK_TYPE" => "aspro_medc2_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "7",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array("", ""),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
		)
);

?>
<div class="button__container">
	<a href="/" class="button button--def equipment__button">cмотреть все акции</a>
</div>


<?php

global $arrFilterEquipment;

$GLOBALS['arrFilterEquipment']=array("ID"=> $GLOBALS['LINKS_FOR_EQUIP']);

if ($GLOBALS['LINKS_FOR_EQUIP']){

	?>
	<h2 class="title section-site__title">Оборудование</h2>
<?php

	if ($GLOBALS['TEXT_UPPER_EQUIP']) {
		?>
		<div class="uslugi_additional-text">
			<?
			echo $GLOBALS['TEXT_UPPER_EQUIP'];

			?>
		</div>
		<?
	}

	$APPLICATION->IncludeComponent(
			"zs:owl",
			"equipment",
			array(
					"COMPONENT_TEMPLATE" => "equipment",
					"IBLOCK_TYPE" => "aspro_medc2_content",
					"IBLOCK_ID" => "10",
					"OWL_COUNT" => "999",
					"PATH_JQUERY" => "",
					"PATH_OWL_LIB_JS" => "",
					"PATH_OWL_LIB_CSS" => "",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FIELD_CODE" => array(
							0 => "NAME",
							1 => "PREVIEW_TEXT",
							2 => "PREVIEW_PICTURE",
							3 => "",
					),
					"FILTER_NAME" => "arrFilterEquipment",
					"PROPERTY_CODE" => array(
							0 => "",
							1 => "",
					),
					"SHOW_PLACEHOLDER" => "N",
					"DETAIL_URL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"PARENT_SECTION" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"PROP_WIDTH" => "",
					"PROP_HEIGHT" => "",
					"BREAKPOINT_COUNT" => "1",
					"items" => "1",
					"dots" => "UNSET",
					"nav" => "N",
					"loop" => "N",
					"lazyLoad" => "UNSET",
					"autoplay" => "UNSET",
					"autoplayHoverPause" => "UNSET",
					"autoplayTimeout" => "7000",
					"autoplaySpeed" => "3000",
					"smartSpeed" => "1500",
					"autoWidth" => "UNSET",
					"margin" => "",
					"resolution_1" => "768",
					"items_1" => "3",
					"dots_1" => "UNSET",
					"nav_1" => "N",
					"loop_1" => "N",
					"lazyLoad_1" => "UNSET",
					"autoplay_1" => "UNSET",
					"autoplayHoverPause_1" => "UNSET",
					"autoplayTimeout_1" => "7000",
					"autoplaySpeed_1" => "3000",
					"smartSpeed_1" => "1500",
					"autoWidth_1" => "UNSET",
					"margin_1" => "",
					"resolution_2" => "",
					"items_2" => "",
					"dots_2" => "UNSET",
					"nav_2" => "UNSET",
					"loop_2" => "UNSET",
					"lazyLoad_2" => "UNSET",
					"autoplay_2" => "UNSET",
					"autoplayHoverPause_2" => "UNSET",
					"autoplayTimeout_2" => "7000",
					"autoplaySpeed_2" => "3000",
					"smartSpeed_2" => "1500",
					"autoWidth_2" => "UNSET",
					"margin_2" => ""
			),
			false
	);

	?>
	<div class="button__container">
		<a href="/oborudovanie/" class="button button--def equipment__button">cмотреть все</a>
	</div>
<?php
}
?>




<?php


$GLOBALS['arrFilterDocs']=array("ID"=> $GLOBALS['LINKS_FOR_STUFF']);

if ($GLOBALS['LINKS_FOR_STUFF']){

	?>

	<h2 class="title section-site__title">Врачи</h2>

	<?php

	if ($GLOBALS['TEXT_UPPER_DOCTORS']) {
		?>
		<div class="uslugi_additional-text">
			<?
			echo $GLOBALS['TEXT_UPPER_DOCTORS'];

			?>
		</div>
		<?
	}

	$APPLICATION->IncludeComponent(
			"zs:owl",
			"doctors",
			array(
					"COMPONENT_TEMPLATE" => "doctors",
					"IBLOCK_TYPE" => "aspro_medc2_content",
					"IBLOCK_ID" => "4",
					"OWL_COUNT" => "999",
					"PATH_JQUERY" => "",
					"PATH_OWL_LIB_JS" => "",
					"PATH_OWL_LIB_CSS" => "",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "SORT",
					"SORT_ORDER2" => "ASC",
					"FIELD_CODE" => array(
							0 => "NAME",
							1 => "PREVIEW_TEXT",
							2 => "PREVIEW_PICTURE",
							3 => "",
					),
					"FILTER_NAME" => "arrFilterDocs",
					"PROPERTY_CODE" => array(
							0 => "",
							1 => "",
					),
					"SHOW_PLACEHOLDER" => "N",
					"DETAIL_URL" => "#SITE_DIR#/doctors/#CODE#",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"PARENT_SECTION" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"PROP_WIDTH" => "100%",
					"PROP_HEIGHT" => "",
					"BREAKPOINT_COUNT" => "1",
					"items" => "1",
					"dots" => "Y",
					"nav" => "N",
					"loop" => "N",
					"lazyLoad" => "UNSET",
					"autoplay" => "UNSET",
					"autoplayHoverPause" => "UNSET",
					"autoplayTimeout" => "7000",
					"autoplaySpeed" => "3000",
					"smartSpeed" => "1500",
					"autoWidth" => "UNSET",
					"margin" => "",
					"resolution_1" => "768",
					"items_1" => "3",
					"dots_1" => "UNSET",
					"nav_1" => "UNSET",
					"loop_1" => "UNSET",
					"lazyLoad_1" => "UNSET",
					"autoplay_1" => "UNSET",
					"autoplayHoverPause_1" => "UNSET",
					"autoplayTimeout_1" => "7000",
					"autoplaySpeed_1" => "3000",
					"smartSpeed_1" => "1500",
					"autoWidth_1" => "UNSET",
					"margin_1" => "",
					"resolution_2" => "",
					"items_2" => "4",
					"dots_2" => "UNSET",
					"nav_2" => "UNSET",
					"loop_2" => "UNSET",
					"lazyLoad_2" => "UNSET",
					"autoplay_2" => "UNSET",
					"autoplayHoverPause_2" => "UNSET",
					"autoplayTimeout_2" => "7000",
					"autoplaySpeed_2" => "3000",
					"smartSpeed_2" => "1500",
					"autoWidth_2" => "UNSET",
					"margin_2" => ""
			),
			false
	);

	?>
	<div class="button__container">
		<a href="/doctors/" class="button button--def equipment__button">cмотреть всех врачей</a>
	</div>
<?php
}

?>


<section class="section-site">
	<div class="container">

		<div class="reviews">
			<?

			global $arrFilterEquipment;

			$GLOBALS['arrFilterReviews']=array("ID"=> $GLOBALS['LINKS_FOR_REVIEWS']);

			if($GLOBALS['LINKS_FOR_REVIEWS']){
				?>
				<h2 class="title section-site__title">Отзывы</h2>
			<?

				if ($GLOBALS['TEXT_UPPER_REVIEWS']) {
					?>
					<div class="uslugi_additional-text">
						<?
						echo $GLOBALS['TEXT_UPPER_REVIEWS'];

						?>
					</div>
					<?
				}

				$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"reviews",
						array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "N",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"COMPONENT_TEMPLATE" => "reviews",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "N",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array(
										0 => "NAME",
										1 => "PREVIEW_TEXT",
										2 => "PREVIEW_PICTURE",
										3 => "DATE_ACTIVE_FROM",
										4 => "DATE_ACTIVE_TO",
										5 => "",
								),
								"FILTER_NAME" => "arrFilterReviews",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "3",
								"IBLOCK_TYPE" => "aspro_medc2_content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "7",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array(0 => "", 1 => "",),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => "TIMESTAMP_X",
								"SORT_BY2" => "SORT",
								"SORT_ORDER1" => "DESC",
								"SORT_ORDER2" => "ASC",
								"STRICT_SECTION_CHECK" => "N"
						)
				);
				?>
				<div class="button__container">
					<a href="/pacientam/otzyvy/" class="button button--def equipment__button">cмотреть все</a>
				</div>
				<?
			}
			?>


		</div>
	</div>
</section>


<h2 class="title section-site__title price-title">Стоматология Одинцово: цены на услуги</h2>
<?php

if ($GLOBALS['TEXT_UPPER_PRICE']) {
	?>
	<div class="uslugi_additional-text uslugi_additional-text--price">
		<?
		echo $GLOBALS['TEXT_UPPER_PRICE'];

		?>
	</div>
	<?
}



$GLOBALS['arrFilterHits']=array("PROPERTY_SERVICES"=> array($GLOBALS['CUR_ELEMENT_ID']));

$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"prices-uslugi",
		array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => "prices-uslugi",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
						0 => "",
						1 => "",
				),
				"FILTER_NAME" => "arrFilterHits",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "28",
				"IBLOCK_TYPE" => "aspro_medc2_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "20",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
						0 => "OLD_PRICE",
						1 => "LINK_SERVICES",
						2 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
		),
		false
);

?>



<?php


$GLOBALS['arrFilterVoprosy']=array("ID"=> $GLOBALS['LINK_QUESTIONS']);

if ($GLOBALS['LINK_QUESTIONS']){

	?>

	<h2 class="title section-site__title">Вопрос-ответ</h2>

	<?php

	$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"otvety-uslug",
			array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"COMPONENT_TEMPLATE" => "otvety-uslug",
					"DETAIL_URL" => "/pacientam/vopros-otvet/#SECTION_CODE#/#CODE#",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
							0 => "",
							1 => "",
					),
					"FILTER_NAME" => "arrFilterVoprosy",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "6",
					"IBLOCK_TYPE" => "aspro_medc2_content",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "20",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
							0 => "VOPROS",
							1 => "NAME",
							2 => "OTVET",
							3 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_BY2" => "SORT",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "ASC",
					"STRICT_SECTION_CHECK" => "N"
			),
			false
	);

	?>

	<?php
}

?>


