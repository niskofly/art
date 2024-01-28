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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/tail_t1.css');

?>
<div class="tails-t1">
	<?php
	if ($arParams["DISPLAY_TOP_PAGER"]) {
		?>
		<div class="tails-t1__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}
	?>
	<div class="tails-t1__list">
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

			$iconType = '';
			if ($arItem['PROPERTIES']['ICON_SPRITE']['VALUE']) {
				$iconType = 'sprite';
			} elseif ($arItem['PROPERTIES']['ICON_CLASS']['VALUE']) {
				$iconType = 'css';
			} elseif ($arItem['PROPERTIES']['ICON_FILE']['VALUE']) {
				$iconType = 'file';
			}


			$previewText = $arItem['PREVIEW_TEXT'] ?? '';
			?>
			<div class="tails-t1__item">
				<div class="tail-t1" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<?php
					if ($iconType != '') {
						?>
						<div class="tail-t1__icon">
							<?php
							// пока можно отработать только один вариант
							switch ($iconType) {
								case 'sprite':
									?>
									<svg>
										<use
											xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#<?= $arItem['PROPERTIES']['ICON_SPRITE']['VALUE'] ?>"></use>
									</svg>
									<?php
									break;

								case 'css':
									?>
									Код вывода иконки слилями CSS
									<?php
									break;

								case 'file':
									?>
									Код вывода иконки отдельной картинкой
									<?php
									break;
							}
							?>
						</div>
						<?php
					}

					if ($previewText != '') {
						?>
						<div class="tail-t1__text">
							<?= $previewText ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		} ?>
	</div>
	<?php
	if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
		?>
		<div class="tails-t1__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}
	?>
</div>
