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
<!---->
<?php
//	pre($arResult["ITEMS"]);
//?>

<ul class="advantages__list">
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


		<li class="advantages__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="advantages__icon">

				<?php
				if (is_array($arItem['DISPLAY_PROPERTIES']['GIF'])) {
					?>
					<img src="<?= $arItem['DISPLAY_PROPERTIES']['GIF']['FILE_VALUE']['SRC'] ?>" alt="">
<!--					<svg class="icon">-->
<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><?php //= $arItem['DISPLAY_PROPERTIES']['GIF']['FILE_VALUE']['SRC'] ?><!--"></use>-->
<!--					</svg>-->
					<?php
				} else {
					?>
					<svg class="icon">
						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#advantage"></use>
					</svg>
					<?php
				}
				?>
			</div>
			<span class="advantages__name"><?= $arItem['NAME'] ?></span>
			<span class="advantages__description"><?= $arItem['PREVIEW_TEXT'] ?></span>
		</li>

		<?php
	}
	?>
</ul>
