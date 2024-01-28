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
<div class="doctors-list">
	<?
	if ($arParams["DISPLAY_TOP_PAGER"]): ?>
		<?= $arResult["NAV_STRING"] ?><br/>
	<?
	endif; ?>
	<?
	foreach ($arResult["ITEMS"] as $arItem): ?>
		<?
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

		<div class="doctor__item"
			 style="background-image: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>);"
			 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<a class="doctor__link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">

			<div class="bottom-doctors">
				<div class="doctors__title">
					<?= $arItem['NAME'] ?>
				</div>
				<div class="doctors__speciality">
					<?= $arItem['PROPERTIES']['POST']['VALUE'] ?>
				</div>
				<div class="doctors__work">
					<?= $arItem['PROPERTIES']['WORK']['VALUE'] ?>
				</div>
				<div  class="button button--def doctors__button">Записаться</div>
			</div>
			</a>
		</div>

	<?
	endforeach; ?>

</div>
