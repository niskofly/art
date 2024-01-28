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


$slider_id = randString(7);

$this->addExternalCss(SITE_TEMPLATE_PATH . '/vendors/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css');
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/owl.theme.zs.css');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/vendors/OwlCarousel2-2.3.4/dist/owl.carousel.js');

?>

<div class="partners owl-container" id="<?= $slider_id ?>">
	<?
	/**  /?>
	 * <div class="slider-header">
	 * <div class="projects__block projects__block-1 projects__block-info">
	 * <div class="projects__block-inner">
	 * <h2>rustyle  _  проекты</h2>
	 * <p>RuStyle представляет некоторые из наших проектов. Как бы ни была прекрасна мебель RuStyle, в законченных
	 * интерьерах, созданных профессиональными дизайнерами и декораторами, она смотрится еще более выигрышно. </p>
	 * </div>
	 * </div>
	 * <div class="slider-navs">
	 * <div class="slider-nav nav-left">
	 * <button type="button" class="owl-next-2 animate-arrow arrow-left arrow-light"></button>
	 * </div>
	 * <div class="slider-nav nav-right">
	 * <button type="button" class="owl-prev-2 animate-arrow arrow-left arrow-light" style="transform:
	 * rotate(180deg)"></button>
	 * </div>
	 * </div>
	 * </div>
	 * <?/**/ ?>
	<div class="owl-carousel">
		<?php
		foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction(
				$arItem['ID'],
				$arItem['EDIT_LINK'],
				CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
			);
			$this->AddDeleteAction(
				$arItem['ID'],
				$arItem['DELETE_LINK'],
				CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
				array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
			);
			?>

			<div class="slider__item">
				<a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>">
					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>">
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>
