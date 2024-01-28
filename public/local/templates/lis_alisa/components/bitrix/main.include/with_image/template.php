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
	<div class="inc-with-image__image">
		<img src="<?= $arParams['IMAGE'] ?>" alt="картинка">
	</div>
	<div class="inc-with-image__text">
		<?php
		if ($title != '') {
			?>
			<h2><?= $title ?>: </h2>
			<?php
		}
		include($arResult["FILE"]);
		?>
	</div>

</div>
