<?php

/** @var object $DB */

$DB->Query("SET sql_mode=''");
$DB->Query("SET NAMES 'utf8'");
$DB->Query('SET collation_connection = "utf8_unicode_ci"');
$DB->Query("SET innodb_strict_mode=0");
//$DB->Query("SET wait_timeout=28800");