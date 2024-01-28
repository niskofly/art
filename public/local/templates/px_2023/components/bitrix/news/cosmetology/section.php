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


$rsSections = CIBlockSection::GetList(array(),
		array('IBLOCK_ID' => $arParams ['IBLOCK_ID'], '=CODE' => $arResult['VARIABLES']['SECTION_CODE']));
if ($arSection = $rsSections->Fetch()) {
	$arSectionID = $arSection['ID'];
}

$fSections = CIBlockSection::GetList(
		false,
		array(
				"IBLOCK_ID" => 33,
				"ID" => $arSectionID,
				"ACTIVE" => "Y",
				"GLOBAL_ACTIVE" => "Y",
				"SECTION_ACTIVE" => "Y"
		),
		false,
		array(
				'UF_LINK_STAFF1',
				'UF_LINK_EQUIPMENT1',
				'UF_LINK_REVIEWS1',
				'UF_STOCK_TEXT1',
				'UF_DOCTORS_TEXT1',
				'UF_EQUIP_TEXT1',
				'UF_REVIEWS_TEXT1',
				'UF_BLOCK_EQUIP1',
				'UF_ADVANTAGES_ST1',
				'UF_LINK_QUESTIONS1',
				'UF_TEXT_UPPER__SECTION_PRICE1',
		),
		false
);
$flSections = $fSections->Fetch();


global $bannerImg;

$arrIMG = $arSection["DETAIL_PICTURE"];


$this->SetViewTarget('bannerImage');


if ($arrIMG) {
	$image_src = CFile::GetPath($arrIMG);
	?>
	<img src="<?= $image_src ?>" alt="banner">

	<?php
} else {
	?>
	<img src="/upload/medialibrary/217/e1f01dgvjdaaw18v2avmbcsw2mach04g/izobrazhenie.png" alt="">
	<?php
}

$this->EndViewTarget('bannerImage');

$arrADV = $flSections['UF_ADVANTAGES_ST1'];


$this->SetViewTarget('advantages');


if ($arrADV) {
	echo $arrADV
	?>
	<?php
} else {
	?>
	<ul class="advantages__list">
		<li class="advantages__item" id="bx_651765591_253267">
			<div class="advantages__icon">

				<img src="/upload/iblock/77e/1ewpev9hwxdmxiyqx1nx5vx0rn4m4ejr/Innovatsionnyy-podkhod.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Инновационный подход</span>
			<span class="advantages__description">Современное оборудование</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253269">
			<div class="advantages__icon">

				<img src="/upload/iblock/3b7/wyy6hd2195b5mn87nd2aab6hgx25pno2/Proverennye-metodiki.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Проверенные методики</span>
			<span class="advantages__description">Фокус на лучший результат</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253266">
			<div class="advantages__icon">

				<img src="/upload/iblock/6ef/s3voo01vod1zh0fkmn18k5gx6gpc5c9k/Vysokaya-kvalifikatsiya.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Высокая квалификация</span>
			<span class="advantages__description">Врачи с отличной репутацией</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253268">
			<div class="advantages__icon">

				<img src="/upload/iblock/6ae/5tz42homkzse7vljftv6r2ne63225cqz/Priyatnyy-servis.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Приятный сервис</span>
			<span class="advantages__description">Доброжелательность и комфорт</span>
		</li>
	</ul>
	<?php
}

$this->EndViewTarget('advantages');

?>
<div class="uslugi-top__wrapper">
	<div class="uslugi-top__bottom">
<h2 class="title section-site__title">Услуги: виды и цены</h2>
<?php

$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NEWS_COUNT" => $arParams["NEWS_COUNT"],
				"SORT_BY1" => $arParams["SORT_BY1"],
				"SORT_ORDER1" => $arParams["SORT_ORDER1"],
				"SORT_BY2" => $arParams["SORT_BY2"],
				"SORT_ORDER2" => $arParams["SORT_ORDER2"],
				"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"FILE_404" => $arParams["FILE_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
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
				"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

				"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
		),
		$component
); ?>
	</div>
	<div class="uslugi-top__top">
<?php
if ($arSection['DESCRIPTION']) {
	echo $arSection['DESCRIPTION'];
};

if($flSections['UF_BLOCK_EQUIP1']){
	?>
	<div class="equipment-top">
		<?php echo $flSections['UF_BLOCK_EQUIP1'];

		global $arrFilterEquipment;

		$GLOBALS['arrFilterEquipment'] = array("ID" => $flSections['UF_LINK_EQUIPMENT1']);

		if ($flSections['UF_LINK_EQUIPMENT1']){
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
	</div>

</div>
<h2 class="title section-site__title">Акции</h2>
<?php

if ($flSections['UF_STOCK_TEXT1']) {
	?>
	<div class="uslugi_additional-text">
		<?
		echo $flSections['UF_STOCK_TEXT1'];

		?>
	</div>
	<?
}

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

$GLOBALS['arrFilterEquipment'] = array("ID" => $flSections['UF_LINK_EQUIPMENT1']);

if ($flSections['UF_LINK_EQUIPMENT1']) {

	?>
	<h2 class="title section-site__title">Оборудование</h2>
	<?php
	if ($flSections['UF_EQUIP_TEXT1']) {
		?>
		<div class="uslugi_additional-text">
			<?
			echo $flSections['UF_EQUIP_TEXT1'];

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



$GLOBALS['arrFilterDocs'] = array("ID" => $flSections['UF_LINK_STAFF1']);


if ($flSections['UF_LINK_STAFF1']) {

	?>
	<h2 class="title section-site__title">Врачи</h2>

	<?php

	if ($flSections['UF_DOCTORS_TEXT1']) {
		?>
		<div class="uslugi_additional-text">
			<?
			echo $flSections['UF_DOCTORS_TEXT1'];

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
		<a href="/doctors/" class="button button--def equipment__button">cмотреть все</a>
	</div>
	<?php
}
?>

<section class="section-site">
	<div class="container">

		<div class="reviews">
			<?php




			$GLOBALS['arrFilterReviews'] = array("ID" => $flSections['UF_LINK_REVIEWS1']);

			if ($flSections['UF_LINK_REVIEWS1']) {

				?>
				<h2 class="title section-site__title">Отзывы</h2>
				<?php

				if ($flSections['UF_REVIEWS_TEXT1']) {
					?>
					<div class="uslugi_additional-text">
						<?
						echo $flSections['UF_REVIEWS_TEXT1'];

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
				<?php

			}
			?>

		</div>
	</div>
</section>


<?php
if($flSections['UF_LINK_QUESTIONS1']){

	$GLOBALS['arrFilterVoprosy'] = array("ID" => $flSections['UF_LINK_QUESTIONS1']);
	?>
	<h2 class="title section-site__title">Вопрос-ответ</h2>

	<div class="container">
		<?$APPLICATION->IncludeComponent(
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
		);?><br>
	</div>

	<?php
}
?>

<h2 class="title section-site__title price-title">Стоматология Одинцово: цены на услуги</h2>
<?php

if ($flSections['UF_TEXT_UPPER__SECTION_PRICE1']) {
	?>
	<div class="uslugi_additional-text uslugi_additional-text--price">
		<?
		echo $flSections['UF_TEXT_UPPER__SECTION_PRICE1'];

		?>
	</div>
	<?
}



$GLOBALS['arrFilterHits']=array("PROPERTY_COSMETOLOGY_SECTIONS"=> array($arSection['ID']));

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
