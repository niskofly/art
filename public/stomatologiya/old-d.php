<?php
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Стоматология");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

?>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"new_multilevel",
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left_sub",
		"DELAY" => "N",
		"MAX_LEVEL" => "4",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_THEME" => "site",
		"ROOT_MENU_TYPE" => "left_aside",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "new_multilevel"
	),
	false
);?>


 <br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
