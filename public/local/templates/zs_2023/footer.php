<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
IncludeTemplateLangFile(__FILE__);

//use Bitrix\Main\Web\Uri;
//$uriString = Application::getInstance()->getContext()->getRequest()->getRequestUri();
//$uri = new Uri($uriString);
//$is_main_page = $uri->getPath() === "/" ? true : false ;

?>
</main>
<footer class="site__footer">
	<div class="container">
		<div class="site-footer">
			Здесь футер. Пара компонентов для примера уже есть
			<?php
			$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"simple",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "",
					"DELAY" => "Y",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(""),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "footer_1",
					"USE_EXT" => "N"
				)
			); ?>
			<?php
			$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"address",
				array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => SITE_TEMPLATE_PATH . "/assets/include_areas/address.php"
				)
			); ?>
		</div>
	</div>
</footer>
<?php
$APPLICATION->IncludeComponent(
	"zs:modal_banners",
	".default",
	array(
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "information",
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
</body>
</html>
