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


$imgSrc = $arParams['BG_FILE'] ?? '';
$withImageClass = ($imgSrc != '') ? '' : 'banner-top--no-image';

?>

<div class="banner-top <?= $withImageClass ?>">
	<div class="banner-top__content">
		<div class="banner-top__title">
			<h1><?php
				$APPLICATION->ShowTitle(false) ?></h1>
			<?php
			include($arResult["FILE"]);?>
		</div>
		<?php
		if ($imgSrc != '') {
			?>
			<div class="banner-top__image">
				<img src="<?=$imgSrc?>" alt="<?php
				$APPLICATION->ShowTitle(false) ?>" class="banner-top__img">
			</div>
			<?php
		} ?>
	</div>
</div>

