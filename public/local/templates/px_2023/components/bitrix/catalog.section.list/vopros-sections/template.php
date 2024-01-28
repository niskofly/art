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

<?php if (!empty($arResult['SECTIONS'])): ?>
		<div class="vopros-sections">

			<?php foreach ($arResult['SECTIONS'] as $section): ?>
				<div class="filter-sections" data-filter="/<?= isset($section['CODE']) ? $section['CODE'] : ''; ?>/">
					<?= isset($section['NAME']) ? $section['NAME'] : ''; ?>
				</div>
			<?php endforeach; ?>
		</div>
<?php endif; ?>
