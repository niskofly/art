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
<div class="otzyvy">
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
		<div class="otzyv" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="otzyv__icon">
				<img src="https://new.artistom.ru/upload/medialibrary/4a7/f500y4p1nh4ycid1pmv3izjrxf0311q1/Group-1869.png"
					 alt="otzyv">
			</div>
			<div class="otzyv__column">
				<div class="otzyv__date"><?
					if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
						<div class="news-date-time"><?
							echo $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
					<?
					endif ?></div>
				<div class="otzyv__name">
					<?
					if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
						<?
						if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
							<?
							echo $arItem["NAME"] ?>
						<?
						else: ?>
							<?
							echo $arItem["NAME"] ?>
						<?
						endif; ?>
					<?
					endif; ?>
				</div>
				<div class="otzyv__text">
					<?
					echo $arItem['PREVIEW_TEXT'] ?>
				</div>
			</div>
		</div>
	<?
	endforeach; ?>
	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<br/><?= $arResult["NAV_STRING"] ?>
	<?
	endif; ?>
</div>
