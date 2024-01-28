<?php

const BX_DISABLE_INDEX_PAGE = true;
const BX_UTF = true;
mb_internal_encoding("UTF-8");

$tmpDir = "/var/www/bx59216/data/www/new.artistom.ru/tmp";
if(is_dir($tmpDir)) {
	define("BX_TEMPORARY_FILES_DIRECTORY", $tmpDir);
}

$logFileDir = $_SERVER["DOCUMENT_ROOT"] . "/local/logs";
if(!is_dir($logFileDir)) {
	mkdir($logFileDir, 0755);
}
define("LOG_FILEN2AME", $logFileDir . "/bx_log.txt");


/* Все агенты на крон

    Убедись что есть файл
    /public/bitrix/php_interface/cron_events.php

    В консоли php
        COption::SetOptionString("main", "agents_use_crontab", "N");
        echo COption::GetOptionString("main", "agents_use_crontab", "N");
        COption::SetOptionString("main", "check_agents", "N");
        echo COption::GetOptionString("main", "check_agents", "Y");
        COption::SetOptionString("main", "mail_event_bulk", "20");
        echo COption::GetOptionString("main", "mail_event_bulk", "5");

    В задания крон на ежеминутное выполнение.
    пример с рег-ру:
        /opt/php/7.4-bx-optimized/bin/php -f /var/www/u1568541/data/www/luxmarket.su/public/bitrix/php_interface/cron_events.php
    пример с reddock:
        /bin/sh -c 'cd /var/www/bx63159/data/www/gkmitsubishi.ru/public && /opt/php74/bin/php -f bitrix/php_interface/cron_events.php'

    Раскомментируй это:
        if (!(defined("CHK_EVENT") && CHK_EVENT === true)) {
        define("BX_CRONTAB_SUPPORT", true);
        }
 */


const BX_USE_MYSQLI = true;
const DBPersistent = false;
$DBType = "mysql";

$DBHost = "localhost";
$DBLogin = "bx59216_new-artistom";
$DBPassword = "nS3yN8gZ6w";
$DBName = "bx59216_new-artistom";

$DBDebug = false;
$DBDebugToFile = false;

const DELAY_DB_CONNECT = true;
const CACHED_b_file = 3600;
const CACHED_b_file_bucket_size = 10;
const CACHED_b_lang = 3600;
const CACHED_b_option = 3600;
const CACHED_b_lang_domain = 3600;
const CACHED_b_site_template = 3600;
const CACHED_b_event = 3600;
const CACHED_b_agent = 3660;
const CACHED_menu = 3600;

const BX_FILE_PERMISSIONS = 0644;
const BX_DIR_PERMISSIONS = 0755;
@umask(~(BX_FILE_PERMISSIONS | BX_DIR_PERMISSIONS) & 0777);
