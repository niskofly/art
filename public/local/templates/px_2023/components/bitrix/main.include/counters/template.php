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

global $USER;

if ($USER->isAdmin()) {
	$message = '<b>' . $arParams['MESSAGE'] . '</b><br>';
	$message .= 'для редактирования включите режим правки';
	if ($arParams['OFF_FOR_ADMIN'] === 'Y') {
		$message .= '<br><br>Счётчики выключены для админов в настройках компонента';
	}
	?>
	<div style="font-weight: bold; color: red;"><?= $message ?></div>
	<?php
}

if (($USER->isAdmin() && $arParams['OFF_FOR_ADMIN'] == 'Y') && $arResult["FILE"] <> '') {
	include($arResult["FILE"]);
}

