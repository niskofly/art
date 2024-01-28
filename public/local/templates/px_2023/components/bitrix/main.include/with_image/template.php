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

$title = htmlspecialchars_decode($arParams['TITLE'] ?? '');

?>

<div class="inc-with-image">
	<h2 class="title section-site__title inc-with-image__title">
		<?php
		if ($title != '') {
			?>
			<?= $title ?>
			<?php
		}
//		include($arResult["FILE"]);
		?>
	</h2>
	<span class="inc-with-image__image">
			<img src="<?= $arParams['IMAGE'] ?>" alt="картинка">
	</span>
	<div class="inc-with-image__text">
		<?php
			include($arResult["FILE"]);
		?>
	</div>
	<?php
		if ($arParams['BUTTON_TEXT'] != '') {
			?>
			<a href="<?= $arParams['BUTTON_LINK'] ?>" class="inc-with-image__link button button--def">
				<?= $arParams['BUTTON_TEXT'] ?>
			</a>
	<?
		}
	?>

</div>
