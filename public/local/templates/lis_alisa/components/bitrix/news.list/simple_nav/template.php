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
	foreach ($arResult['ITEMS'] as $arItem) {
		$fileSrc = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE']);

		?>
		<li class="menu-left__item">
			<a class="menu-left__link" href="<?= $fileSrc ?>" title="<?= $arItem['NAME'] ?>">
				<svg>
					<use xlink:href="/local/templates/zs_2023/sprite.svg#doc"></use>
				</svg>
				<span><?= $arItem['NAME'] ?></span>
			</a>
		</li>
		<?php
	}
	?>
</ul>
