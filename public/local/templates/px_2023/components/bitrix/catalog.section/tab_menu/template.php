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
?>

<div class="tab-menu__wrapper">
	<div class="tab-menu__section">

		<div class="tab-menu__section-header">
			<a href="https://<?=SITE_SERVER_NAME?>/<?= $arResult['LIST_PAGE_URL'];?>/<?= $arResult['CODE'];?>" class="tab-menu__section-name">
				<svg class="icon icon--close">
					<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#services"></use>
				</svg>
				<?= $arResult['NAME'];?>
			</a>

			<div class="tab-menu__section-close">
				<span>Закрыть</span>
				<svg class="icon icon--close">
					<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#close"></use>
				</svg>
			</div>
		</div>


		<?php

		foreach ($arResult['SECTIONS'] as $arItemSection) {



			if (!isset($arItemSection['ITEMS']) || empty($arItemSection['ITEMS'])) {
				continue;
			}

			$nosection = false;
			if ($arItemSection['NAME'] !== 'noname') {
				$nosection = true;

				?>
				<div class="tab-menu__section-title">
					<?= $arItemSection['NAME'] ?>
				</div>
				<?php
			}

			?>
			<div class="tab-menu__sublist <?= $nosection ? 'tab-menu__list--column' : '' ?>">
				<?php
				foreach ($arItemSection['ITEMS'] as $arItem) {


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
					<div class="tab-menu__link">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
					</div>
					<?php
				}
				?>

			</div>
			<?php
		}
		?>
	</div>
</div>




