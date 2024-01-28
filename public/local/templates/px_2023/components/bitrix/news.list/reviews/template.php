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
<div class="reviews__container owl-container" id="<?= $slider_id ?>">
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
				<div class="reviews__wrapper">
					<div class="reviews__avatar">
						<?php
						if (!empty($arResult["PREVIEW_PICTURE"])) {
							?>
							<img src="<?= $arItem['PREVIEW_PICTURE'] ?>" alt="<?= $arItem['NAME'] ?>">
							<?php
						} else {
							?>
							<img src="/local/templates/px_2023/assets/images/user.jpg" alt="<?= $arItem['NAME'] ?>">
							<?php
						}
						?>
					</div>
					<div class="reviews__content">
						<div class="reviews__date"><?= $arItem['DATE_ACTIVE_FROM'] ?></div>
						<div class="reviews__name"><?= $arItem['NAME'] ?></div>
						<div class="reviews__text"><?= $arItem['PREVIEW_TEXT'] ?></div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
<div class="button__container"><a href="/pacientam/otzyvy/" class="button button--def equipment__button">cмотреть все отзывы</a></div>
