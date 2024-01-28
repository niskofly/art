<?php

$user_type = 0;
$item = [];
//pre($arResult);
\Bitrix\Main\Loader::includeModule('sale');
$ORDER_ID = $arParams["ORDER_ID"];
if (!is_numeric($ORDER_ID)) {
	$t = explode("-", $ORDER_ID);
	$ORDER_ID = $t[1];
}
$order = Bitrix\Sale\Order::load($ORDER_ID);
$order_props = CSaleOrderPropsValue::GetOrderProps($ORDER_ID);
while ($prop = $order_props->fetch()) {
	//pre($prop);
	if ($prop["CODE"] == "NEED_CATALOG") {
		$item["NEED_CATALOG"] = ["NAME" => "Получить каталог", "VALUE" => $prop["VALUE"] == "Y" ? "ДА" : "НЕТ"];
	} elseif ($prop["CODE"] == "ADDRESS") {
		$item["ADDRESS"] = ["NAME" => $prop["PROPERTY_NAME"], "VALUE" => $prop["VALUE"]];
	} elseif ($prop["CODE"] == "PHONE") {
		$item["PHONE"] = ["NAME" => $prop["PROPERTY_NAME"], "VALUE" => $prop["VALUE"]];
	} else {
		$item[$prop["CODE"]] = ["NAME" => $prop["PROPERTY_NAME"], "VALUE" => $prop["VALUE"]];
	}
}
//pre($order->getFieldValues());
$item["ORDER_DATA"] = ["NAME" => "Дата заказа", "VALUE" => $order->getField("DATE_INSERT")->format("d.m.Y")];
$item["USER_DESCRIPTION"] = ["NAME" => "Комментарий", "VALUE" => $order->getField("USER_DESCRIPTION") ?: "-"];
$pay_system_id = $order->getField("PAY_SYSTEM_ID");
if ($pay_system_id) {
	$item["PAY_NAME"] = ["NAME" => "Способ оплаты", "VALUE" => CSalePaySystem::GetByID($pay_system_id)["NAME"]];
}
$deliv_id = $order->getField("DELIVERY_ID");
if ($deliv_id) {
	$item["DELIVERY_NAME"] = ["NAME" => "Способ доставки", "VALUE" => CSaleDelivery::GetByID($deliv_id)["NAME"]];
}
$user_prop = [];
$rsData = CUserTypeEntity::GetList(array($by => $order), array("ENTITY_ID" => "USER", 'LANG' => 'ru'));
while ($arRes = $rsData->Fetch()) {
	$user_prop[$arRes["FIELD_NAME"]] = $arRes;
}
$arUser = [];
foreach ($arResult["ITEMS"] as $it) {
	$arUser[$it["CODE"]] = $it["VALUE"];
};
$name = $arUser["NAME"];
$lastname = $arUser["LAST_NAME"];
$secname = $arUser["SECOND_NAME"];

if ($arUser['EMAIL'] && $arUser['EMAIL'] != '') {
	$email = $arUser["EMAIL"];
}
if ($arUser['UF_PHONE'] && $arUser['UF_PHONE'] != '') {
	$phone = $arUser["UF_PHONE"];
}
$company = $arUser["UF_COMPANY"];
$legad = $arUser["UF_LEGAL_ADDRESS"];
$actad = $arUser["UF_ACTUAL_ADDRESS"];
$kpp = $arUser["UF_KPP"];
$inn = $arUser["UF_INN"];
$conper = $arUser["UF_CONTACT_PERSON"];
$conphone = $arUser["UF_CONTACT_PHONE"];
$fax = $arUser["UF_FAX"];
$file = $arUser["UF_FILE"];
$location = $arUser["UF_DELIVERY_LOCATION"];
$index = $arUser["UF_INDEX"];
$addr = $arUser["UF_DELIVERY_ADDRESS"];
$note = $arUser["UF_NOTE"];
if ($arUser["UF_USER_TYPE"] == 1) {
	$strOrderListPropHtml = $lastname . ' ' . $name . ' ' . $secname;
} elseif ($arUser["UF_USER_TYPE"] == 2) {
	$strOrderListPropHtml = $conper;
} elseif ($lastname != '' || $name != '' || $secname != '') {
	$strOrderListPropHtml = $lastname . ' ' . $name . ' ' . $secname;
} else {
	$strOrderListPropHtml = $email;
}


foreach ($arResult["ITEMS"] as $pr) {
	if ($pr["CODE"] == "ID") {
		$user_id = $pr["VALUE"];
		$pr = [];
		continue;
	} elseif ($pr["CODE"] == "UF_USER_TYPE") {
		$user_type = $pr["VALUE"] ?: 1;
		$pr = [];
		continue;
	} elseif (!$pr["NAME"]) {
		$pr["NAME"] = $user_prop[$pr["CODE"]]["EDIT_FORM_LABEL"];
	}
	if ($pr["CODE"] == "NAME") {
		$name = $pr["VALUE"];
	} elseif ($pr["CODE"] == "ULAST_NAME") {
		$lastname = $pr["VALUE"];
	} elseif ($pr["CODE"] == "SECOND_NAM") {
		$secname = $pr["VALUE"];
	} elseif ($pr["CODE"] == "UF_CONTACT_PERSON") {
		$conper = $pr["VALUE"];
	}
	$item[$pr["CODE"]] = $pr;
};
$arResult["ITEMS"] = [];
if ($user_type == 1) {
	$arResult["ITEMS"]["USER_NAME"] = ["CODE" => "", "NAME" => "Заказчик", "VALUE" => $strOrderListPropHtml];
} elseif ($user_type == 2) {
	$arResult["ITEMS"]["USER_NAME"] = ["CODE" => "", "NAME" => "Контактное лицо", "VALUE" => $strOrderListPropHtml];
} elseif ($lastname != '' || $name != '' || $secname != '') {
	$arResult["ITEMS"]["USER_NAME"] = ["CODE" => "", "NAME" => "Заказчик", "VALUE" => $strOrderListPropHtml];
}
$arResult["ITEMS"] = array_merge($arResult["ITEMS"], $item);
$arResult["USER_TYPE"] = $user_type;




