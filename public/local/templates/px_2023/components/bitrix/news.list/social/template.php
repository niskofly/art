<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>


<div class="social">
	<span class="social__name">Мы в соц сетях</span>
	<div class="social__list">
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
			<div class="social__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<a href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>" class="social__link">
					<svg class="icon" style="fill: <?= $arItem['PROPERTIES']['ICON_COLOR']['VALUE'] ?>;">
						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#<?= $arItem['PROPERTIES']['ICON_ID']['VALUE'] ?>"></use>
					</svg>
				</a>
			</div>
			<?php
		} ?>
	</div>
</div>

