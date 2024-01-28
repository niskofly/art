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


$class = [];
if ($arParams['CLASS']) {
	$class[] = $arParams['CLASS'];
}

if ($arParams['ICON']) {
	$class[] = "button__icon iconimg-" . $arParams['ICON'];
}

if ($arParams['BG_COLOR']) {
	$class[] = 'button--' . $arParams['BG_COLOR'];
}

?>


<a class="button <?= implode(' ', $class) ?>" href="<?= $arParams['LINK'] ?>"
   <?php
   if ($arParams['TARGET'] === "Y"){ ?>target="_blank"<?
} ?>
   <?php
   if ($arParams['DOWNLOAD'] === "Y"){ ?>download<?
} ?>
>
	<?= $arParams['NAME'] ?>
</a>
