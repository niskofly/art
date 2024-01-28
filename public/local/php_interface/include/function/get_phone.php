<?php

function getPhoneClear($phone_src)
{
	$phone_clear = preg_replace('/[^0-9]/', '', $phone_src);
	$first_num = substr($phone_clear, 0, 1);
	if ((int)$first_num === 7 || (int)$first_num === 8) {
		$phone_clear = substr($phone_clear, 1);
	}
	$phone_clear = '+7' . $phone_clear;
}
