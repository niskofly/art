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
<div class="tabs-vertical">
	<div class="tabs-vertical__nav">
		<?php
		$item = 0;
		foreach ($arResult['NAV'] as $key => $arNavItem) {
			?>
			<button type="button" data-target="tab_<?= $key ?>"
					class="tabs-vertical__nav-item<?= $item === 0 ? ' active' : '' ?>">
				<?= $arNavItem ?>
			</button>
			<?php
			if ($item === 0) {
				$item += 1;
			}
		}
		?>
	</div>

	<div class="tabs-vertical__list">
		<?php
		$item = 0;
		foreach ($arResult["ITEMS"] as $key => $arItem) {
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
			<div class="tabs-vertical__item<?= $item === 0 ? ' active' : '' ?>" id="tab_<?= $key ?>">
				<div class="tabs-vertical__content" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<?= $arItem['PREVIEW_TEXT'] ?>
				</div>
			</div>
			<?php
			if ($item === 0) {
				$item += 1;
			}
		}
		unset($item);
		?>
	</div>
</div>
