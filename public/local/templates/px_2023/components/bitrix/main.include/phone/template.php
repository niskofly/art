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

$phone_src = file_get_contents($arResult["FILE"]);
$phone_clear = strip_tags($phone_src);
$phone_clear = preg_replace('/[^0-9]/', '', $phone_clear);

$first_num = substr($phone_clear, 0, 1);
if ((int)$first_num === 7 || (int)$first_num === 8) {
	$phone_clear = substr($phone_clear, 1);
}
$phone_clear = '+7' . $phone_clear;

if ($phone_src !== "" || $phone_src !== false) {
	if ($phone_clear !== "" && strlen($phone_clear) === 12) {
		?>
		<span <?= $arParams['SCHEMA_ORG'] === "Y" ? 'itemprop="telephone" content="' . $phone_clear . '"' : ""; ?>>
            <a  href="tel:"
			   class="call_phone_1 <?= !empty($arParams['CALTRACING_CLASS']) ? $arParams['CALTRACING_CLASS'] : ""; ?>">
                <?php
				if ($arParams['SHOW_ICON'] === "Y") {
					?>
					<svg class="icon">
						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#phone"></use>
					</svg>
					<?php
				} ?>
				<?= $phone_src ?>
            </a>
        </span>
		<?php
	} else {
		echo $phone_src;
	}
}




