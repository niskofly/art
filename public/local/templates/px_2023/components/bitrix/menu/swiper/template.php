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

$this->addExternalJs(SITE_TEMPLATE_PATH . "/assets/js/swiper-bundle.js");

$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/css/swiper-bundle.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/css/swiper_custom.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/arrows/type_1.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/filters/blind.css");

$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/tails/product-card.css");

?>

<div class="products-sections slider">
	<div class="swiper blind">
		<div class="swiper-wrapper">
			<?php
			foreach ($arResult as $arItem) {
				?>
				<div class="products-sections__item swiper-slide">
					<a class="products-sections__link" href="<?= $arItem['LINK'] ?>">
						<?= $arItem['TEXT'] ?>
					</a>
				</div>
				<?php
			} ?>
		</div>
	</div>
	<div class="slider__arrow">
		<div class="arrow">
			<svg width="52" height="8" viewBox="0 0 52 8">
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#arrow"></use>
			</svg>
		</div>
	</div>
</div>
