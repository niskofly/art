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
?>
<div class="photos-height-lock">
	<div class="photos-height-lock__list ">
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

			$small_img = CFile::ResizeImageGet(
				$arItem["PREVIEW_PICTURE"]["ID"],
				array(
					'width' => 9999,
					'height' => 200
				),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				false,
				[
					"name" => "sharpen",
					"precision" => 0
				],
				false,
				85

			);
			if (!isset($small_img['src'])) {
				$small_img['src'] = $arItem["PREVIEW_PICTURE"]['SRC'];
			}
			?>

			<div class="photos-height-lock__item">
				<a
					data-fancybox="gallery"
					class="" href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
					id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
				>
					<img class="" src="<?= $small_img['src'] ?>" alt="<?= $arItem["NAME"] ?>">
				</a>
			</div>

			<?php
		}
		?>

	</div>
</div>
