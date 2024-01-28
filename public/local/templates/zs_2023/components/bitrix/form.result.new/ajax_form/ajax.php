<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");

/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Loader;
use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();


Loader::includeModule("form");
CModule::IncludeModule("iblock");


$return = array();
$FORM_ID = (int)$request->get("WEB_FORM_ID");

$DATA = $request->get("DATA");


if ($FORM_ID <= 0) {
	$return = array(
		'status' => 0,
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
		$yaTargetId = '';
		if ($DATA['YA_TARGET_ID']) {
			$yaTargetId = $DATA['YA_TARGET_ID'];
			unset($DATA['YA_TARGET_ID']);
		}
		if ($RESULT_ID = CFormResult::Add($FORM_ID, $DATA)) {
			$return = array(
				'type' => 'success', // добавляется как класс к контейнеру сообщения
				'message' => 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят!'
			);
			if ($yaTargetId) {
				$return['ya_target'] = $yaTargetId;
			}
			CFormResult::Mail($RESULT_ID);
		} else {
			global $strError;
			$return = array(
				'error' => 1,
				'type' => 'warning', // добавляется как класс к контейнеру сообщения
				'message' => 'При отправке формы произошла ошибка, если вам не трудно - позвоните нам по телефону в шапке и сообщите о проблеме в работе формы. Текст ошибки: ' . $strError
			);
		}
	}
}


echo json_encode($return);

