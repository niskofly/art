<?php

/** @global \CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('NOT_CHECK_PERMISSIONS', true);

$siteId = isset($_REQUEST['siteId']) && is_string($_REQUEST['siteId']) ? $_REQUEST['siteId'] : '';
$siteId = mb_substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (!empty($siteId) && is_string($siteId)) {
	define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

if (!\Bitrix\Main\Loader::includeModule('iblock')) {
	return;
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
try {
	$template = $signer->unsign($request->get('template') ?: '', 'news.list') ?: '.default';
	$paramString = $signer->unsign($request->get('parameters') ?: '', 'news.list');
} catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
	die();
}
$parameters = unserialize(base64_decode($paramString), ['allowed_classes' => false]);

$filter = $request->get("filter");
$filter_input = $request->get("filter_i");
$f_name = $parameters["FILTER_NAME"];
if (!$f_name) {
	$f_name = "FILTER";
}


$parameters["FILTER_NAME"] = $f_name;
if ($filter) {
	foreach ($filter as $name => $value) {
		$n = "PROPERTY_" . $name;
		$GLOBALS[$f_name][$n] = $value;
	}
}
if ($filter_input) {
	foreach ($filter_input as $name => $value) {
		$n = "PROPERTY_" . $name;
		$GLOBALS[$f_name][$n] = "%" . $value . "%";
	}
}
if (isset($parameters['PARENT_NAME'])) {
	$parent = new CBitrixComponent();
	$parent->InitComponent($parameters['PARENT_NAME'], $parameters['PARENT_TEMPLATE_NAME']);
	$parent->InitComponentTemplate($parameters['PARENT_TEMPLATE_PAGE']);
} else {
	$parent = false;
}

$APPLICATION->IncludeComponent(
	'bitrix:news.list',
	$template,
	$parameters,
	$parent
);
