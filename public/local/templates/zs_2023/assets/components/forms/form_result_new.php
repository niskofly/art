<?php

include_once($_SERVER["DOCUMENT_ROOT"]
    . "/bitrix/modules/main/include/prolog_before.php");
include_once($_SERVER["DOCUMENT_ROOT"]
    . "/bitrix/modules/main/classes/general/captcha.php");

use Bitrix\Main\Loader;

Loader::includeModule("form");

$return = array();
$FORM_ID = (int)$_POST['WEB_FORM_ID'];
$DATA = $_POST['DATA'];

if (is_array($DATA) && false) {
    foreach ($DATA as $d) {
        //if( strpos( $d,"https://m-ser.ru") === 0 ) continue; // проверка на наличие внешних ссылок в поле
        //if (preg_match("/<a(.+)href=('|\")(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
        if (preg_match("/(http:\/\/|https:\/\/)/", html_entity_decode($d))) {
            $return = array(
                'status'  => 1,
                'type'    => 'success',
                // добавляется как класс к контейнеру сообщения
                'message' => 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят 2!'
            );
            echo json_encode($return);
            exit;
        }
    }
}
/**/

// pre($_POST);

if ($FORM_ID <= 0) {
    $return = array(
        'error'   => 1,
        'type'    => 'warning', // добавляется как класс к контейнеру сообщения
        'message' => 'Неверный ID формы'
    );
} else {
    $rsForm = CForm::GetByID($FORM_ID);
    $arForm = $rsForm->Fetch();
    
    
    if (empty($DATA)) {
        $return = array(
            'error'   => 1,
            'type'    => 'warning',
            // добавляется как класс к контейнеру сообщения
            'message' => 'Нет данных дла записи'
        );
    } elseif ($arForm['USE_CAPTCHA'] == "Y"
        && !$APPLICATION->CaptchaCheckCode(
            strtolower($_POST['captcha_word']),
            $_POST['captcha_sid']
        )
    ) {
        $return = array(
            'error'   => 1,
            'type'    => 'warning',
            // добавляется как класс к контейнеру сообщения
            'message' => 'Неверно заполнена капча'
        );
    } else {
        if ($RESULT_ID = CFormResult::Add($FORM_ID, $DATA)) {
            $return = array(
                'type'    => 'success',
                // добавляется как класс к контейнеру сообщения
                'message' => 'Спасибо что выбрали нас! Ваш запрос передан администратору, скоро вам позвонят!'
            );
            CFormResult::Mail($RESULT_ID);
        } else {
            global $strError;
            echo $strError;
            $return = array(
                'error'   => 1,
                'type'    => 'warning',
                // добавляется как класс к контейнеру сообщения
                'message' => 'При отправке формы произошла ошибка, если вам не трудно - позвоните нам по телефону в шапке и сообщите о проблеме в работе формы. Текст ошибки: '
                    . $strError
            );
        }
    }
}
/**/
// pre($data);
// pre($_POST);


echo json_encode($return);

