<style>


	.owl-item {
		margin-right: 30px;
	}


</style> <?php
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services.css");


?>
<div class="container">
	<div class="banner-section">
		<div class="banner-section__left">
			<h1 class="banner-title"><?
				$APPLICATION->ShowTitle(false);
				?></h1>
			<div class="banner-subtitle">
				Технологии на&nbsp;страже вашего здоровья и&nbsp;красоты
			</div>
			<?
			$APPLICATION->IncludeComponent(
					"aspro:form.medc2",
					"uslugi-form",
					array(
							"AJAX_MODE" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"CACHE_GROUPS" => "N",
							"CACHE_TIME" => "3600",
							"CACHE_TYPE" => "A",
							"CLOSE_BUTTON_CLASS" => "",
							"CLOSE_BUTTON_NAME" => "",
							"COMPONENT_TEMPLATE" => "uslugi-form",
							"DISPLAY_CLOSE_BUTTON" => "Y",
							"IBLOCK_ID" => "40",
							"IBLOCK_TYPE" => "aspro_medc2_form",
							"LICENCE_TEXT" => "btn btn-primary",
							"SEND_BUTTON_CLASS" => "btn btn-primary",
							"SEND_BUTTON_NAME" => "Отправить",
							"SHOW_LICENCE" => "Y",
							"SUCCESS_MESSAGE" => ""
					)
			); ?>
			<div class="banner-text">
				Нажимая кнопку «Отправить» вы&nbsp;соглашаетесь с&nbsp;политикой конфиденциальности
			</div>
		</div>
		<div class="banner-section_right">
			<?= $APPLICATION->ShowViewContent('bannerImage') ?>

			<?
			if ($APPLICATION->GetCurPage() == "/stomatologiya/") {
				?>
				<img src="/upload/medialibrary/099/g8pwsw9ipokpz6840z8pnbfpo4u5sx2v/izobrazhenie.png" alt="">
				<?
			} ?>

		</div>
	</div>
	<div class="advantages">
		<?= $APPLICATION->ShowViewContent('advantages') ?>
		<?
		if ($APPLICATION->GetCurPage() == "/stomatologiya/") {
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
					<span class="advantages__description">Фокус на&nbsp;лучший результат</span>
				</li>
				<li class="advantages__item" id="bx_651765591_253266">
					<div class="advantages__icon">

						<img src="/upload/iblock/6ef/s3voo01vod1zh0fkmn18k5gx6gpc5c9k/Vysokaya-kvalifikatsiya.svg" alt="">
						<!--					<svg class="icon">-->
						<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
						<!--					</svg>-->
					</div>
					<span class="advantages__name">Высокая квалификация</span>
					<span class="advantages__description">Врачи с&nbsp;отличной репутацией</span>
				</li>
				<li class="advantages__item" id="bx_651765591_253268">
					<div class="advantages__icon">

						<img src="/upload/iblock/6ae/5tz42homkzse7vljftv6r2ne63225cqz/Priyatnyy-servis.svg" alt="">
						<!--					<svg class="icon">-->
						<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
						<!--					</svg>-->
					</div>
					<span class="advantages__name">Приятный сервис</span>
					<span class="advantages__description">Доброжелательность и&nbsp;комфорт</span>
				</li>
			</ul>
			<?
		} ?>
	</div>
</div>
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
								"COMPONENT_TEMPLATE" => "new_multilevel",
								"DELAY" => "N",
								"MAX_LEVEL" => "4",
								"MENU_CACHE_GET_VARS" => array(),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "left_sub",
								"USE_EXT" => "Y"
						)
				); ?>
			</div>
			<div class="with-sidebar__main-content">
				<div class="uslugi-section">
					<div class="uslugi-top__wrapper">
						<div class="uslugi-top__bottom">
					<?
					if ($APPLICATION->GetCurPage() == "/stomatologiya/") {
						?>
						<h2 class="title section-site__title">Услуги: виды и&nbsp;цены</h2>
						<?
					} ?>
					<?
					$APPLICATION->IncludeComponent(
	"bitrix:news",
	"uslugi",
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "uslugi",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "ID",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "LINK_EQUIP",
			1 => "LINK_ADDRESS",
			2 => "POST",
			3 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_FIELD_CODE" => "",
		"FILTER_NAME" => "arrFilter",
		"FILTER_PROPERTY_CODE" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "aspro_medc2_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "m-d-Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "LINK_EQUIP",
			1 => "LINK_STAFF",
			2 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "500",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/uslugi/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"detail" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		)
	),
	false
); ?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
