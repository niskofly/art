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

$uriString = $APPLICATION->GetCurPage(false);

$link = '';
if (!empty($arParams['LINK']) && $arParams['LINK'] !== $uriString) {
	$link = $arParams['LINK'];
}

$nofollow = $arParams['NO_FOLLOW'] == 'Y' ? 'rel="nofollow"' : '';

echo $link ? '<a href="' . $link . '" ' . $nofollow : '<span';
echo ' class="logo">';
?>
	<picture>
		<?php
		if ($arParams['IMG_BIG']) {
			?>
			<source media="(min-width: 650px)" srcset="<?= $arParams['IMG_BIG'] ?>">
			<?php
		}
		?>
		<img src="<?= $arParams['IMG'] ?>" alt="<?= $arParams['ALT'] ?>">
	</picture>

<?php
if ($arParams['HIDE_TEXT'] != "Y") {
	include($arResult["FILE"]);
} ?>

<?php
echo $link ? '</a>' : '</span>';
