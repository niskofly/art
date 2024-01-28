<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");

use Bitrix\Main\Component\ParameterSigner;
use
	Bitrix\Main\Loader,
	Bitrix\Main\Mail\Event;

Loader::includeModule("form");
CModule::IncludeModule("iblock");

$return = array();
$FORM_ID = (int)$_POST['WEB_FORM_ID'];
$IBLOCK_ID = (int)$_POST["IBLOCK_ID"];
$send_mail = $_POST["send_mail"];

$DATA = $_POST['DATA'];

if (is_array($DATA) && false) {
	foreach ($DATA as $d) {
		//if( strpos( $d,"https://m-ser.ru") === 0 ) continue; // проверка на наличие внешних ссылок в поле
		//if (preg_match("/<a(.+)href=('|\")(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
		if (preg_match("/(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
			$return = array(
				'status' => 1,
				'type' => 'success', // добавляется как класс к контейнеру сообщения
				//'message' => 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят 2!'
			);
			//echo json_encode( $return );exit;
		}
	}
}
/**/

// pre($_POST);

if ($FORM_ID <= 0 && $IBLOCK_ID <= 0 && !$send_mail) {
	$return = array(
		'error' => 1,
		'type' => 'warning', // добавляется как класс к контейнеру сообщения
		'message' => 'Неверный ID формы'
	);
} elseif ($FORM_ID) {
	$rsForm = CForm::GetByID($FORM_ID);
	$arForm = $rsForm->Fetch();


	if (empty($DATA)) {
		$return = array(
			'error' => 1,
			'type' => 'warning', // добавляется как класс к контейнеру сообщения
			'message' => 'Нет данных дла записи'
		);
	} elseif ($arForm['USE_CAPTCHA'] == "Y" && !$APPLICATION->CaptchaCheckCode(
			strtolower($_POST['captcha_word']),
			$_POST['captcha_sid']
		)) {
		$return = array(
			'error' => 1,
			'type' => 'warning', // добавляется как класс к контейнеру сообщения
			'message' => 'Неверно заполнена капча'
		);
	} else {
		$errors = CForm::Check($FORM_ID, $DATA);
		if (!$errors) {
			if ($RESULT_ID = CFormResult::Add($FORM_ID, $DATA)) {
				$return = array(
					'type' => 'success', // добавляется как класс к контейнеру сообщения
					'message' => 'Спасибо. Заявка принята. Свяжемся с вами в ближайшее рабочее время.'
				);
				CFormResult::Mail($RESULT_ID);
			} else {
				global $strError;
				//echo $strError;
				$return = array(
					'error' => 1,
					'type' => 'warning', // добавляется как класс к контейнеру сообщения
					'message' => 'При отправке формы произошла ошибка, если вам не трудно - позвоните нам по телефону в шапке и сообщите о проблеме в работе формы. Текст ошибки: ' . $strError
				);
			}
		} else {
			$return = array(
				'error' => 1,
				'type' => 'warning', // добавляется как класс к контейнеру сообщения
				'message' => html_entity_decode($errors)
			);
		}
	}
} elseif ($IBLOCK_ID) {
	$error = false;
	$arParams = ParameterSigner::unsignParameters("iblock.element.add.form", $_POST["param"]);
	$prop = $_POST["PROPERTY"];
	if (!$prop["NAME"][0]) {
		$NAME = "отзыв";
	} else {
		$NAME = $prop["NAME"][0];
	}
	/*if($prop[59]!=1){
		$return = array(
			'error' => 1,
			'type' => 'warning', // добавляется как класс к контейнеру сообщения
			'message' => 'Необходимо подтвердить согласие'
		);
		$error = true;

	}*/
	$text = $prop['PREVIEW_TEXT'][0];
	if ($_FILES && $_FILES["PROPERTY"]["tmp_name"]) {
		foreach ($_FILES["PROPERTY"]["tmp_name"] as $id => $path) {
			$prop[$id] = CFile::MakeFileArray($path[0]);
			$prop[$id]["name"] = $_FILES["PROPERTY"]['name'][$id][0];
			$prop[$id]["type"] = $_FILES["PROPERTY"]['type'][$id][0];
		}
	}
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
		//ob_start();
		$el = new CIBlockElement();
		$PRODUCT_ID = $el->Add($arLoadProductArray);
		$mess = ob_get_contents();
		ob_end_clean();
		if ($PRODUCT_ID) {
			$return = array(
				'type' => 'success', // добавляется как класс к контейнеру сообщения
				'message' => $arParams["USER_MESSAGE_ADD"] ?: 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят! ' . $mess
			);
			CFormResult::Mail($RESULT_ID);
		} else {
			global $strError;
			echo $strError;
			$return = array(
				'type' => 'warning', // добавляется как класс к контейнеру сообщения
				'message' => 'При отправке формы произошла ошибка, если вам не трудно - позвоните нам по телефону в шапке и сообщите о проблеме в работе формы. Текст ошибки: ' . $mess
			);
		}
	}
} elseif ($send_mail) {
	$items = [];
	$items = $_POST;
	if ($_FILES) {
		foreach ($_FILES as $id => $file) {
			$files[$id] = $file;
		}
	}
	//print_r($items);
	CEvent::Send("JOB APPLICATION", 's1', $items, "Y", "", $files);
	$return = array(
		'type' => 'success', // добавляется как класс к контейнеру сообщения
		'message' => 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят! ' . $mess
	);
	/*	$mail="franplast@yandex.ru"; // ваша почта
		$subject ="Test" ; // тема письма
		$text= "Line 1\nLine 2\nLine 3"; // текст письма
		mail($mail, $subject, $text);*/
}

/**/
// pre($data);
// pre($_POST);


echo json_encode($return);

