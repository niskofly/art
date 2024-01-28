<?php

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

// INFO Акции
$iblockPromo = 9;

$arPromo = [];
$arFilterPromo = [
	"IBLOCK_ID" => $iblockPromo,
	"ACTIVE_DATE" => "Y",
	"ACTIVE" => "Y",
	'PROPERTY_LINK_SERVICES' => $arResult['ID']
];

$resPromo = CIBlockElement::GetList(
	["SORT" => "DESC"],
	$arFilterPromo,
	false, false,
	["IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL"]
);

while ($obPromo = $resPromo->GetNext()) {
	$arPromo[] = $obPromo;
}

$arResult['MOD']['PROMO'] = $arPromo;

// INFO КОНЕЦ Акции


//INFO ВРАЧИ

$iblockDoctors = 4;

$arDoctors = [];


$arFilterDoctors = [
	"IBLOCK_ID" => $iblockDoctors,
	"ACTIVE_DATE" => "Y",
	"ACTIVE" => "Y",
];

$resDoctors = CIBlockElement::GetList(
	["SORT" => "DESC"],
	$arFilterDoctors,
	false, false,
	["IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL,"]
);

while ($obDoctors = $resDoctors->GetNext()) {
	$arDoctors[] = $obDoctors;
}

$arResult['MOD']['DOCTORS'] = $arDoctors;

// INFO КОНЕЦ ВРАЧИ



//INFO ОБОРУДОВАНИЯ

$iblockEquipment = 10;

$arEquipment = [];


$arFilterEquipment = [
	"IBLOCK_ID" => $iblockEquipment,
	"ACTIVE_DATE" => "Y",
	"ACTIVE" => "Y",
];

$resEquipment = CIBlockElement::GetList(
	["SORT" => "DESC"],
	$arFilterEquipment,
	false, false,
	["IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL,"]
);

while ($obEquipment = $resEquipment->GetNext()) {
	$arEquipment[] = $obEquipment;
}

$arResult['MOD']['EQUIPMENT'] = $arEquipment;

// INFO КОНЕЦ ОБОРУДОВАНИЯ
