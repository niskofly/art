<?php

use Bitrix\Main\Page\Asset;

/** @var Bitrix\Main\ $APPLICATION */
/** @var CUser $USER */

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Стоматология и косметология в Одинцово");
$APPLICATION->SetPageProperty("description", "Стоматологическая клиника АРТ в Одинцово. Рейтинг 5/5 ★★★★★ Стоматологи высшей квалификации со стажем более 15 лет. Современное стоматологическое оборудование, только проверенные методики лечения");
$APPLICATION->SetTitle("Стоматология и косметология в Одинцово");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/main_page.css");

$APPLICATION->SetPageProperty(
		"description",
		"Стоматологическая клиника АРТ в Одинцово. Рейтинг 5/5 ★★★★★ Стоматологи высшей квалификации со стажем более 15 лет. Современное стоматологическое оборудование, только проверенные методики лечения"
);

?>
	<div class="container">
		<h1><?$APPLICATION->ShowTitle(false);?></h1>
		<div class="dentistry">
			<div class="dentistry__path dentistry__path--left active">
				<div class="dentistry__content">
 <a href="/stomatologiya/" class="dentistry__title">Стоматология</a> <a href="/stomatologiya/" class="dentistry__link button button--light ">
					все услуги </a>
					<div class="dentistry__description">
 <button class="dentistry__tab-more">
						Об услуге </button>
						Взгляните на наши самые технологичные и безопасные решения для здоровой и красивой улыбки
					</div>
				</div>

			</div>
			<div class="dentistry__path dentistry__path--right">
				<div class="dentistry__content">
 <a href="/cosmetology/" class="dentistry__title">Косметология</a> <a href="/cosmetology/" class="dentistry__link button button--light ">
					все услуги </a>
					<div class="dentistry__description">
 <button class="dentistry__tab-more">
						Об услуге </button>
						Предлагаем широкий профиль аппаратных, инъекционных, уходовых процедур для лица и фигуры
					</div>
				</div>
				<div class="dentistry__mask">
 <img src="/upload/medialibrary/14d/a0h2vnn0j3jxnuu9tvd7o7qdl3vpiwy6/mask.webp" alt="">
				</div>
			</div>
			<div class="dentistry__bg">
 <img src="/upload/medialibrary/956/36j71g252zsk1cijii8e12ditebxn858/bannermain.webp" alt="">
			</div>
		</div>
	</div>

<div class="section-site section--hidden">
	<!--
	<div class="stories">
		<div class="stories__modal stories-modal">
			<div class="stories-modal__wrapper">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"stories",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantages",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "38",
		"IBLOCK_TYPE" => "aspro_medc2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "50",
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
		"PROPERTY_CODE" => array(0=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
			</div>
 <button class="stories__close"> </button>
		</div>
		<div class="container">
			<div class="swiper-container stories-preview">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
 <img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">
								 Стоматология
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	-->
</div>
<div class="section-site">
	<div class="container">
		<div class="advantages">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"advantages",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "advantages",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "37",
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
		"PROPERTY_CODE" => array(0=>"",1=>"GIF",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
		</div>
	</div>
</div>
 <section class="section-site">
<div class="container">
	<div class="about-clinic">
		<div class="about-clinic__wrapper">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"with_image",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "clinic_text",
		"BUTTON_LINK" => "#",
		"BUTTON_TEXT" => "",
		"COMPONENT_TEMPLATE" => "with_image",
		"EDIT_TEMPLATE" => "",
		"IMAGE" => "/local/templates/px_2023/assets/images/index-clinic.png",
		"TITLE" => "О Клинике"
	)
);?>
		</div>
		<div class="about-clinic__advantages">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"clinic",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "36",
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
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
		</div>
		<div class="about-clinic__desc-bottom">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "clinic_description"
	)
);?>
		</div>
	</div>
</div>
 </section>
<div class="section-site">
	<div class="container">
		<div class="equipment">
			<div class="equipment__preview">
				<div class="equipment__image">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "equipment_image"
	)
);?>
				</div>
			</div>
			<div class="equipment__wrapper">
				<div class="equipment__title">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "equipment_title"
	)
);?>
				</div>
				<div class="equipment__description">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "equipment_text"
	)
);?>
				</div>
 <a href="/oborudovanie/" class="equipment__link button button--def">Смотреть все оборудование</a>
			</div>
			<div class="equipment__carusel">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"equipment",
	Array(
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
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
		"FILTER_NAME" => "",
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
		"PROPERTY_CODE" => array("",""),
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
);?>
			</div>
		</div>
	</div>
</div>
 <section class="section-site">
<div class="container">
	<h2 class="title section-site__title">Актуальные акции</h2>
	<div class="promo">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"promo",
	Array(
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
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
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
		"PROPERTY_CODE" => array("",""),
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
);?>
	</div>
</div>
 </section> <section class="section-site">
<div class="container">
	<div class="our-team">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"with_image",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "team_text",
		"BUTTON_LINK" => "#",
		"BUTTON_TEXT" => "смотреть всех врачей",
		"COMPONENT_TEMPLATE" => "with_image",
		"EDIT_TEMPLATE" => "",
		"IMAGE" => "/upload/medialibrary/037/5wbp6lwk6gn2j7hqqcpmocp2dabcu38k/image.jpg",
		"TITLE" => "МЫ — команда"
	)
);?>
	</div>
</div>
 </section> <section class="section-site">
<div class="container">
	<h2 class="title section-site__title">Отзывы</h2>
	<div class="reviews">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"reviews",
	Array(
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
		"FIELD_CODE" => array(0=>"NAME",1=>"PREVIEW_TEXT",2=>"PREVIEW_PICTURE",3=>"DATE_ACTIVE_FROM",4=>"DATE_ACTIVE_TO",5=>"",),
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
		"PROPERTY_CODE" => array(0=>"",1=>"",),
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
);?>
	</div>
</div>
 </section> <br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
