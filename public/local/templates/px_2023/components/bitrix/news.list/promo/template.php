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


$slider_id = randString(8);

$this->addExternalCss(SITE_TEMPLATE_PATH . '/vendors/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css');
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/owl.theme.zs.css');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/vendors/OwlCarousel2-2.3.4/dist/owl.carousel.js');

?>

<div class="promo__container owl-container" id="<?= $slider_id ?>">
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


			<div class="slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="promo__card card-promo"
					 style="background: url(<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>) no-repeat;background-position: center;background-size: cover;">
					<div class="card-promo__desc">
						<span class="card-promo__label">Акция</span>
						<div class="card-promo__name"><?= $arItem['NAME'] ?></div>
						<div class="card-promo__text"><?= $arItem['PREVIEW_TEXT'] ?> </div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
