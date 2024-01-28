<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="news-detail">

		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="vopros__title"><?= $arResult['NAME'] ?></a>
		<div class="vopros__name"><?= $arResult['PROPERTIES']['VOPROS']['NAME'] ?></div>
		<div class="vopros__value"><?= $arResult['PROPERTIES']['VOPROS']['~VALUE']['TEXT'] ?></div>
		<div class="otvet__name"><?= $arResult['PROPERTIES']['OTVET']['NAME'] ?></div>
		<div class="otvet__value"><?= $arResult['PROPERTIES']['OTVET']['~VALUE']['TEXT'] ?></div>

</div>
