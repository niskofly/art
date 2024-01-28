<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
IncludeTemplateLangFile(__FILE__);

global $is_main_page;

?>

<div data-form="1" id="myModal" class="modal">


	<div class="modal-content">
		<div class="modal-header">
			<span class="closePopup">&times;</span>
		</div>
		<?$APPLICATION->IncludeComponent(
				"aspro:form.medc2",
				"obratniy-zvonok",
				Array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "3600",
						"CACHE_TYPE" => "A",
						"CLOSE_BUTTON_CLASS" => "",
						"CLOSE_BUTTON_NAME" => "",
						"COMPONENT_TEMPLATE" => "form-promo",
						"DISPLAY_CLOSE_BUTTON" => "Y",
						"IBLOCK_ID" => "15",
						"IBLOCK_TYPE" => "aspro_medc2_form",
						"LICENCE_TEXT" => "btn btn-primary",
						"SEND_BUTTON_CLASS" => "btn btn-primary",
						"SEND_BUTTON_NAME" => "Отправить",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_MESSAGE" => ""
				)
		);?>
	</div>

</div>

<div data-form="2" id="myModal" class="modal">


	<div class="modal-content">
		<div class="modal-header">
			<span class="closePopup">&times;</span>
		</div>
		<?$APPLICATION->IncludeComponent(
				"aspro:form.medc2",
				"zapis-online",
				Array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "3600",
						"CACHE_TYPE" => "A",
						"CLOSE_BUTTON_CLASS" => "",
						"CLOSE_BUTTON_NAME" => "",
						"COMPONENT_TEMPLATE" => "form-promo",
						"DISPLAY_CLOSE_BUTTON" => "Y",
						"IBLOCK_ID" => "18",
						"IBLOCK_TYPE" => "aspro_medc2_form",
						"LICENCE_TEXT" => "btn btn-primary",
						"SEND_BUTTON_CLASS" => "btn btn-primary",
						"SEND_BUTTON_NAME" => "Отправить",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_MESSAGE" => ""
				)
		);?>
	</div>

</div>

<section class="section-site">
	<div class="container">
		<h2 class="title section-site__title">Лицензии</h2>
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
</section>
<div class="site__contacts footer-contacts">
	<div class="y-map footer-contacts__map">
		<?php
		$APPLICATION->IncludeComponent(
				"bitrix:map.yandex.view",
				"artistom.yandexmap",
				array(
						"COMPONENT_TEMPLATE" => "artistom.yandexmap",
						"INIT_MAP_TYPE" => "MAP",
						"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.68673629620704;s:10:\"yandex_lon\";d:37.28894075485733;s:12:\"yandex_scale\";i:14;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.300046734636;s:3:\"LAT\";d:55.690540525381;s:4:\"TEXT\";s:49:\"«Стоматология в Одинцово».\";}}}",
						"MAP_WIDTH" => "1200",
						"MAP_HEIGHT" => "764",
						"CONTROLS" => array(
								0 => "TYPECONTROL",
						),
						"OPTIONS" => array(
								0 => "ENABLE_SCROLL_ZOOM",
								1 => "ENABLE_DBLCLICK_ZOOM",
								2 => "ENABLE_DRAGGING",
						),
						"MAP_ID" => "",
						"API_KEY" => ""
				),
				false
		); ?>
	</div>
	<div class="container">

		<div class="footer-contacts__y-place">
			<svg class="icon">
				<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#y-good-place"></use>
			</svg>
		</div>
		<div class="footer-contacts__wrapper">
			<ul class="footer-contacts__list">
				<li class="footer-contacts__item">
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
					<button type="button" class="button button--no-style">
						Заказать звонок
					</button>
				</li>
				<li class="footer-contacts__item">
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
									"SHOW_ICON" => "Y"
							),
							false
					); ?>
				</li>
				<li class="footer-contacts__item">
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
				</li>
			</ul>
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
		</div>
	</div>
</div>
</main>
<footer class="site__footer">
	<div class="container">
		<div class="site-footer">
			<div class="site-footer__row">
				<div class="site-footer__col">

					<?php
					$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"logo",
							array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/logo.php",
									"COMPONENT_TEMPLATE" => "logo",
									"LINK" => "/",
									"NO_FOLLOW" => "N",
									"IMG" => "/local/templates/px_2023/assets/images/logo.svg",
									"IMG_BIG" => "",
									"ALT" => "Логотип компании"
							),
							false
					); ?>

				</div>

				<div class="site-footer__col">
					<?php
					$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"footer_menu",
							array(
									"ROOT_MENU_TYPE" => "left",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(),
									"MAX_LEVEL" => "1",
									"CHILD_MENU_TYPE" => "left",
									"USE_EXT" => "N",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
									"COMPONENT_TEMPLATE" => "footer_menu"
							),
							false
					); ?>
				</div>


				<div class="site-footer__col">
					<?php
					$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"payment",
							array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/payment.php",
									"COMPONENT_TEMPLATE" => "payment",
									"OTHER_TEXT" => "Возможна оплата в рассрочку.",
									"IMG_1" => "/local/templates/px_2023/assets/images/payment/MasterCard.png",
									"IMG_2" => "/local/templates/px_2023/assets/images/payment/visa.png",
									"IMG_3" => "/local/templates/px_2023/assets/images/payment/mir.png",
									"ALT" => "Способ оплаты"
							),
							false
					); ?>
				</div>
			</div>
			<div class="site-footer__bottom">

				<div class="site-footer__copyright">
					<?php
					$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"copyright",
							array(
									"AREA_FILE_SHOW" => "file",
									"AREA_FILE_SUFFIX" => "inc",
									"EDIT_TEMPLATE" => "",
									"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/copyright.php",
									"COMPONENT_TEMPLATE" => "copyright",
									"YEAR" => "2020"
							),
							false
					); ?>

				</div>

				<?php
				$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"developer",
						array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/developer.php",
								"COMPONENT_TEMPLATE" => "developer",
								"SHOW_ICON" => "Y",
								"LINK" => "https://www.prexpert.com/",
								"SVG_SPRITE" => "/local/templates/px_2023/assets/icons/svg-sprite.svg#prExpert"
						),
						false
				); ?>
			</div>


		</div>
	</div>
</footer>


<?php
$APPLICATION->IncludeComponent(
		"zs:modal_banners",
		".default",
		array(
				"IBLOCK_ID" => "34",
				"IBLOCK_TYPE" => "auxiliary",
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
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
						0 => "DETAIL_PICTURE",
						1 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "99999",
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
						0 => "HEIGHT",
						1 => "WIDTH",
						2 => "BG_COLOR",
						3 => "COLOR",
						4 => "CLOSE_COLOR",
						5 => "LINK",
						6 => "TARGET_BLANK",
						7 => "JS_TIME_FADEOUT",
						8 => "JS_TIMEOUT_REPEAT",
						9 => "JS_TIMEOUT_START",
						10 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "ACTIVE_FROM",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => ".default"
		),
		false
);


//$APPLICATION->IncludeFile(
//        SITE_TEMPLATE_PATH . "/assets/include_areas/counters.php",
//        Array(),
//        Array("NAME" => "счётчики", "MODE" => "php")
//);



//TODO Переписать то что ниже на то что выше
$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"counters",
		array(
				"AREA_FILE_SHOW" => "file", // Показывать включаемую область
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",  // Шаблон области по умолчанию
				"PATH" => SITE_TEMPLATE_PATH . "/assets/include/counters_footer.php",    // Путь к файлу области
				"MESSAGE" => "Управление кодами счётчиков под footer",
				"OFF_FOR_ADMIN" => "Y"
		),
		false
);


$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"notification",
		array(
				"COMPONENT_TEMPLATE" => "notification",
				"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/notification.php",
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "",
				"AREA_FILE_RECURSIVE" => "Y",
				"TITLE" => "Мы используем Coocie и Яндекс.Метрику",
				"BUTTON_APPLY_TEXT" => "",
				"BUTTON_REJECT_TEXT" => "Отказываюсь использовать метрику",
				"EDIT_TEMPLATE" => ""

		),
		false
); ?>
</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		setTimeout(() => {
			(function(w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({
					'gtm.start': new Date().getTime(),
					event: 'gtm.js',
				});
				var f = d.getElementsByTagName(s)[0],
						j = d.createElement(s),
						dl = l != 'dataLayer' ? '&l=' + l : '';
				j.async = true;
				j.src =
						'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, 'script', 'dataLayer', 'GTM-T6PPWKZ');
		}, 6000);
	}, false);
</script>

<?php
if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
	<!-- calltouch -->
	<script src="https://mod.calltouch.ru/init.js?id=ha8l2qmg"></script>
	<!-- /calltouch -->
<?php
endif; ?>



	<?php
	if ($APPLICATION->GetCurPage() !== '/pacientam/stati/kak-bystro-izbavitsya-ot-zubnoj-boli/') { ?>
		<script src="//code-ya.jivosite.com/widget/pcuaqGebuf" async></script>
		<?php
	} ?>


<script>
	$('#b-fast-panel-item-chat').on('click', function () {
		// $('.b24-widget-button-social-tooltip').trigger("click");
		jivo_api.open();
	});
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		m[i].l=1*new Date();
		for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
		k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(46259316, "init", {
		clickmap:true,
		trackLinks:true,
		accurateTrackBounce:true,
		webvisor:true
	});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/46259316" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</body>
</html>
