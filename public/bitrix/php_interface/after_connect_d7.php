<?php

use Bitrix\Main\Application;
use Bitrix\Main\DB\SqlQueryException;

$connection = Application::getConnection();
try {
	$connection->queryExecute("SET sql_mode=''");
} catch (SqlQueryException $e) {
}
try {
	$connection->queryExecute("SET innodb_strict_mode=0");
} catch (SqlQueryException $e) {
}
$connection = Application::getConnection();
try {
    $connection->queryExecute("SET NAMES 'utf8'");
} catch (SqlQueryException $e) {
}
try {
    $connection->queryExecute('SET collation_connection = "utf8_unicode_ci"');
} catch (SqlQueryException $e) {
}

