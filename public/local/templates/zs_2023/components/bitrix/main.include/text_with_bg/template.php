<?php

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


if ($arResult["FILE"] <> '' && file_get_contents($arResult["FILE"])) {
	$stylesArray = [];
	$styles = '';

	if ($arParams['BG']) {
		$stylesArray[] = 'background-image:url(' . $arParams['BG'] . ')';
	}
	if (!empty($stylesArray)) {
		$styles = 'style="' . implode('; ', $stylesArray) . '"';
	}
	?>
	<div class="text-with-bg text-with-bg--text-<?= $arParams['TEXT_POSITION'] ?>" <?= $styles ?>>
		<div class="text-with-bg__text">
			<?php
			include($arResult["FILE"]);
			?>
		</div>
	</div>
	<?php
}
