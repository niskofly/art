<?php
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Стоматология");


Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services.css");

?>





<br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
