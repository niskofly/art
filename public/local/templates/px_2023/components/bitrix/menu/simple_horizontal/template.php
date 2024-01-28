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
<ul class="simple_horizontal_menu">
	<?
	foreach ($arResult as $arItem) { ?>
		<li><a href="<?= $arItem['LINK'] ?>" class="<?= !empty($arItem['SELECTED']) ? "selected" : "" ?>"
			   title="<?= $arItem['TEXT'] ?>"><?= $arItem['TEXT'] ?></a></li>
	<?
	} ?>
</ul>
