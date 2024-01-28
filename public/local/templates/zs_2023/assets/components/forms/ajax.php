<?php

include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

/** @var Bitrix\Main\ $APPLICATION */


use Bitrix\Main\Loader,
	Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
Loader::includeModule("iblock");

print_r($_POST);
print_r([
	'$_POST' => $_POST,
	'$_GET' => $_GET,
	'$_REQUEST' => $_REQUEST,
	'$_SERVER' => $_SERVER['REQUEST_METHOD'],
	'formId' => $request->getPost('formId')

]);
exit;

$form_id = (int)$request->getPost('id_form');
$form_title = $request->getPost('form_title') ?: "";
$ya_target_id = $request->getPost("ya_target_id") ?: "";
$template = $request->getPost("TEMPLATE") ?: "ajax_form";



if (!$element_name && $request->getPost('el_id')) {
	$element_id = (int)$request->getPost('el_id');
	$element_name = CIBlockElement::GetByID($element_id)->Fetch()['NAME'];
}
?>
	<div class="ajax_cont_form">
		<?php
		if ($form_id) {
			$params = [
				"COMPONENT_TEMPLATE" => $template,
				"SEF_MODE" => "N",
				"WEB_FORM_ID" => $form_id,
				"LIST_URL" => "",
				"EDIT_URL" => "",
				"SUCCESS_URL" => "/ajax/form_result_new.php",
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "Y",
				"USE_EXTENDED_ERRORS" => "Y",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "3600",
				"SEF_FOLDER" => "/",
				"VARIABLE_ALIASES" => array(),
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_STYLE" => "Y",
			];
			if ($form_title) {
				$params['FORM_TITLE'] = $form_title;
			}
			if ($element_name) {
				$params['ELEMENT_NAME'] = $element_name;
			}
			if ($form_id == 2) {
				$params['FOOTER_TEXT'] = "Заявки обрабатываются по будням с 10 до 18:00.";
			}
			if ($ya_target_id) {
				$params['YA_TARGET_ID'] = $ya_target_id;
			}


			$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				$template,
				$params,
				false
			);
		}
		?>
	</div>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>
