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

$rating_src = file_get_contents($arResult["FILE"]);


if ($rating_src !== "" || $rating_src !== false) {
	?>

			<?php
			if ($arParams['SHOW_ICON'] === "Y") {
				?>
				<span class="icon-star"></span>
				<?php
			} ?>
			<?= $rating_src ?>

	<?php
}






