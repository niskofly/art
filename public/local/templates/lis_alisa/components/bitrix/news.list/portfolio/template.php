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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/tail_news.css');
?>
<div class="portfolio">
	<?php
	if ($arParams["DISPLAY_TOP_PAGER"]) {
		?>
		<div class="portfolio__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}
	?>
	<div class="portfolio__list<?= $arParams["DISPLAY_BOTTOM_PAGER"] ? ' mb-0' : '' ?>">
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

			$listPageUrl = $arItem['LIST_PAGE_URL'];
			$previewText = $arItem['FIELDS']['PREVIEW_TEXT'] ?? '';
			$works = $arItem['PROPERTIES']['WORKS']['VALUE'] ?? [];
			$date = $arItem['FIELDS']['DISPLAY_ACTIVE_FROM'] ?? '';
			$title = $arItem['FIELDS']['NAME'] ?? '';
			?>
			<div class="portfolio__item">
				<div class="tail-news" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<?php
					if ($date != '') {
						?>
						<div class="tail-news__date"><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></div>
						<?php
					}
					if ($title) {
						?>
						<div class="tail-news__title"><?= $title ?></div>
						<?php
					}
					if ($previewText != '' || !empty($works)) {
						?>
						<div class="tail-news__preview-text">
							<?= $previewText ?>
							<?php
							if (!empty($works)) {
								?>
								<ul>
									<li>
										<?= implode('</li><li>', $works) ?>
									</li>
								</ul>
								<?php
							}
							?>
						</div>
						<?php
					}
					if ($arItem["DETAIL_TEXT"] != '' || $arParams["HIDE_LINK_WHEN_NO_DETAIL"] != 'Y') {
						?>
						<div class="tail-news__link">
							<a class="button-link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
								<?= Loc::getMessage('TAILS_NEWS_READ_MORE') ?>
								<svg>
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#arrowNext"></use>
								</svg>
							</a>
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
		<div class="portfolio__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
		<?php
	}

	if (isset($arParams["SHOW_MORE_BUTTON"]) && $arParams["SHOW_MORE_BUTTON"] != "N") {
		?>
		<div class="show-more">
			<a href="<?= $listPageUrl ?>" class="button-border">Читать больше новостей</a>
		</div>
		<?php
	}
	?>

</div>
