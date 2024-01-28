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
$this->setFrameMode(true); ?>

<form action="<?= $arResult["FORM_ACTION"] ?>" class="search">

	<?php
	if ($arParams["USE_SUGGEST"] === "Y") {
		$APPLICATION->IncludeComponent(
			"bitrix:search.suggest.input",
			"",
			array(
				"NAME" => "q",
				"VALUE" => "",
				"INPUT_SIZE" => 15,
				"DROPDOWN_SIZE" => 10,
			),
			$component, array("HIDE_ICONS" => "Y")
		);
	} else {
		?>
		<input type="text" name="q" value="поиск" class="input"/>
		<?php
	}
	?>
	<input src="<?= SITE_TEMPLATE_PATH ?>/assets/images/icon_search.svg" alt="Искать" name="s" type="image"
		   value="<?= GetMessage("BSF_T_SEARCH_BUTTON"); ?>"/>
</form>
