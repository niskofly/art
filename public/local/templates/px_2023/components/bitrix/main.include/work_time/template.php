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

$dev_src = file_get_contents($arResult["FILE"]);

if ($dev_src !== "" || $dev_src !== false) {
	?>

	<?php
	if ($arParams['SHOW_ICON'] === "Y") {
		?>
		<svg class="icon">
			<use xlink:href="<?= $arParams['SVG_SPRITE'] ?>"></use>
		</svg>
		<?php
	} ?>
	<?= $dev_src ?>

	<?php
}




