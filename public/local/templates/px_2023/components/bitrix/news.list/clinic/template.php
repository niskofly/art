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

?>


<div class="about-clinic__list about-list ">
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


		<div class="about-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="about-list__name">
				<svg class="icon">
					<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#duble-check"></use>
				</svg>
				<?= $arItem['NAME'] ?>
			</div>
			<div class="about-list__description">
				<?= $arItem['PREVIEW_TEXT'] ?>
			</div>
		</div>
		<?php
	}
	?>
</div>
