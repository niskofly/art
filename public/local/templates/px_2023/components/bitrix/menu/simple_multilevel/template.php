<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>
<ul class="catalog-menu section-list multilevel-nav multilevel-nav--horizontal" id="catalog-menu">
	<?php
	$previousLevel = 0;
	foreach ($arResult

	as $arItem)
	{
	$class = '';
	if ($arItem["IS_PARENT"]) {
		$class .= ' multilevel-nav__item--parrent';
	}
	if ($arItem["SELECTED"]) {
		$class .= ' multilevel-nav__item--active';
	}

	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
		echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
	}


	?>
	<li class="multilevel-nav__item <?= trim($class) ?>">
		<a class="multilevel-nav__link" href="<?= $arItem["LINK"] ?>">
			<span><?= $arItem["TEXT"] ?></span>
			<?php
			if ($arItem["IS_PARENT"]) {
				?>
				<button type="button" class="multilevel-nav__use">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/icons/arrow-grad.svg" alt="<?= $arItem["TEXT"] ?>">
					<svg class="icon">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/icons/svg-sprite.svg#arrow-stroke"></use>
					</svg>
				</button>
				<?php
			}
			?>
		</a>
		<?php
		if ($arItem["IS_PARENT"]){
		?>
		<ul class="multilevel-nav__sublevel"><?php
			}

			$previousLevel = $arItem["DEPTH_LEVEL"];
			}

			if ($previousLevel > 1)//close last item tags
			{
				echo str_repeat("</ul></li>", ($previousLevel - 1));
			} ?>
		</ul>
