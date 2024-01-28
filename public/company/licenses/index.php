<?
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Реквизиты компании АРТ");
$APPLICATION->SetPageProperty(
		"description",
		"Контакты стоматологии АРТ. Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetPageProperty(
		"title",
		"Лицензии стоматологии АРТ. Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetTitle("Лицензии и сертификаты");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");
?>
<style>
	.section-site .site-licenses{
		display: none;
	}

	.section-site .title{
		display: none;
	}
</style>
<div class="page-company">
	<div class="container">
		<div class="with-sidebar">
			<div class="with-sidebar__sidebar-menu">
				<?
				$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"company",
						array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "left_sub",
								"COMPONENT_TEMPLATE" => "simple",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => "",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "left",
								"USE_EXT" => "Y"
						)
				); ?>
			</div>
			<div class="with-sidebar__main-content">
				<div class="site-licenses">
					<?php
					$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"licenses",
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
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array("NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", ""),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "7",
									"IBLOCK_TYPE" => "aspro_medc2_content",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "10",
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
					); ?>

				</div>
			</div>
		</div>
	</div>
</div>


<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
