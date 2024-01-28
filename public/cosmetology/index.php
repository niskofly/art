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
				$APPLICATION->ShowTitle(false) ?></h1>
			<div class="banner-subtitle">
				 Технологии на страже вашего здоровья и красоты
			</div>
			 <?$APPLICATION->IncludeComponent(
	"aspro:form.medc2",
	"uslugi-form",
	Array(
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
);?>
			<div class="banner-text">
				 Нажимая кнопку «Отправить» вы соглашаетесь с политикой конфиденциальности
			</div>
		</div>
		<div class="banner-section_right">
			<?=$APPLICATION->ShowViewContent('bannerImage') ?>

			<?if($APPLICATION->GetCurPage() == "/cosmetology/") {
				?>
				<img src="/upload/medialibrary/217/e1f01dgvjdaaw18v2avmbcsw2mach04g/izobrazhenie.png" alt="">
				<?
			}?>
		</div>
	</div>
	<div class="advantages">
		<?= $APPLICATION->ShowViewContent('advantages') ?>
		<?
		if ($APPLICATION->GetCurPage() == "/cosmetology/") {
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
			<?
		} ?>
	</div>
</div>
<div class="dentistry-page">
	<div class="container">
		<div class="with-sidebar">
			<div class="with-sidebar__sidebar-menu">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"new_multilevel",
	Array(
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
);?>
			</div>
			<div class="with-sidebar__main-content">
				<div class="uslugi-top__wrapper">
					<div class="uslugi-top__bottom">
				<div class="uslugi-section">
					 <?$APPLICATION->IncludeComponent("bitrix:news", "cosmetology", Array(
	"ADD_ELEMENT_CHAIN" => "Y",	// Включать название элемента в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BROWSER_TITLE" => "NAME",	// Установить заголовок окна браузера из свойства
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"COMPONENT_TEMPLATE" => "uslugi",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DETAIL_FIELD_CODE" => array(	// Поля
			0 => "ID",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "DETAIL_PICTURE",
			5 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
		"DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "LINK_STAFF",
			1 => "LINK_ADDRESS",
			2 => "POST",
			3 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FILTER_FIELD_CODE" => "",
		"FILTER_NAME" => "arrFilter",
		"FILTER_PROPERTY_CODE" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "33",	// Инфоблок
		"IBLOCK_TYPE" => "aspro_medc2_content",	// Тип инфоблока
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"LIST_ACTIVE_DATE_FORMAT" => "m-d-Y",	// Формат показа даты
		"LIST_FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "LINK_STAFF",
			1 => "",
		),
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"NEWS_COUNT" => "500",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"SEF_FOLDER" => "/cosmetology/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
		"USE_CATEGORIES" => "N",	// Выводить материалы по теме
		"USE_FILTER" => "N",	// Показывать фильтр
		"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_REVIEW" => "N",	// Разрешить отзывы
		"USE_RSS" => "N",	// Разрешить RSS
		"USE_SEARCH" => "N",	// Разрешить поиск
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE#/",
			"detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		)
	),
	false
);?>
				</div>
					</div>
			</div>
		</div>
	</div>
</div>
 <br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
