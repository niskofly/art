<?
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
//$this->setFrameMode(true);
$field_types = [];

$field_types['USER'] = [
	"FIO",
	"USER_NAME",
	"PHONE",
	"CONTACT_PHONE",
	"EMAIL",
	"NEED_CATALOG",
	"PAY_NAME",
	"DELIVERY_NAME",
	"ADDRESS",
	"USER_DESCRIPTION",
];
$field_types['COMPANY'] = [
	"FIO",
	"PHONE",
	"UF_COMPANY",
	"UF_LEGAL_ADDRESS",
	"UF_ACTUAL_ADDRESS",
	"UF_INN",
	"UF_KPP",
	"CONTACT_PHONE",
	"UF_FAX",
	"USER_NAME",
	"UF_CONTACT_PHONE",
	"EMAIL",
	"NEED_CATALOG",
	"PAY_NAME",
	"DELIVERY_NAME",
	"ADDRESS",
	"USER_DESCRIPTION",
];
$fields = $field_types['USER'];
if ($arResult["USER_TYPE"] == 2) {
	$fields = $field_types['COMPANY'];
}

//$order = CSaleOrder::GetByID($arParams['ORDER_ID']);
//
//pre($order['PRICE']);
//pre($order['PRICE']);
//
//
//CModule::IncludeModule('sale');
//$res = CSaleBasket::GetList(array(), array("ORDER_ID" => $ORDER_ID)); // ID заказа
//$json_product=array();
//while ($arItem = $res->Fetch()) {
//// var_dump($arItem);
//
//    $json[] = array(
//        'name' => $arItem['NAME'],
//        'id' => $arItem['PRODUCT_ID'],
//        'price' => $arItem['PRICE'],
//        'quantity' => $arItem['QUANTITY']
//    );
//}
//$order_num = CSaleOrder::GetByID($arParams['ORDER_ID'])['ACCOUNT_NUMBER'];
?>

<div>
	<div style="margin-bottom: 9px;">
		<b>Заказ с сайта:</b> <?= $arParams['SITE'] ?> <br>
	</div>
	<div style="margin-bottom: 9px;">
		<b>Заказ №:</b> <?= $arParams['ORDER_ID'] ?> от <?= $arResult["ITEMS"]["ORDER_DATA"]['VALUE'] ?> <br>
	</div>
</div>

<div style="margin-bottom: 40px;">
	<?php
	foreach ($fields as $code) {
		if (!$arResult["ITEMS"][$code]['VALUE']) {
			continue;
		}
		?>
		<div style="margin-bottom: 10px;">
			<b><?= htmlspecialcharsbx($arResult["ITEMS"][$code]['NAME']) ?>
				:</b> <?= htmlspecialcharsbx($arResult["ITEMS"][$code]['VALUE']) ?>
		</div>
		<?php
	}
	?>
</div>
