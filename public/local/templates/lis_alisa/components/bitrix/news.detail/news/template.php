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

?>
<div class="news-detail block-pb">

	<a class="news-detail__back" href="<?= $arResult['LIST_PAGE_URL'] ?>">
		<svg class="icon">
			<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#arrowPrev"></use>
		</svg>
		<?= Loc::getMessage('AL_NEWS_DETAIL_BACK') ?>
	</a>

	<div class="news-detail__content container--sm">
		<h1 class="news-detail__title"><?= $APPLICATION->showTitle(false) ?></h1>

		<?php
		if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]) {
			?>
			<div class="news-detail__date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></div>
			<?php
		}

		if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arResult["FIELDS"]["PREVIEW_TEXT"] != '') {
			$previewText = $arResult["FIELDS"]["PREVIEW_TEXT"];
			if ($arResult['PREVIEW_TEXT_TYPE'] == 'text') {
				$previewText = '<p>' . $previewText . '</p>';
			}
			?>
			<div class="news-detail__preview-text">
				<?= $previewText ?>
			</div>
			<?php
		}

		if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) {
			?>
			<img class="news-detail__picture" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
				 width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
				 height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
				 title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
			<?php
		}

		if ($arResult["FIELDS"]["DETAIL_TEXT"] != '') {
			$detailText = $arResult["FIELDS"]["DETAIL_TEXT"];
			if ($arResult['DETAIL_TEXT_TYPE'] == 'text') {
				$detailText = '<p>' . $detailText . '</p>';
			}
			?>
			<div class="news-detail__preview-text">
				<?= $detailText ?>
			</div>
			<?php
		}
		?>
	</div>
</div>
