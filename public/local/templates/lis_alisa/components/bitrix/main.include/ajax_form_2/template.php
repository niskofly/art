<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$this->addExternalCss('/local/media/css/normalize.css');

$this->addExternalJs('/local/vendor/Inputmask-5.x/dist/jquery.inputmask.js');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/assets/components/forms/script.js');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/assets/components/modal/script.js');
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/forms/forms.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/forms/placeholder.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/buttons/style.css');
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/modal/style.css');
$this->addExternalCss(SITE_TEMPLATE_PATH . '/components/bitrix/form.result.new/ajax_form/style.css');


$phone_src = $arParams["PHONE"];
$phone_clear = strip_tags($phone_src);
$phone_clear = preg_replace('/[^0-9]/', '', $phone_clear);

$first_num = substr($phone_clear, 0, 1);
if ((int)$first_num === 7 || (int)$first_num === 8) {
	$phone_clear = substr($phone_clear, 1);
}
$phone_clear = '+7' . $phone_clear;


?>
<div class="prices-back-call-call">
	<div class="prices-back-call__left">
		<div class="prices-back-call__img">
			<img class="load" loading="lazy" src="<?= $arParams['IMG'] ?>"
				 alt="back-call">
		</div>


		<div class="prices-back-call__text">
			<span class="prices-back-call__text-title"><?= $arParams['TITLE'] ?></span>
			<a class="prices-back-call__text-call" href="tel:<?= $phone_clear ?>">
				<img class="load" loading="lazy" data-src="/include/index-blocks/img/prices_back-call/call.svg"
					 alt="call">
				<span><?= $phone_src ?></span>
			</a>
			<p class="prices-back-call__text-descr">
				<?php
				include($arResult["FILE"]); ?></p>
		</div>


	</div>
	<?php
	$APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"ajax_form",
		array(
			"COMPONENT_TEMPLATE" => "ajax_form",
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => "1",
			"LIST_URL" => "",
			"EDIT_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"SEF_FOLDER" => "/",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"YA_TARGET_ID" => "",
			"GT_TARGET_ID" => "",
			"BUTTON_TEXT" => "Заказать обратный звонок",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"VARIABLE_ALIASES" => array(
				"WEB_FORM_ID" => "WEB_FORM_ID",
				"RESULT_ID" => "RESULT_ID",
			)
		),
		false
	); ?>

</div>
