<?
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty(
	"description",
	"Контакты стоматологии АРТ. Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetPageProperty("title", "Контакты, схема проезда в стоматологию АРТ на Баковской улице");
$APPLICATION->SetTitle("Поиск");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/contacts.css");
?>

<div class="container">

</div>



<br><?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
