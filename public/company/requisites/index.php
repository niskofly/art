<?
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Реквизиты компании АРТ");
$APPLICATION->SetPageProperty(
	"description",
	"Контакты стоматологии АРТ. Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetPageProperty("title", "Реквизиты компании АРТ");
$APPLICATION->SetTitle("Реквизиты");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");
?><div class="page-company">
	<div class="container">
		<div class="with-sidebar">
			<div class="with-sidebar__sidebar-menu">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"company",
	Array(
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
);?>
			</div>
			<div class="with-sidebar__main-content">
				<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
								"AREA_FILE_SHOW" => "page",
								"AREA_FILE_SUFFIX" => "requisites",
								"EDIT_TEMPLATE" => ""
						)
				);?>
			</div>
		</div>
	</div>
</div>


<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
