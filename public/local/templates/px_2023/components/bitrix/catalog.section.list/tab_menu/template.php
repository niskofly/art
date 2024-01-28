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
<div class="tab-menu-scroll" data-mcs-theme="inset-3-dark">
	<div class="tab-menu__list">

		<?php
		foreach ($arResult['SECTIONS'] as $arSection) {
			?>
			<div class="tab-menu__item" data-iblock-id="<?= $arParams['IBLOCK_ID'] ?>"
				 data-section-id="<?= $arSection['ID'] ?>">
				<?= $arSection['NAME'] ?>
				<button type="button">
					<img src="/local/templates/px_2023/assets/icons/arrow-grad.svg" alt="">
				</button>
			</div>
			<div class="tab-menu__item-child"></div>
			<?php
		}
		?>

	</div>
</div>
