<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 * */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock;

if (!Loader::includeModule("iblock")) {
	throw new \Exception('Не загружены модули необходимые для работы компонента');
}

// типы инфоблоков
$arIBlockType = CIBlockParameters::GetIBlockTypes();
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);
if ($iblockExists) {
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array(
			'ID',
			'IBLOCK_ID',
			'NAME',
			'CODE',
			'PROPERTY_TYPE',
			'MULTIPLE',
			'LINK_IBLOCK_ID',
			'USER_TYPE',
			'SORT'
		),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch()) {
		$propertyCode = (string)$property['CODE'];

		if ($propertyCode === '') {
			$propertyCode = $property['ID'];
		}

		$propertyName = '[' . $propertyCode . '] ' . $property['NAME'];

		if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE) {
			$arProperty[$propertyCode] = $propertyName;
		}
	}
	unset($propertyCode, $propertyName, $property, $propertyIterator);
}
// инфоблоки выбранного типа
$arIBlock = [];
$iblockFilter = !empty($arCurrentValues['IBLOCK_TYPE'])
	? ['TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y']
	: ['ACTIVE' => 'Y'];

$rsIBlock = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilter);
while ($arr = $rsIBlock->Fetch()) {
	$arIBlock[$arr['ID']] = '[' . $arr['ID'] . '] ' . $arr['NAME'];
}
unset($arr, $rsIBlock, $iblockFilter);
$arSorts = array("ASC" => GetMessage("OWL_IBLOCK_DESC_ASC"), "DESC" => GetMessage("OWL_IBLOCK_DESC_DESC"));
$arSortFields = array(
	"ID" => GetMessage("OWL_IBLOCK_DESC_FID"),
	"NAME" => GetMessage("OWL_IBLOCK_DESC_FNAME"),
	"ACTIVE_FROM" => GetMessage("OWL_IBLOCK_DESC_FACT"),
	"SORT" => GetMessage("OWL_IBLOCK_DESC_FSORT"),
	"TIMESTAMP_X" => GetMessage("OWL_IBLOCK_DESC_FTSAMP")
);

// Группы
$arComponentParameters = [
	"GROUPS" => [
		"SETTINGS" => [
			"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_SETTINGS"),
			"SORT" => 100,
		],
		"SORT_SETTINGS" => [
			"NAME" => Loc::getMessage("OWL_COMPSIMPLE_SORT_SETTINGS"),
			"SORT" => 200,
		],
		"ADDITIONAL_SETTINGS" => [
			"NAME" => Loc::getMessage("OWL_COMPSIMPLE_ADDITIONAL_SETTINGS"),
			"SORT" => 300,
		],
		"VISUAL" => [
			"NAME" => "Внешний вид",
			"SORT" => 600,
		],
		"PARAMS_CONTAINER" => [
			"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_PARAMS"),
			"SORT" => 700,
		],
		"OWL_PARAMS_DEFAULT" => [
			"NAME" => Loc::getMessage('GROUP_OWL_DEFAULT'),
			"SORT" => 701,
		],
	]
];
// Параметры
$component_params = [
	"IBLOCK_TYPE" => [
		"PARENT" => "SETTINGS",
		"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_IBLOCK_TYPE"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlockType,
		"REFRESH" => "Y"
	],
	"IBLOCK_ID" => [
		"PARENT" => "SETTINGS",
		"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_IBLOCK_ID"),
		"TYPE" => "LIST",
		"ADDITIONAL_VALUES" => "Y",
		"VALUES" => $arIBlock,
		"REFRESH" => "Y"
	],
	"SORT_BY1" => array(
		"PARENT" => "SORT_SETTINGS",
		"NAME" => GetMessage("OWL_IBLOCK_DESC_IBORD1"),
		"TYPE" => "LIST",
		"DEFAULT" => "ACTIVE_FROM",
		"VALUES" => $arSortFields,
		"ADDITIONAL_VALUES" => "Y",
	),
	"SORT_ORDER1" => array(
		"PARENT" => "SORT_SETTINGS",
		"NAME" => GetMessage("OWL_IBLOCK_DESC_IBBY1"),
		"TYPE" => "LIST",
		"DEFAULT" => "DESC",
		"VALUES" => $arSorts,
		"ADDITIONAL_VALUES" => "Y",
	),
	"SORT_BY2" => array(
		"PARENT" => "SORT_SETTINGS",
		"NAME" => GetMessage("OWL_IBLOCK_DESC_IBORD2"),
		"TYPE" => "LIST",
		"DEFAULT" => "SORT",
		"VALUES" => $arSortFields,
		"ADDITIONAL_VALUES" => "Y",
	),
	"SORT_ORDER2" => array(
		"PARENT" => "SORT_SETTINGS",
		"NAME" => GetMessage("OWL_IBLOCK_DESC_IBBY2"),
		"TYPE" => "LIST",
		"DEFAULT" => "ASC",
		"VALUES" => $arSorts,
		"ADDITIONAL_VALUES" => "Y",
	),
	"FIELD_CODE" => CIBlockParameters::GetFieldCode(GetMessage("OWL_IBLOCK_FIELD"), "DATA_SOURCE"),
	'PROPERTY_CODE' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage("OWL_IBLOCK_PROPERTY"),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arProperty,
		'ADDITIONAL_VALUES' => 'Y',
	),
	'SHOW_PLACEHOLDER' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage("OWL_SHOW_PLACEHOLDER"),
		'TYPE' => 'CHECKBOX',
	),
	"PARENT_SECTION" => array(
		"PARENT" => "ADDITIONAL_SETTINGS",
		"NAME" => GetMessage("OWL_IBLOCK_SECTION_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => '',
	),
	"OWL_COUNT" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("OWL_IBLOCK_DESC_LIST_CONT"),
		"TYPE" => "STRING",
		"DEFAULT" => "5",
	),
	"FILTER_NAME" => array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => GetMessage("OWL_IBLOCK_FILTER"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"PATH_JQUERY" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("OWL_PATH_JQUERY"),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'js',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
	),
	"PATH_OWL_LIB_JS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("OWL_PATH_OWL_LIB_JS"),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'js',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
	),
	"PATH_OWL_LIB_CSS" => array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("OWL_PATH_OWL_LIB_CSS"),
		"TYPE" => "FILE",
		"FD_TARGET" => "F",
		"FD_EXT" => 'css',
		"FD_UPLOAD" => true,
		"FD_USE_MEDIALIB" => true,
	),
	"ACTIVE_DATE_FORMAT" => CIBlockParameters::GetDateFormat(
		GetMessage("OWL_IBLOCK_DESC_ACTIVE_DATE_FORMAT"),
		"ADDITIONAL_SETTINGS"
	),
	"DETAIL_URL" => CIBlockParameters::GetPathTemplateParam(
		"DETAIL",
		"DETAIL_URL",
		GetMessage("OWL_IBLOCK_DESC_DETAIL_PAGE_URL"),
		"",
		"URL_TEMPLATES"
	),

	// Настройки кэширования
	'CACHE_TIME' => ['DEFAULT' => 3600],
];
$item_default_params = [];
$container_params = [
	"PROP_WIDTH" => [
		"PARENT" => "PARAMS_CONTAINER",
		"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_WIDTH"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "100%",
		"COLS" => 25
	],
	"PROP_HEIGHT" => [
		"PARENT" => "PARAMS_CONTAINER",
		"NAME" => Loc::getMessage("OWL_COMPSIMPLE_PROP_HEIGHT"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "",
		"COLS" => 25
	],
];
$owl_params_default = [
	"items" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('items'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "4"
	],
	"dots" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('dots'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"nav" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('nav'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"loop" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('loop'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"lazyLoad" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('lazyLoad'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"autoplay" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('autoplay'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"autoplayHoverPause" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('autoplayHoverPause'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"autoplayTimeout" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('autoplayTimeout'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		'DEFAULT' => 7000,
	],
	"autoplaySpeed" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('autoplaySpeed'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		'DEFAULT' => 3000,
	],
	"smartSpeed" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('smartSpeed'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		'DEFAULT' => 1500,
	],
	"autoWidth" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('autoWidth'),
		'TYPE' => 'LIST',
		'VALUES' => [
			'UNSET' => Loc::getMessage('UNSET'),
			'Y' => Loc::getMessage('ON'),
			'N' => Loc::getMessage('OFF'),
		],
		'DEFAULT' => 'UNSET',
	],
	"margin" => [
		"PARENT" => "OWL_PARAMS_DEFAULT",
		"NAME" => Loc::getMessage('margin'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		'DEFAULT' => '',
	]
];
$owl_breakpoint_counter = [
	"BREAKPOINT_COUNT" => [
		"PARENT" => "PARAMS_CONTAINER",
		"NAME" => Loc::getMessage('BREAKPOINT_COUNT'),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"REFRESH" => "Y"
	],
];

$arComponentParameters['PARAMETERS'] = array_merge(
	$component_params
	,
	$container_params
	,
	$item_default_params
	,
	$owl_params_default
	,
	$owl_breakpoint_counter
);

if ( isset($arCurrentValues["BREAKPOINT_COUNT"]) && $arCurrentValues["BREAKPOINT_COUNT"]) {
	for ($i = 1; $i <= $arCurrentValues["BREAKPOINT_COUNT"]; ++$i) {
		$breakpoint_parent = Loc::getMessage("OWL_BREAKPOINT_TITLE", ['#NUM#' => $i]);

		$arComponentParameters["GROUPS"][$breakpoint_parent] = [
			"NAME" => $breakpoint_parent,
			"SORT" => 710 + $i,
		];
		$tmp_breakpoint = [
			'resolution_' . $i => [
				"PARENT" => $breakpoint_parent,
				"NAME" => Loc::getMessage('resolution'),
				"TYPE" => "STRING",
				"MULTIPLE" => "N",
			]
		];

		foreach ($owl_params_default as $code => $arFields) {
			$code = $code . "_" . $i;
			$tmp_breakpoint[$code] = $arFields;
			$tmp_breakpoint[$code]['PARENT'] = $breakpoint_parent;
		}

		$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], $tmp_breakpoint);
	}
}
