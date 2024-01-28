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


$style = [];

if ($arParams['BG_COLOR']) {
	$style[] = 'color : ' . $arParams['BG_COLOR'];
}

if ($arParams['BG_FILE']) {
	$style[] = 'background-image: url(' . $arParams['BG_FILE'] . ')';
}


if (!empty($style)) {
	$style = 'style="' . implode('; ', $style) . '"';
}
?>


<div class="bg-header" <?= !empty($style) ? $style : ""; ?>
<?= $APPLICATION->GetProperty("background_header") ?><span class="bxhtmled-surrogate-inner"><span
		class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on"
														   spellcheck="false">Код PHP</span></span>')"&gt;
<div class="bg-header_filter">
	<div class="bg-header__block">
		<div class="bg-header_td">
			<div class="bg-header__title">
				<h1><?
					$APPLICATION->ShowTitle(false) ?></h1>
			</div>
		</div>
	</div>
</div>
</div>
