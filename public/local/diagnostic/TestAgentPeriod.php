<?php

function TestAgentPeriod()
{
	$arTrace = debug_backtrace();
	$debug_backtrace = "";
	foreach ($arTrace as $keyTrace => $valueTrace) {
		//$debug_backtrace .= $valueTrace["class"]."::".$valueTrace["function"]." ";
		$debug_backtrace .= $valueTrace["file"] . ":" . $valueTrace["line"] . "\n";
	}
	$f = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/wlog.txt', 'ab');
	fwrite(
		$f,
		print_r(array(
			"debug_backtrace" => $debug_backtrace,
		), 1) . "\n==\n"
	);
	fclose($f);


	return "TestAgentPeriod();";
}


function diagnostic($data_array, $title = 'no_title', $path = '/local/logs/')
{
	$full_path = $path;
	if (!is_dir($full_path)) {
		mkdir($full_path, 0755, true);
	}
	Debug::writeToFile($data_array, $title, $path . $title . '_' . time() . '.log');
}
