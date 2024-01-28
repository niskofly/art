<?php
/** Убрать технические дубли капсом */

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
$requestUri = $request->getRequestUri();
$requestUriArray = explode('?', $requestUri);
$url = $requestUriArray[0];
$new_url = ToLower($url);

$excludedArray = [
	'/bitrix/',
	'/local/',
	'/upload/',
	'/ajax/'
];

$redirect = true;
foreach ($excludedArray as $excluded) {
	if ($url != $new_url) {
		if(strpos($new_url, $excluded) !== false) {
			$redirect = false;
		}
	}
	else {
		$redirect = false;
	}
}

if($redirect)
{
	header("HTTP/1.1 301 Moved Permanently");
	header('Location: https://' . SITE_SERVER_NAME . $new_url);
	exit;
}


