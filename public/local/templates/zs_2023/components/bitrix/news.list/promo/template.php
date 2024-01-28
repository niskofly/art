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
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/tails/tails_t5.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/proportionalbox.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/arrows/type_1.css");
?>
<div class="promo">
	<div class="promo__list">
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
			<div class="promo__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="tails-t5">
					<?php
					if ($arItem['PROPERTIES']['SALE']['VALUE']) {
						?>
						<div class="tails-t5__label">
							<?= $arItem['PROPERTIES']['SALE']['VALUE'] ?>
						</div>
						<?php
					}
					?>
					<div class="tails-t5__content promo__tail-content"
						 style="background-image: url('<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>');">
						<div class="tails-t5__date-range">
							<?php
							if (!empty($arItem['DATE_ACTIVE_FROM'])) {
								echo 'c ' . FormatDate("j F", MakeTimeStamp($arItem['DATE_ACTIVE_FROM']));
							}
							if (!empty($arItem['DATE_ACTIVE_TO'])) {
								echo ' до ' . FormatDate("j F", MakeTimeStamp($arItem['DATE_ACTIVE_TO']));
							}
							?>

						</div>
						<div class="tails-t5__title like-h4"><?= $arItem['NAME'] ?></div>
						<div class="tails-t5__text"><?= TruncateText($arItem["PREVIEW_TEXT"], 130); ?></div>
						<a class="live-arrow link__more" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">Узнать больше</a>
					</div>
				</div>
			</div>
			<?php
		}; ?>
	</div>

	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<br/><?= $arResult["NAV_STRING"] ?>
	<?
	endif; ?>
</div>
