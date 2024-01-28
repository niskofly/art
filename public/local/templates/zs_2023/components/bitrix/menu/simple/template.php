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

$this->setFrameMode(true); ?>
<ul class="menu-left">
	<?php
	foreach ($arResult as $arItem) {
		?>
		<li class="menu-left__item <?= !empty($arItem['SELECTED']) ? "menu-left__item--active" : "" ?>">
			<a class="menu-left__link" href="<?= $arItem['LINK'] ?>"
			   title="<?= $arItem['TEXT'] ?>"><?= $arItem['TEXT'] ?></a>
		</li>
		<?php
	}
	?>
</ul>
