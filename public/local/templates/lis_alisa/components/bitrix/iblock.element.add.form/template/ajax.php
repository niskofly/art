<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");

use Bitrix\Main;
use Bitrix\Main\Loader;

Loader::includeModule("form");
CModule::IncludeModule("iblock");

$return = array();
$IBLOCK_ID = (int)$_POST["IBLOCK_ID"];

$DATA = $_POST['DATA'];
$arParams = Main\Component\ParameterSigner::unsignParameters("iblock.element.add.form", $_POST["param"]);
$event = $arParams["PROP_EVENT_NAME"];
if (is_array($DATA)) {
	foreach ($DATA as $d) {
		//if( strpos( $d,"https://m-ser.ru") === 0 ) continue; // проверка на наличие внешних ссылок в поле
		//if (preg_match("/<a(.+)href=('|\")(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
		if (preg_match("/(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
			$return = array(
				'status' => 1,
				'type' => 'success', // добавляется как класс к контейнеру сообщения
				'message' => 'Спасибо, что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят 2!'
			);
			//echo json_encode( $return );exit;
		}
	}
}
/**/

// pre($_POST);

if ($IBLOCK_ID <= 0) {
	$return = array(
		'status' => 0,
		'type' => 'warning', // добавляется как класс к контейнеру сообщения
		'message' => 'Неверный ID формы'
	);
} elseif ($IBLOCK_ID) {
	$error = false;
	$prop = $_POST["PROPERTY"];
	if (!$prop["NAME"][0]) {
		$NAME = "элемент " . time();
	} else {
		$NAME = $prop["NAME"][0];
		unset($prop["NAME"]);
	}
	if ($_FILES && $_FILES["PROPERTY"]["tmp_name"]) {
		foreach ($_FILES["PROPERTY"]["tmp_name"] as $id => $path) {
			$prop[$id] = CFile::MakeFileArray($path[0]);
			$prop[$id]["name"] = $_FILES["PROPERTY"]['name'][$id][0];
			$prop[$id]["type"] = $_FILES["PROPERTY"]['type'][$id][0];
		}
	}
	$text = $prop['PREVIEW_TEXT'][0];
	if (!$error) {
		$arLoadProductArray = array(
			'MODIFIED_BY' => 1,
			//$GLOBALS['USER']->GetID(), // элемент изменен текущим пользователем
			'IBLOCK_SECTION_ID' => false,
			// элемент лежит в корне раздела
			'IBLOCK_ID' => $IBLOCK_ID,
			'PROPERTY_VALUES' => $prop,
			'NAME' => $NAME,
			'ACTIVE' => 'N',
			// активен
			'PREVIEW_TEXT' => $text,
			//'DETAIL_TEXT' => 'текст для детального просмотра',
			//'DETAIL_PICTURE' => $_FILES['DETAIL_PICTURE'] // картинка, загружаемая из файлового поля веб-формы с именем DETAIL_PICTURE
		);
		//print_r($arLoadProductArray);exit;
		//ob_start();
		$el = new CIBlockElement();
		$PRODUCT_ID = $el->Add($arLoadProductArray);
		$mess = ob_get_contents();
		ob_end_clean();
		if ($PRODUCT_ID) {
			$return = array(
				'type' => 'success', // добавляется как класс к контейнеру сообщения
				'message' => 'Спасибо, что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят! ' . $mess
			);
			if ($event) {
				$pr_iblock = [];
				$properties = CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"),
					array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"]));
				while ($prop_fields = $properties->GetNext()) {
					$pr_iblock[$prop_fields["ID"]] = $prop_fields;
				}

				$ar_mail = [
					"NAME" => $NAME,
					"PREVIEW_TEXT" => $text
				];
				foreach ($prop as $id => $pr) {
					$value = "";
					if (isset($pr_iblock[$id])) {
						if ($pr_iblock[$id]["PROPERTY_TYPE"] == "L") {
							$property_enums = CIBlockPropertyEnum::GetList(array("DEF" => "DESC", "SORT" => "ASC"),
								array(
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"CODE" => $pr_iblock[$id]["CODE"],
									"ID" => $pr[0]
								))->fetch();
							$value = $property_enums["VALUE"];
						} else {
							$value = $pr[0];
						}
						$ar_mail[$pr_iblock[$id]["CODE"]] = $value;
					}
				}
			}
			CEvent::Send($event, "s1", $ar_mail);
			//print_r([$event,$ar_mail]);
		} else {
			global $strError;
			echo $strError;
			$return = array(
				'type' => 'warning', // добавляется как класс к контейнеру сообщения
				'message' => 'При отправке формы произошла ошибка, если вам не трудно - позвоните нам по телефону в шапке и сообщите о проблеме в работе формы. Текст ошибки: ' . $mess
			);
		}
	}
}

/**/
// pre($data);
// pre($_POST);


echo json_encode($return);

