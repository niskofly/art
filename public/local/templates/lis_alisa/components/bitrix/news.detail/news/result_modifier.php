<?php


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


if ($arParams["DETAIL_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) {
	$detailPicture = CFile::ResizeImageGet(
		$arResult["DETAIL_PICTURE"]['ID'],
		array(
			'width' => 150,
			'height' => 150
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true,
		array(
			"name" => "sharpen",
			"precision" => 0
		),
		false,
		85
	);
	if (isset($detailPicture['src'])) {
		$arResult["DETAIL_PICTURE"]['SRC'] = $detailPicture['src'];
		$arResult["DETAIL_PICTURE"]['WIDTH'] = $detailPicture['width'];
		$arResult["DETAIL_PICTURE"]['HEIGHT'] = $detailPicture['height'];
	}
}

