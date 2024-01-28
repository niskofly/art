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
?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
	),
	$component
);
?>
<br />
<?endif?>

<h2 class="title section-site__title">Услуги стоматологии:
	виды и цены</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
	),
	$component
);?>

</div>
</div>

<div class="uslugi-top__top">

<h2 class="title section-site__title">АРТ: эстетическая и медицинская косметология</h2>
<div class="uslugi_text">
	<img src="/upload/medialibrary/2e7/y0betv0r2cteztn5jqtxvt9x05gbv9le/image.png" alt="" class="uslugi__image--left">
	<p>
		Отделение косметологии клиники АРТ в Одинцово – это идеальное сочетание новейших препаратов, инновационных технологий и современного оборудования. Красотой и здоровьем клиентов здесь занимаются косметологи с медицинским образованием и обширным опытом работы, умеющие находить решения для мужчин и женщин любого возраста.
		В нашем центре косметологии представлены услуги для разных целей и ситуаций. В АРТ помогут быстро и наименее болезненно скорректировать фигуру, вернуть молодость, оздоровить кожу, сделать выразительными контуры лица, избавиться от пигментных пятен, акне, раздражения, купероза.
		Кроме косметологических услуг у нас всегда в наличии профессиональная космецевтика. Косметические продукты с га
	</p>
</div>


<div class="equipment-top">
	<div class="equipment-top__preview">
		<div class="equipment-top__image">
			<img src="/local/templates/px_2023/assets/images/equipment.png" alt="Наше оборудование">
		</div>
	</div>
	<div class="equipment-top__wrapper">
		<div class="equipment-top__title">
			Аппаратная косметология в АРТ
		</div>
		<div class="equipment-top__description">
			<p>Наш центр косметологии – это выбор лучших в Одинцово услуг и инновационных технологий. Нашим клиентам мы предлагаем обертывания для похудения, безопасные высокоэффективные пилинги и мезотерапию, биоревитализацию и контурную пластику, ботулинотерапию, нитевой лифтинг и другие процедуры.
			</p>
			<p>Косметологи АРТ одни из первых в России начали работать с ICOONE Laser, способным омолаживать на клеточном уровне. Благодаря ICOONE Laser можно:
			</p>
			<ul>
				<li>Создать идеальное тело – подтянуть, омолодить, избавиться от жировых отложений;</li>
				<li>Снизить вес – благодаря лимфодренажу и липолизу;
				</li>
				<li>Забыть о целлюлите – уменьшить объемы, выровнять кожу;</li>
				<li>Очистить организм – детокс на клеточном уровне;
				</li>
				<li>Провести лечение – при варикозе, невралгии, проблемах с суставами;</li>
				<li>Ускорить реабилитацию после пластических операций;</li>
				<li>Восстановиться при спортивных травмах.</li>
			</ul>
			<p>
				Также аппаратная косметология в Одинцово представлена услугами IPL-терапия, бриллиантовый пилинг Clear Brilliant, фототерапия HELEO4, SMAS-лифтинг, GENEO+, а также другими инновациями.
			</p>
		</div>
		<a href="/oborudovanie/" class="equipment-top__link button button--def">Смотреть все
			оборудование</a>
	</div>
	<div class="equipment-top__carusel">
		<?

		$GLOBALS['arrFilterEquipmentBlock']=array("SECTION_ID" => 17);

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
		"FILTER_NAME" => "arrFilterEquipmentBlock",
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
</div>


</div>
</div>


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

$GLOBALS['arrFilterEquipments']=array("SECTION_ID" => 17);

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
				"FILTER_NAME" => "arrFilterEquipments",
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
				"nav_1" => "N",
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
	<a href="/oborudovanie/" class="button button--def equipment__button">cмотреть все оборудование</a>
</div>

<h2 class="title section-site__title">Врачи</h2>

<?php

$GLOBALS['arrFilterDoctors']=array("SECTION_ID" => 2);

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
				"FILTER_NAME" => "arrFilterDoctors",
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
	<a href="/doctors/" class="button button--def equipment__button">cмотреть всех врачей</a>
</div>

<section class="section-site">
	<div class="container">
		<h2 class="title section-site__title">Отзывы</h2>
		<div class="reviews">
			<?
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
			); ?>
		</div>
	</div>
</section>
<div class="button__container">
	<a href="/pacientam/otzyvy/" class="button button--def equipment__button">cмотреть все отзывы</a>
</div>
