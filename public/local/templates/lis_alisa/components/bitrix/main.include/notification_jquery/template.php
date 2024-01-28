<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Localization\Loc;

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

$this->addExternalJs('/local/vendors/yandex/cookie.js');
$file_content = file_get_contents($arResult["FILE"]);
if ($file_content) {
	?>
	<div class="cookie-notification" data-ya="<?= $arParams['YA_METRIKA'] ?>">
		<div class="cookie-notification__text">
			<?= $file_content ?>
		</div>
		<div class="cookie-notification__button">
			<span class="<?= $arParams['BUTTON_CLASS'] ?>" id="apply"><?= $arParams['BUTTON_APPLY_TEXT'] ?></span>
		</div>
	</div>
	<?php
}
?>
