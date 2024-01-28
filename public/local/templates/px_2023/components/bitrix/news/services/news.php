<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;

if ($APPLICATION->GetCurPage() == '/uslugi/')
  require_once(__DIR__ . '/news_uslugi.php');
else
  require_once(__DIR__ . '/news_other.php');
?>&nbsp;