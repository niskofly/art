<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arTemplateParameters = array(
    "BUTTON_APPLY_TEXT"   => Array(
        "NAME"    => Loc::getMessage('NOTIFICATION_BUTTON_APPLY'),
        "TYPE"    => "STRING",
        "DEFAULT" => Loc::getMessage('NOTIFICATION_BUTTON_APPLY_DEFAULT'),
    ),
    "BUTTON_CLASS"        => array(
        "NAME" => Loc::getMessage('NOTIFICATION_BUTTON_CLASS'),
        "TYPE" => "STRING",
    ),
    "YA_METRIKA"          => array(
        "NAME" => Loc::getMessage('NOTIFICATION_YA_METRIKA'),
        "TYPE" => "STRING",
    ),
    "YA_METRIKA_DEFERRED" => array(
        "NAME"    => Loc::getMessage('NOTIFICATION_YA_METRIKA_DEFERRED'),
        "TYPE"    => "CHECKBOX",
        "DEFAULT" => "Y",
    ),
    "YA_METRIKA_PARAM"    => array(
        "NAME"     => Loc::getMessage('NOTIFICATION_YA_METRIKA_PARAM'),
        "TYPE"     => "STRING",
        "MULTIPLE" => "Y",
    ),
    'AREA_FILE_SHOW'      => [
        "HIDDEN"  => 'Y',
        "DEFAULT" => "file",
    ],
    'PATH'                => [
        "HIDDEN"  => 'Y',
        "DEFAULT" => SITE_TEMPLATE_PATH."/assets/include_areas/notification.php",
    ],
);