<?php

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Page\Asset;

/** @var Bitrix\Main\ $APPLICATION */
/** @var CUser $USER */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

// Не соединяй в одну инструкцию, некоторые части могут использоваться ниже
$instance = Application::getInstance();
$context = $instance->getContext();
$request = $context->getRequest();
$uriString = $request->getRequestUri();

$uri = new Uri($uriString);

global $is_main_page;
$is_main_page = $APPLICATION->GetCurPage(false) === "/";


?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Language" Content="<?= LANGUAGE_ID ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<title>
			<?php
			$APPLICATION->ShowTitle();
			?>
		</title>

		<link rel="shortcut icon" type="image/x-icon" href="https://artistom.ru/upload/medialibrary/bb7/1ybkxlop484g91f8ew4wgzmml3osm527/logoico"/>

<!--		<link rel="manifest" href="--><?php //= SITE_TEMPLATE_PATH ?><!--/assets/favicons/site.webmanifest">-->
		<link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="https://kueppersbusch-russia.ru/">
		<meta name="application-name" content="https://kueppersbusch-russia.ru/">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">


		<?php
		Asset::getInstance()->addCss("/local/vendor/html5-boilerplate_v8.0.0/css/normalize.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/fonts/roboto/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/fonts/sansation/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/m_custom_scrollbar/jquery.mCustomScrollbar.min.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/base.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/header_services/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/buttons/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/forms.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/placeholder.css");

		Asset::getInstance()->addJs("/local/vendor/jquery/jquery-3.5.1.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/header_services/script.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/forms/script.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
		Asset::getInstance()->addJs(
				SITE_TEMPLATE_PATH . "/libs/m_custom_scrollbar/jquery.mCustomScrollbar.concat.min.js"
		);
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/js/base.js");

		$APPLICATION->ShowHead();

		?>
		<script>
					let SITE_TEMPLATE_PATH = "<?=SITE_TEMPLATE_PATH?>";
		</script>


	</head>
<body>
 <?/* TODO плейсхолдер, раскоментировать перед сдачей?>
	<div class="loading-page">
		<div class="counter">
		<p>Загрузка</p>
		<h1>0%</h1>
		<hr>
		</div>
	</div>
<?*/?>
	<div id="panel"><?php
		$APPLICATION->ShowPanel(); ?></div>
<div class="site <?= $is_main_page ? 'main-page' : ''; ?>" id="site">
	<header class="site__header">
		<div class="container">
			<div class="site-header">
				<div class="site-header__top" id="header-top">
					<a href="/" class="site-header__logo">
						<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/logo.svg" alt="logo">
					</a>

					<div class="site-header__rating">
						<?php
						$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"rating",
								array(
										"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/rating.php",
										"COMPONENT_TEMPLATE" => "rating",
										"AREA_FILE_SHOW" => "file",
										"NO_FOLLOW" => "N",
										"EDIT_TEMPLATE" => ""
								),
								false
						); ?>
					</div>

					<button type="button" class="site-header__button burger">
						<span></span>
					</button>

					<div class="site-header__address">
						<?php
						$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"address",
								array(
										"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/address.php",
										"COMPONENT_TEMPLATE" => "address",
										"AREA_FILE_SHOW" => "file",
										"NO_FOLLOW" => "N",
										"EDIT_TEMPLATE" => "",
										"SHOW_ICON" => "Y",
										"FROM_FILE" => "Y",
										"SCHEMA_ORG" => "N",
										"link" => "",
										"company_name" => "",
										"postalCode" => "",
										"addressCountry" => "",
										"addressLocality" => "",
										"streetAddress" => ""
								),
								false
						); ?>
					</div>

					<div class="site-header__call">
						<div class="site-header__phone">
							<?php
							$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"phone",
									array(
											"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/phone.php",
											"COMPONENT_TEMPLATE" => "phone",
											"AREA_FILE_SHOW" => "file",
											"NO_FOLLOW" => "N",
											"EDIT_TEMPLATE" => ""
									),
									false
							); ?>
						</div>

						<div class="site-header__callback">
							<button data-form="1" type="button" class="button button--no-style button-form">
								Заказать звонок
							</button>
						</div>
					</div>


					<div class="site-header__search">
						<?php
						$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"top",
	array(
		"COMPONENT_TEMPLATE" => "top",
		"PAGE" => "#SITE_DIR#search/",
		"USE_SUGGEST" => "Y"
	),
	false
); ?>
						<button type="button" class="site-header__search-button">
							<div class="icon-box">
								<svg class="icon icon--open">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/icons/svg-sprite.svg#search"></use>
								</svg>
								<svg class="icon icon--close">
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/icons/svg-sprite.svg#close"></use>
								</svg>
							</div>

							<div class="icon-text">Поиск</div>
						</button>
					</div>

				</div>

				<div class="site-header__top-nav" id="header-nav">

					<div class="site-header__nav-header">

						<div class="site-header__logo">
							<?php
							$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"logo",
									array(
											"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/logo.php",
											"COMPONENT_TEMPLATE" => "logo",
											"AREA_FILE_SHOW" => "file",
											"EDIT_TEMPLATE" => "",
											"LINK" => "/",
											"IMG" => "/local/templates/px_2023/assets/images/logo.svg",
											"IMG_BIG" => "",
											"NO_FOLLOW" => "N",
											"ALT" => "Логотип компании",
											"HIDE_TEXT" => "Y"
									),
									false
							); ?>
						</div>

						<div class="site-header__rating">
							<?php
							$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"rating",
									array(
											"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/rating.php",
											"COMPONENT_TEMPLATE" => "rating",
											"AREA_FILE_SHOW" => "file",
											"NO_FOLLOW" => "N",
											"EDIT_TEMPLATE" => ""
									),
									false
							); ?>
						</div>

						<button type="button" class="site-header__button burger">
							<span></span>
						</button>

						<div class="site-header__call">
							<div class="site-header__phone">
								<?php
								$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"phone",
										array(
												"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/phone.php",
												"COMPONENT_TEMPLATE" => "phone",
												"AREA_FILE_SHOW" => "file",
												"NO_FOLLOW" => "N",
												"EDIT_TEMPLATE" => ""
										),
										false
								); ?>
							</div>

							<div class="site-header__callback">
								<button data-form="1" type="button" class="button button--no-style">
									Заказать звонок
								</button>
							</div>
						</div>

					</div>



					<div class="site-header__tab-menu tab-menu">

						<div class="tab-menu__btns">
							<div class="tab-menu__btn">
								<a href="https://artistom.ru/stomatologiya/" class="tab-menu__more" data-id="20">
									Стоматология
									<img src="<?= SITE_TEMPLATE_PATH ?>/assets/icons/arrow-grad.svg"
										 alt="<?= $arItem["TEXT"] ?>">
										 <div data-id="20" style="margin-left: 10px" class="tab-menu__arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
									  <path d="M1 2.5L6 7.5L11 2.5" stroke="#333438" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
								</a>
							</div>


							<div class="tab-menu__btn">
								<a href="https://artistom.ru/cosmetology/" class="tab-menu__more" data-id="33">
									Косметология
									<img src="<?= SITE_TEMPLATE_PATH ?>/assets/icons/arrow-grad.svg"
										 alt="<?= $arItem["TEXT"] ?>">
									<div data-id="33" style="margin-left: 10px" class="tab-menu__arrow">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
									  <path d="M1 2.5L6 7.5L11 2.5" stroke="#333438" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>
								</a>
							</div>
						</div>


						<div class="tab-menu__content" id="services-content">
							<?php
							$blockId = $_POST['blockId'];
							echo $blockId;
							?>
						</div>
					</div>

					<?php
					$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"simple_multilevel",
	array(
		"COMPONENT_TEMPLATE" => "simple_multilevel",
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
); ?>

					<button data-form="2" type="button" class="button button--neo-1 site-header__sign-desc button-form">Записаться</button>

					<div class="site-header__bottom footer-mob">
						<div class="footer-mob__phone">
							<?php
							$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"phone",
									array(
											"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/phone.php",
											"COMPONENT_TEMPLATE" => "phone",
											"AREA_FILE_SHOW" => "file",
											"NO_FOLLOW" => "N",
											"EDIT_TEMPLATE" => ""
									),
									false
							); ?>
						</div>
						<div class="footer-mob__contacts">
							<ul class="footer-mob__list">
								<li class="footer-mob__item">
									<?php
									$APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"address",
											array(
													"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/address.php",
													"COMPONENT_TEMPLATE" => "address",
													"AREA_FILE_SHOW" => "file",
													"NO_FOLLOW" => "N",
													"EDIT_TEMPLATE" => "",
													"SHOW_ICON" => "N",
													"FROM_FILE" => "Y",
													"SCHEMA_ORG" => "N",
													"link" => "",
													"company_name" => "",
													"postalCode" => "",
													"addressCountry" => "",
													"addressLocality" => "",
													"streetAddress" => ""
											),
											false
									); ?>
								</li>
								<li class="footer-mob__item">
									<?php
									$APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"email",
											array(
													"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/email.php",
													"COMPONENT_TEMPLATE" => "email",
													"AREA_FILE_SHOW" => "file",
													"NO_FOLLOW" => "N",
													"EDIT_TEMPLATE" => "",
													"FROM_FILE" => "Y",
													"SHOW_ICON" => "N"
											),
											false
									); ?>
								</li>
								<li class="footer-mob__item">
																<?php
									$APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"work_time",
											array(
													"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/worktime.php",
													"COMPONENT_TEMPLATE" => "email",
													"AREA_FILE_SHOW" => "file",
													"NO_FOLLOW" => "N",
													"EDIT_TEMPLATE" => "",
													"FROM_FILE" => "Y",
													"SHOW_ICON" => "N"
											),
											false
									); ?>
								</li>
								<li class="footer-mob__item">
									<?php
									$APPLICATION->IncludeComponent(
											"bitrix:news.list",
											"social",
											array(
													"ACTIVE_DATE_FORMAT" => "d.m.Y",
												// Формат показа даты
													"ADD_SECTIONS_CHAIN" => "N",
												// Включать раздел в цепочку навигации
													"AJAX_MODE" => "N",
												// Включить режим AJAX
													"AJAX_OPTION_ADDITIONAL" => "",
												// Дополнительный идентификатор
													"AJAX_OPTION_HISTORY" => "N",
												// Включить эмуляцию навигации браузера
													"AJAX_OPTION_JUMP" => "N",
												// Включить прокрутку к началу компонента
													"AJAX_OPTION_STYLE" => "N",
												// Включить подгрузку стилей
													"CACHE_FILTER" => "N",
												// Кешировать при установленном фильтре
													"CACHE_GROUPS" => "Y",
												// Учитывать права доступа
													"CACHE_TIME" => "36000000",
												// Время кеширования (сек.)
													"CACHE_TYPE" => "A",
												// Тип кеширования
													"CHECK_DATES" => "Y",
												// Показывать только активные на данный момент элементы
													"DETAIL_URL" => "",
												// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
													"DISPLAY_BOTTOM_PAGER" => "N",
												// Выводить под списком
													"DISPLAY_DATE" => "N",
												// Выводить дату элемента
													"DISPLAY_NAME" => "Y",
												// Выводить название элемента
													"DISPLAY_PICTURE" => "N",
												// Выводить изображение для анонса
													"DISPLAY_PREVIEW_TEXT" => "N",
												// Выводить текст анонса
													"DISPLAY_TOP_PAGER" => "N",
												// Выводить над списком
													"FIELD_CODE" => array(    // Поля
															0 => "ID",
															1 => "NAME",
															2 => "",
													),
													"FILTER_NAME" => "",
												// Фильтр
													"HIDE_LINK_WHEN_NO_DETAIL" => "N",
												// Скрывать ссылку, если нет детального описания
													"IBLOCK_ID" => "35",
												// Код информационного блока
													"IBLOCK_TYPE" => "aspro_medc2_content",
												// Тип информационного блока (используется только для проверки)
													"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
												// Включать инфоблок в цепочку навигации
													"INCLUDE_SUBSECTIONS" => "N",
												// Показывать элементы подразделов раздела
													"MESSAGE_404" => "",
												// Сообщение для показа (по умолчанию из компонента)
													"NEWS_COUNT" => "20",
												// Количество новостей на странице
													"PAGER_BASE_LINK_ENABLE" => "N",
												// Включить обработку ссылок
													"PAGER_DESC_NUMBERING" => "N",
												// Использовать обратную навигацию
													"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
												// Время кеширования страниц для обратной навигации
													"PAGER_SHOW_ALL" => "N",
												// Показывать ссылку "Все"
													"PAGER_SHOW_ALWAYS" => "N",
												// Выводить всегда
													"PAGER_TEMPLATE" => ".default",
												// Шаблон постраничной навигации
													"PAGER_TITLE" => "Новости",
												// Название категорий
													"PARENT_SECTION" => "",
												// ID раздела
													"PARENT_SECTION_CODE" => "",
												// Код раздела
													"PREVIEW_TRUNCATE_LEN" => "",
												// Максимальная длина анонса для вывода (только для типа текст)
													"PROPERTY_CODE" => array(    // Свойства
															0 => "ICON_ID",
															1 => "LINK",
															2 => "ICON_COLOR",
															3 => "",
													),
													"SET_BROWSER_TITLE" => "N",
												// Устанавливать заголовок окна браузера
													"SET_LAST_MODIFIED" => "N",
												// Устанавливать в заголовках ответа время модификации страницы
													"SET_META_DESCRIPTION" => "N",
												// Устанавливать описание страницы
													"SET_META_KEYWORDS" => "N",
												// Устанавливать ключевые слова страницы
													"SET_STATUS_404" => "N",
												// Устанавливать статус 404
													"SET_TITLE" => "N",
												// Устанавливать заголовок страницы
													"SHOW_404" => "N",
												// Показ специальной страницы
													"SORT_BY1" => "ACTIVE_FROM",
												// Поле для первой сортировки новостей
													"SORT_BY2" => "SORT",
												// Поле для второй сортировки новостей
													"SORT_ORDER1" => "DESC",
												// Направление для первой сортировки новостей
													"SORT_ORDER2" => "ASC",
												// Направление для второй сортировки новостей
													"STRICT_SECTION_CHECK" => "N",
												// Строгая проверка раздела для показа списка
											),
											false
									); ?>
								</li>
							</ul>
							<div class="footer-mob__y-place">
								<svg class="icon">
									<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#y-good-place"></use>
								</svg>
							</div>
							<button data-form="2" type="button" class="button button--neo-1 site-header__sign-mob button-form">Записаться</button>
						</div>

					</div>

				</div>
			</div>
		</div>
	</header>
	<main class="main">

<?php
if (!$is_main_page) {
	?>

	<div class="site__breadcrumb">
		<?php
		$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs-art", array(

	),
	false
); ?>
	</div>

<div class="container">
	<h1>
	<?
			if (CSite::InDir('/stomatologiya/') || CSite::InDir('/cosmetology/')  || CSite::InDir('/uslugi/')) {
			} else{
		$APPLICATION->ShowTitle(false); }?></h1></div>

	<?php
}
