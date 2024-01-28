<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @var string $componentPath
 * @var string $componentName
 */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$feldliste = [
	"EMAIL" => "EMAIL",
	"PHONE" => "Телефон",
	"ADDRESS" => "Адресс",
	"DELIVERY_NAME" => "Доставка",
	"DELIVERY_PRICE" => "Стоимость доставки",
	"PAY_NAME" => "Оплата",
	"USER_DESCRIPTION" => "Комментрий к заказу",
	"PRICE" => "Стоимость заказа",
];
$arTemplateParameters['FELDLISTE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => "Список полей",
	'TYPE' => 'LIST',
	'VALUES' => $feldliste,
	'DEFAULT' => '',
	'ADDITIONAL_VALUES' => 'Y',
	'MULTIPLE' => 'Y',
);
