<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Студия ZVEZDA");

use \Bitrix\Main\Page\Asset;

//Asset::getInstance()->addJs("/local/vendors/jquery/jquery-3.5.1.min.js");

//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH ."/assets/components/buttons/default.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/forms.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/forms/placeholder.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/popup/style.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/popup/script.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/assets/components/forms/script.js");
?>

	Внимание!
	Что бы передавать скрытое св-во нужно подготовить его:
	Наример если передаём в компоненте пераметр в массиве ELEMENT_NAME
	Текст: " ",
	Значение: $element_name; -- Это проверить, похоже на лишнее
	Тип поля: hidden
	Параметры: ARPARAM_ELEMENT_NAME


	<div
		class="button button--reception popup_form_key_js"
		data-id_form="1"
		data-el_name="Без указания услуги. Форма в шапке сайта"
		data-form_title="Заголовок формы"
	>
		Записаться на приём
	</div>


<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
