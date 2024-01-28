<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

/** @var Bitrix\Main\ $APPLICATION */
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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/accordion/style.css');
$this->addExternalJs(SITE_TEMPLATE_PATH . '/assets/components/accordion/script.js');
?>

<div class="block-pb faq">
	<div class="faq__list">
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
		?>
			<div class="faq__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="accordion">
					<div class="read-more accordion__buttons">
						<div class="accordion__button accordion__button--show">
							<div class="accordion__button-content">
								<span><?= $arItem['NAME'] ?></span>
								<svg>
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#plus"></use>
								</svg>
							</div>
						</div>
						<div class="accordion__button accordion__button--hide">
							<div class="accordion__button-content">
								<span><?= $arItem['NAME'] ?></span>
								<svg>
									<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/sprite.svg#minus"></use>
								</svg>
							</div>
						</div>
					</div>
					<div class="accordion__wrapp-hide">
						<div class="accordion__content">
							<?= $arItem['PREVIEW_TEXT'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php
		} ?>
	</div>
	<?php
	if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
	?>
		<div class="tails-news__pager">
			<?= $arResult["NAV_STRING"]; ?>
		</div>
	<?php
	}
	?>
</div>
