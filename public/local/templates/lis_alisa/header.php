<?php

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Page\Asset;

/** @var Bitrix\Main\ $APPLICATION */
/** @var object $USER */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

// Не соединяй в одну инструкцию, некоторые части могут использоваться ниже
$instance = Application::getInstance();
$context = $instance->getContext();
$request = $context->getRequest();
$uriString = $request->getRequestUri();

$uri = new Uri($uriString);

global $is_main_page, $userAuth;
$is_main_page = $APPLICATION->GetCurPage(false) === "/";
$userAuth = $USER->IsAuthorized();


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
			$APPLICATION->ShowTitle(); ?>
		</title>

		<link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/favicon.ico"/>
		<link rel="apple-touch-icon" sizes="180x180"
			  href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32"
			  href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16"
			  href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/favicon-16x16.png">
		<link rel="manifest" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/site.webmanifest">
		<link rel="mask-icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/favicon.ico">
		<meta name="apple-mobile-web-app-title" content="https://kueppersbusch-russia.ru/">
		<meta name="application-name" content="https://kueppersbusch-russia.ru/">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="msapplication-config" content="<?= SITE_TEMPLATE_PATH ?>/assets/favicons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">

		<?php
		Asset::getInstance()->addCss("/local/vendor/html5-boilerplate_v8.0.0/css/normalize.css");
		// Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/roboto/roboto.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/fonts/montserrat/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/base.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/buttons/style.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/forms.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/placeholder.css");
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/modal/style.css");

		Asset::getInstance()->addJs("/local/vendor/jquery/jquery-3.5.1.min.js");
		Asset::getInstance()->addJs("/local/vendor/Inputmask-5.x/dist/jquery.inputmask.min.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/forms/script.js");
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/modal/script.js");

		$APPLICATION->ShowHead();
		?>

	</head>

<body>
	<div id="panel"><?php
		$APPLICATION->ShowPanel(); ?></div>
<div class="site <?= $is_main_page ? 'main-page' : ''; ?>" id="site">
	<header class="site__header">
		<div class="container">
			<div class="site-header">
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
							"IMG" => "/local/templates/zs_2023/assets/images/logo.svg",
							"IMG_BIG" => "",
							"NO_FOLLOW" => "N",
							"ALT" => "Логотип компании",
							"HIDE_TEXT" => "Y"
						),
						false
					); ?>
				</div>
				<div class="site-header__top-nav">
					<?php
					$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"spetial_top_menu",
						array(
							"COMPONENT_TEMPLATE" => "spetial_top_menu",
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						),
						false
					); ?>

				</div>
				<div class="site-header__callback">
					<button type="button" class="button button-icon modal-button" data-type="form" data-formId="2">
						<svg class="icon">
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#phoneCall"></use>
						</svg>
						<span>Заказать звонок</span>
					</button>
				</div>
				<div class="site-header__user user-header">
					<?php
					if (!$userAuth) {
						?>
						<div class="user-header__guest">
							<a href="/personal/" class="button-border--icon modal-button-del" data-type="enter"
							   data-formtitle="Заказать звонок">
								<svg>
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#logIn"></use>
								</svg>
								<span>Войти</span>
							</a>
						</div>
						<?php
					} else {
						?>
						<div class="user-header__guest">
							<a href="/personal//?logout=yes&<?= bitrix_sessid_get() ?>" class="button-border--icon">
								<svg>
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#logOut"></use>
								</svg>
								<span>Выйти</span>
							</a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</header>
	<main>
<?php
if (!$is_main_page) {
	?>
	<div class="container">
	<?php
}
