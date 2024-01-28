<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

if (empty($_SERVER["REDIRECT_URL"])) // FOR NGINX
{
	$_SERVER["REDIRECT_URL"] = $_SERVER['DOCUMENT_URI'];
}

foreach ($arResult as $key => $arCategory) {
	foreach ($arCategory as $k => $arLink) {
		if ($_SERVER["REDIRECT_URL"] == $arLink["NEW_URL"]) {
			$arResult[$key][$k]["ACTIVE"] = "Y";
		}
	}
}
?>
