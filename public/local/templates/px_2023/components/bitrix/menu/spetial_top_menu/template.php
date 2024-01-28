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

$this->addExternalCss('/local/vendor/priority-navigation-master/dist/priority-nav-core.css');
$this->addExternalJs('/local/vendor/priority-navigation-master/dist/priority-nav.js');

?>
<div class="special-top-menu">
	<ul class="special-top-menu__list">
		<?php
		$previousLevel = 0;
		foreach ($arResult

		as $arItem)
		{
		$class = '';
		if ($arItem["IS_PARENT"]) {
			$class .= ' special-top-menu__item--parent';
		}
		if ($arItem["SELECTED"]) {
			$class .= ' special-top-menu__item--active';
		}
		if ($arItem['PARAMS']['POPUP']) {
			$link = "javascript:";
			//$class .= " popup_text_key_js";
			$data = "data-menu='" . $arItem['PARAMS']['ID_CONT'] . "'";
			//$link = $arItem['LINK'];
		} else {
			$link = $arItem['LINK'];
			$data = "";
		}

		if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
			echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		}
		?>
		<li class="special-top-menu__item <?= trim($class) ?>">
			<a class="special-top-menu__link <?= !empty($arItem['SELECTED']) ? "header__nav-link--active" : "" ?> <?= $arItem['PARAMS']['ICON'] ? $arItem['PARAMS']['ICON'] . ' icon' : '' ?>"
			   href="<?= $link ?>">
				<?php
				if ($arItem['PARAMS']['ICON']) {
					?>
					<svg class="icon">
						<use
								xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/images/sprite.svg#<?= $arItem['PARAMS']['ICON'] ?>"></use>
					</svg>
					<?php
				}
				?>
				<?= $arItem["TEXT"] ?>
			</a>
			<?php
			if ($arItem["IS_PARENT"]){
			?>
			<ul class="special-top-menu__sub-level"><?php
				}

				$previousLevel = $arItem["DEPTH_LEVEL"];
				}

				if ($previousLevel > 1)//close last item tags
				{
					echo str_repeat("</ul></li>", ($previousLevel - 1));
				} ?>
			</ul>

</div>
