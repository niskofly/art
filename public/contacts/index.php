<?
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty(
	"description",
	"Контакты стоматологии АРТ. Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetPageProperty("title", "Контакты, схема проезда в стоматологию АРТ на Баковской улице");
$APPLICATION->SetTitle("Контакты");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/contacts.css");
?>

<div class="container">
	<div class="contacts-main__row">
		<?
		$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
						"AREA_FILE_SHOW" => "page",
						"AREA_FILE_SUFFIX" => "text",
						"EDIT_TEMPLATE" => ""
				)
		); ?>

		<?
		$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				array(
						"AREA_FILE_SHOW" => "page",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => ""
				)
		); ?>
	</div>
</div>



<br><?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
