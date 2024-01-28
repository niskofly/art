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
<?
/*pre($arResult);*/ ?>
<div class="b8_c">

	<?
	//pre($arResult["ITEMS"][0])?>

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

		$img['src'] = $arItem['PREVIEW_PICTURE']['SRC'];
		?>

		<div class="b8_c1" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<table class="b8_t">
				<tr>
					<td class="b8_td">
						<a class="b8_a" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
						   style="background-image:url('<?= $img['src'] ?>');"></a>
					</td>
					<td class="b8_td">
						<div class="b8_w1">
							<?= $arItem['ACTIVE_FROM'] ?>
						</div>
						<h2 class="b8_h">
							<?= $arItem['NAME'] ?>
						</h2>
						<div class="b8_w2">
							<?= $arItem['PREVIEW_TEXT'] ?>
						</div>
						<?php
						if ($arItem['PROPERTIES']['SOURCE']['VALUE']) {
							?>
							<div class="b8_w3">
								Источник:
								<?php
								if ($arItem['PROPERTIES']['SOURCE']['~DESCRIPTION']) {
									?>
									<a class="b8_w3-a" target="_blank" rel="nofollow"
									   href="http://<?= $arItem['PROPERTIES']['SOURCE']['~DESCRIPTION'] ?>">
										<?= $arItem['PROPERTIES']['SOURCE']['VALUE'] ?>
									</a>
									<?php
								} else {
									?>
									<div class="b8_w3">
										<?= $arItem['PROPERTIES']['SOURCE']['VALUE'] ?>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						} ?>
						<a class="bn" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							Подробнее
						</a>
					</td>
				</tr>
			</table>
		</div>

		<?
	} ?>


	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<br/><?= $arResult["NAV_STRING"] ?>
	<?
	endif; ?>
</div>
