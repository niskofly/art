<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

/*$res = CIBlock::GetProperties(
    $arParams['IBLOCK_ID'],
    Array(),
    Array("CODE"=>"GROUP1_REGISTRATION_NUMBER"));
while($res_arr = $res->Fetch()){
    //pre($res_arr);
}*/
$filter = [];
$prop_name = ['GROUP1_REGISTRATION_NUMBER','GROUP1_FULL_NAME','GROUP1_INN','GROUP1_SRO_MEMBER_STATUS','GROUP2_LEGAL_STATUS'];
$res = CIBlock::GetProperties(
    $arParams['IBLOCK_ID'],
    Array("sort" => "asc")
    //Array("PROPERTY_TYPE"=>"L")
);
while($res_arr = $res->Fetch()){
	if(!in_array($res_arr["CODE"],$prop_name)) continue;
	$filter[$res_arr["CODE"]] = $res_arr;
	if($res_arr["PROPERTY_TYPE"] != "L") continue;
	$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "CODE"=>$res_arr["CODE"]));
	while($enum_fields = $property_enums->GetNext())
	{
		$filter[$res_arr["CODE"]]["ITEMS"][] = $enum_fields;
	}
}
$arResult["FILTER"] = $filter;
unset($filter);



//$arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'];
//$arItem['PROPERTIES'] ['GROUP1_FULL_NAME']['VALUE'];
//$arItem['PROPERTIES']['GROUP1_INN']['VALUE'];
//$arItem['PROPERTIES']['GROUP1_SRO_MEMBER_STATUS']['VALUE'];
//$arItem['PROPERTIES']['GROUP2_LEGAL_STATUS']['VALUE'];
