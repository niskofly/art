<?php

$arIDs = array();
$arPath = array();
$quantity = 0;

foreach ($arResult["CATEGORIES"] as $category => $items) {
	if (empty($items)) {
		continue;
	}
	foreach ($items as $key => $item) {
		$quantity += $item['QUANTITY'];
		$arIDs[] = $item['PRODUCT_ID'];
		$arPath[$item['PRODUCT_ID']] = array(
			'CATEGORY' => $category,
			'KEY' => $key
		);
	}
}
$arResult['TOTAL_QUANTITY'] = $quantity;


$arSelect = array('ID', 'IBLOCK_ID', 'PROPERTY_ARTICLE');
$res = CIBlockElement::GetList(array(), array('ID' => $arIDs), false, false, $arSelect);

while ($ob = $res->Fetch()) {
	$arResult["CATEGORIES"][$arPath[$ob['ID']]['CATEGORY']][$arPath[$ob['ID']]['KEY']]['PROPERTIES']['ARTICLE'] =
		array(
			'NAME' => 'Арт.',
			'VALUE' => $ob['PROPERTY_ARTICLE_VALUE'],
		);
}

