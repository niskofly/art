<?php

$IBLOCK_ID_catalog = 1;
foreach ($arResult as $key => $arItem) {
	$ar_path = explode('/', $arItem['ADDITIONAL_LINKS'][0]);
	if ((int)$arItem["DEPTH_LEVEL"] === 1) {
		$ar_codes[$key] = $ar_path[2];
	}
}

$res_sections = CIBlockSection::GetList([],
	['CODE' => $ar_codes, 'IBLOCK_ID' => $IBLOCK_ID_catalog],
	false,
	['ID', 'IBLOCK_ID', 'UF_ICON', 'CODE'],
	false
);
while ($ob_sections = $res_sections->Fetch()) {
	if ($ob_sections['UF_ICON']) {
		$arResult[array_search($ob_sections['CODE'], $ar_codes)]['PARAMS']['ICON_CLASS'] = $ob_sections['UF_ICON'];
	}
}
