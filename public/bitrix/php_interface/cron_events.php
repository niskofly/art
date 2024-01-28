<?php

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Sender\MailingManager;

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/../..");
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

const NO_KEEP_STATISTIC = true;
const NOT_CHECK_PERMISSIONS = true;
const BX_NO_ACCELERATOR_RESET = true;
const CHK_EVENT = true;
const BX_WITH_ON_AFTER_EPILOG = true;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

@set_time_limit(0);
@ignore_user_abort(true);

CAgent::CheckAgents();
const BX_CRONTAB_SUPPORT = true;
const BX_CRONTAB = true;
CEvent::CheckEvents();

if (CModule::IncludeModule('sender')) {
	try {
		MailingManager::checkPeriod(false);
	} catch (ArgumentException $e) {
	}
	try {
		MailingManager::checkSend();
	} catch (ObjectPropertyException|SystemException $e) {
	}
}

require($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/tools/backup.php");
CMain::FinalActions();
