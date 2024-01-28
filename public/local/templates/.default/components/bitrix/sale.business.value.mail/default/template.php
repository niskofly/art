<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
//$this->setFrameMode(true);
pre($arResult);
$company = [
	"ORDER_DATA",
	"FIO",
	"PHONE",
	"UF_COMPANY",
	"UF_LEGAL_ADDRESS",
	"UF_ACTUAL_ADDRESS",
	"UF_INN",
	"UF_KPP",
	"CONTACT_PHONE",
	"UF_FAX",
	"USER_NAME",
	"UF_CONTACT_PHONE",
	"EMAIL",
	"NEED_CATALOG",
	"USER_DESCRIPTION",
	"PAY_NAME",
	"DELIVERY_NAME",
	"ADDRESS"
];
$user = [
	"ORDER_DATA",
	"FIO",
	"USER_NAME",
	"PHONE",
	"CONTACT_PHONE",
	"EMAIL",
	"NEED_CATALOG",
	"USER_DESCRIPTION",
	"PAY_NAME",
	"DELIVERY_NAME",
	"ADDRESS"
];
?>
<p style="margin-top:30px; margin-bottom: 20px; font-size: 13px; font-width: normal;">
	Уважаемый <?= $arResult["ITEMS"]["FIO"]["VALUE"] ?: $arResult["ITEMS"]["USER_NAME"]["VALUE"] ?>!
</p>
<p style="margin-top: 0; line-height: 20px;font-size: 13px; font-width: normal;">
	Ваш заказ номер <?= $arParams["ORDER_ID"] ?> от <?= $arResult["ITEMS"]["ORDER_DATA"]['VALUE'] ?> принят.<br>
	<br>
	Подробная информация о заказе
</p>
<table style="font-size: 13px; font-width: normal;" cellspacing="0" cellpadding="0">
	<?
	if ($arResult["USER_TYPE"] == 2) {
		foreach ($company as $code) {
			if (!$arResult["ITEMS"][$code]['VALUE']) {
				continue;
			}
			?>
			<tr>
				<td style="padding: 4px 7px 0px 0"><?= htmlspecialcharsbx($arResult["ITEMS"][$code]['NAME']) ?></td>
				<td style="padding: 4px 0 0"><?= htmlspecialcharsbx($arResult["ITEMS"][$code]['VALUE']) ?></td>
			</tr>
		<?
		}
	} else {
		foreach ($user as $code) {
			if (!$arResult["ITEMS"][$code]['VALUE']) {
				continue;
			}
			?>
			<tr>
				<td style="padding: 4px 7px 0px 0"><?= htmlspecialcharsbx($arResult["ITEMS"][$code]['NAME']) ?></td>
				<td style="padding: 4px 0 0"><?= htmlspecialcharsbx($arResult["ITEMS"][$code]['VALUE']) ?></td>
			</tr>
		<?
		}
	} ?>
</table>
