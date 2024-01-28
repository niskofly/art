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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/section_tale.css');

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = ["CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')];


$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
$this->AddDeleteAction(
		$arResult['SECTION']['ID'],
		$arResult['SECTION']['DELETE_LINK'],
		$strSectionDelete,
		$arSectionDeleteParams
);

$parentName = $arResult['SECTION']['NAME'];
if (isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "") {
	$parentName = $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"];
}

?>
<div class="section-list">
	<h1 class="section-list__parent-title" id="<?= $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
		<a href="<?= $arResult['SECTION']['SECTION_PAGE_URL']; ?>">
			<?= $parentName ?>
		</a>
	</h1>
	<?php

	if (0 < $arResult["SECTIONS_COUNT"]) {
		?>
		<div class="section-list__list">
			<?php
			foreach ($arResult['SECTIONS'] as &$arSection) {
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction(
						$arSection['ID'],
						$arSection['DELETE_LINK'],
						$strSectionDelete,
						$arSectionDeleteParams
				);

				$picture = CFile::ResizeImageGet(
						$arSection['PICTURE']['ID'],
						[
								'width' => 500,
								'height' => 500
						],
						BX_RESIZE_IMAGE_PROPORTIONAL,
						false,
						[
								[
										"name" => "sharpen",
										"precision" => 0
								]
						],
						false,
						85
				);

				?>
				<div class="section-list__item" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">

					<a class="section-tale" href="<?= $arSection['SECTION_PAGE_URL']; ?>"
					   style="background-image: url('<?= $picture['src'] ?>');"
					>
						<h2 class="bx_catalog_tile_title"><?= $arSection['NAME']; ?></h2>

					</a>


				</div>

				<?php
			}
			?>
		</div>
		<?php
	}
	?>
</div>
