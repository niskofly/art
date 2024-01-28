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

$payment_src = file_get_contents($arResult["FILE"]);


if ($payment_src !== "" || $payment_src !== false) {
	?>
	<div class="site-footer__payment">
		<?= $payment_src ?>
		<ul>
			<?php
			if ($arParams['IMG_1']) {
				?>
				<li><img src="<?= $arParams['IMG_1'] ?>" alt="<?= $arParams['ALT'] ?>"></li>
				<?php
			}
			if ($arParams['IMG_2']) {
				?>
				<li><img src="<?= $arParams['IMG_2'] ?>" alt="<?= $arParams['ALT'] ?>"></li>
				<?php
			}
			if ($arParams['IMG_3']) {
				?>
				<li><img src="<?= $arParams['IMG_3'] ?>" alt="<?= $arParams['ALT'] ?>"></li>
				<?php
			}
			?>
		</ul>
		<?php
		if ($arParams['OTHER_TEXT']) {
			?>
			<span><?= $arParams['OTHER_TEXT'] ?></span>
			<?php
		} ?>
	</div>


	<?php
}






