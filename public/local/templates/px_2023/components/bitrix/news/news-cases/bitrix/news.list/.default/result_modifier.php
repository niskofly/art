<?php


$arFilter = array("IBLOCK_ID" => 24); //тут указываем ID Вашего инфоблка

$db_list = CIBlockSection::GetList(array("NAME" => "ASC"), $arFilter, false);

while ($arr = $db_list->GetNext()) {
	$arResult["SECTIONS"][$arr["ID"]]["NAME"] = $arr["NAME"];
}

