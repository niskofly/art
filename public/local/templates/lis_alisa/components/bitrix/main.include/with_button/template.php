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

$title = $arParams['TITLE'] ?? '';
?>
<div class="inc-with-button">

	<?php
	if ($title != '') {
		?>
		<h2><?= $title ?>: </h2>
		<?php
	}

	include($arResult["FILE"]);
	?>

	<div class="inc-with-button__button">
		<?php
		if ($title != '') {
			?>
			<a class="button button--gray" href="<?= $arParams['LINK'] ?>"><?= $arParams['BUTTON_TEXT'] ?></a>
			<?php
		}
		include($arResult["FILE"]);
		?>
	</div>
</div>
