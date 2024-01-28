<?

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
use Bitrix\Main\Page\Asset;

$this->setFrameMode(true);

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services.css");
?>


	<div class="dentistry-page">
		<div class="container">
			<div class="with-sidebar">
				<div class="with-sidebar__sidebar-menu">
					<?
					$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"new_multilevel",
							array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left_sub",
									"DELAY" => "N",
									"MAX_LEVEL" => "4",
									"MENU_CACHE_GET_VARS" => array(),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_USE_GROUPS" => "N",
									"ROOT_MENU_TYPE" => "left_sub",
									"USE_EXT" => "Y",
									"COMPONENT_TEMPLATE" => "new_multilevel"
							),
							false
					); ?>
				</div>
				<div class="with-sidebar__main-content">

					<?php

					$sectionListParams = array(
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
							"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
							"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
					);
					if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
						$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
						if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
							$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
						}
					}
					$APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"first",
							$sectionListParams,
							$component,
							($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
					);
					unset($sectionListParams);

					?>



					<h2 class="title section-site__title">Акции</h2>
					<?php

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
					<h2 class="title section-site__title">Оборудование</h2>
					<?php

					global $arrFilterEquipment;

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
									"FILTER_NAME" => "arrFilterPromo",
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
									"PROP_WIDTH" => "100%",
									"PROP_HEIGHT" => "",
									"BREAKPOINT_COUNT" => "1",
									"items" => "1",
									"dots" => "Y",
									"nav" => "N",
									"loop" => "Y",
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
						<a href="/" class="button button--def equipment__button">cмотреть все</a>
					</div>
					<h2 class="title section-site__title">Врачи</h2>
					<?php


					global $arrFilterDoctors;

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
									"FILTER_NAME" => "arrFilterPromo",
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
									"PROP_WIDTH" => "100%",
									"PROP_HEIGHT" => "",
									"BREAKPOINT_COUNT" => "1",
									"items" => "1",
									"dots" => "Y",
									"nav" => "N",
									"loop" => "Y",
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
						<a href="/" class="button button--def equipment__button">cмотреть всех врачей</a>
					</div>

					<section class="section-site">
						<div class="container">
							<h2 class="title section-site__title">Отзывы</h2>
							<div class="reviews">
								<?php
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
												"FILTER_NAME" => "",
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
												"SORT_BY1" => "TIMESTAMP_X",
												"SORT_BY2" => "SORT",
												"SORT_ORDER1" => "DESC",
												"SORT_ORDER2" => "ASC",
												"STRICT_SECTION_CHECK" => "N"
										),
										false
								); ?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>


