<?php

function crop_text($str, $size)
{
	$str = trim($str);
	$str = strip_tags($str);
	if (strlen($str) < $size) {
		return $str;
	}
	$str = substr($str, 0, $size); // отрезаем строку по указанному количеству символов.
	$n_str = trim(
		substr($str, 0, strrpos($str, ' ')),
		".!,\"'"
	); //получаем позицию последнего пробела и обрезаем до нее строку
	if (strlen($str) != strlen($n_str)) {
		return $n_str . " ...";
	}
	return $n_str;
}
