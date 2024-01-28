<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>

<ul class="sidebar-menu" id="catalog-menu">
	<?php
	$previousLevel = 0;
	foreach ($arResult

	as $arItem)
	{
	$class = '';
	if ($arItem["IS_PARENT"]) {
		$class .= ' sidebar-menu__item--parrent';
	}
	if ($arItem["SELECTED"]) {
		$class .= ' sidebar-menu__item--active';
	}

	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
		echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
	}
	?>
	<li class="sidebar-menu__item <?= trim($class) ?>">
		<a class="sidebar-menu__link" href="<?= $arItem["LINK"] ?>">
			<span><?= $arItem["TEXT"] ?></span>
			<?php
			if ($arItem["IS_PARENT"]) {
				?>
				<button type="button" class="sidebar-menu__use">
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
		<ul class="sidebar-menu__sublevel"><?php
			}

			$previousLevel = $arItem["DEPTH_LEVEL"];
			}

			if ($previousLevel > 1)//close last item tags
			{
				echo str_repeat("</ul></li>", ($previousLevel - 1));
			} ?>
		</ul>
