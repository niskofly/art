<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/tail_licenses.css');


?>
<div class="tails-licenses">
	<?php
	if ($arParams["DISPLAY_TOP_PAGER"]) {
		?>
		<div class="tails-licenses__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}
	?>
	<div class="tails-licenses__list">
		<?php
		$listPageUrl = '';
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

			if ($listPageUrl == '') {
				$listPageUrl = $arItem['LIST_PAGE_URL'];
			}
			$iconSrc = $arItem['PREVIEW_PICTURE']['SRC'] ?? '';

			?>
			<div class="tails-licenses__item">

				<div class="tail-licenses" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="tail-licenses__title">
						<?= $arItem['NAME'] ?>
						<?php
						if ($iconSrc != '') {
							?>
							<img class="tail-licenses__icon" src="<?= $iconSrc ?>" alt="<?= $arItem['NAME'] ?>">
							<?php
						}
						?>
					</div>
					<?php
					if ($arItem['AL_DISPLAY_PROPERTIES']['JOBS'] != '') {
						?>
						<div class="tail-licenses__jobs">
							<svg class="icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#jobs"></use>
							</svg>
							<?= $arItem['AL_DISPLAY_PROPERTIES']['JOBS']; ?>
						</div>
						<?php
					}
					if ($arItem['AL_DISPLAY_PROPERTIES']['ANALYZERS'] != '') {
						?>
						<div class="tail-licenses__analyzers">
							<svg class="icon">
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#analyzers"></use>
							</svg>
							<?= $arItem['AL_DISPLAY_PROPERTIES']['ANALYZERS']; ?>
						</div>
						<?php
					}
					if ($arItem['AL_DISPLAY_PROPERTIES']['PRICE'] != '') {
						?>
						<div class="tail-licenses__price">
							<?= $arItem['AL_DISPLAY_PROPERTIES']['PRICE']; ?>&#8381;
						</div>
						<?php
					}

					if (isset($arItem['FIELDS']['PREVIEW_TEXT']) && $arItem['FIELDS']['PREVIEW_TEXT'] != '') {
						?>
						<div class="tail-news__preview-text">
							<?= $arItem['FIELDS']['PREVIEW_TEXT'] ?>
						</div>
						<?php
					}
					if (isset($arItem['PROPERTIES']['WORKS']) && !empty($arItem['PROPERTIES']['WORKS']['VALUE'])) {
						?>
						<div class="tail-news__preview-text">
							<ul>
								<li>
									<?= implode('</li><li>', $arItem['PROPERTIES']['WORKS']['VALUE']) ?>
								</li>
							</ul>
						</div>
						<?php
					}

					if ($arItem['DISPLAY_ACTIVE_FROM']) {
						?>
						<div class="tail-news__date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></div>
						<?
					}

					if ($arItem['DETAIL_PAGE_URL']) {
						?>
						<div class="tail-news__link">
							<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= Loc::getMessage(
									'TAILS_NEWS_READ_MORE'
								) ?></a>
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
		<div class="tails-licenses__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}
	?>

</div>
