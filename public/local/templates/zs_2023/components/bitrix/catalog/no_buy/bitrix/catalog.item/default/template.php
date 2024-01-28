<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('assets/components/tails/tail_product.css');


if (isset($arResult['ITEM'])) {
	$item = $arResult['ITEM'];
	$areaId = $arResult['AREA_ID'];
	$itemIds = [
			'ID' => $areaId,
			'PICT' => $areaId . '_pict',
			'SECOND_PICT' => $areaId . '_secondpict',
			'PICT_SLIDER' => $areaId . '_pict_slider',
			'STICKER_ID' => $areaId . '_sticker',
			'SECOND_STICKER_ID' => $areaId . '_secondsticker',
			'QUANTITY' => $areaId . '_quantity',
			'QUANTITY_DOWN' => $areaId . '_quant_down',
			'QUANTITY_UP' => $areaId . '_quant_up',
			'QUANTITY_MEASURE' => $areaId . '_quant_measure',
			'QUANTITY_LIMIT' => $areaId . '_quant_limit',
			'BUY_LINK' => $areaId . '_buy_link',
			'BASKET_ACTIONS' => $areaId . '_basket_actions',
			'NOT_AVAILABLE_MESS' => $areaId . '_not_avail',
			'SUBSCRIBE_LINK' => $areaId . '_subscribe',
			'COMPARE_LINK' => $areaId . '_compare_link',
			'PRICE' => $areaId . '_price',
			'PRICE_OLD' => $areaId . '_price_old',
			'PRICE_TOTAL' => $areaId . '_price_total',
			'DSC_PERC' => $areaId . '_dsc_perc',
			'SECOND_DSC_PERC' => $areaId . '_second_dsc_perc',
			'PROP_DIV' => $areaId . '_sku_tree',
			'PROP' => $areaId . '_prop_',
			'DISPLAY_PROP_DIV' => $areaId . '_sku_prop',
			'BASKET_PROP_DIV' => $areaId . '_basket_prop',
	];

	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
			? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
			: $item['NAME'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
			? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
			: $item['NAME'];


	$actualItem = $item;


	$morePhoto = null;
	if ($arParams['PRODUCT_DISPLAY_MODE']) {
		$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
		$measureRatio = $price['MIN_QUANTITY'];
		if (isset($actualItem['MORE_PHOTO'])) {
			$morePhoto = $actualItem['MORE_PHOTO'];
		}
	}

	$itemHasDetailUrl = isset($item['DETAIL_PAGE_URL']) && $item['DETAIL_PAGE_URL'] != '';

	$documentRoot = Main\Application::getDocumentRoot();
	$templatePath = mb_strtolower($arResult['TYPE']) . '/template.php';
	$file = new Main\IO\File($documentRoot . $templateFolder . '/' . $templatePath);

	$arPicture = [];
	if (isset($item['PREVIEW_PICTURE']['SRC']) && $item['PREVIEW_PICTURE']['SRC'] != '') {
		$arPicture = $item['PREVIEW_PICTURE'];
	} elseif (isset($item['DETAIL_PICTURE']['SRC']) && $item['DETAIL_PICTURE']['SRC'] != '') {
		$arPicture = $item['DETAIL_PICTURE'];
	}
	if (!empty($arPicture)) {
		$arPictureSmall = CFile::ResizeImageGet(
				$arPicture['ID'],
				[
						'width' => 500,
						'height' => 500
				],
				BX_RESIZE_IMAGE_PROPORTIONAL,
				false,
				[
						[
								"name" => "sharpen",
								"precision" => 0
						]
				],
				false,
				85
		);
	} else {
		$arPictureSmall['src'] = 'Сделать картинку-заглушку'; // TODO Сделать картинку-заглушку
	}
	?>
	<div class="tail-product" id="<?= $areaId ?>">
		<div class="tail_product__image">
			<img src="<?= $arPictureSmall['src'] ?>" alt="<?= $item['NAME'] ?>">
		</div>
		<div class="tail_product__title"><?= $item['NAME'] ?></div>
		<div class="tail_product__preview-text"><?= $item['PREVIEW_TEXT'] ?></div>
		<div class="tail_product__buttons">
			<?php
			// TODO По кнопке кастомная форма
			?>
			<div class="tail_product__order">
				<div class="button">Быстрый заказ</div>
			</div>
			<div class="tail_product__link">
				<a href="<?= $item['DETAIL_PAGE_URL'] ?>">Подробнее</a>
			</div>

		</div>

	</div>


	<?php

	unset($item, $actualItem, $minOffer, $itemIds, $jsParams);
}
