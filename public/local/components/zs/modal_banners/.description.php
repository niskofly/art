<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arComponentDescription = array(
	"NAME" => GetMessage("ZS_MODAL_BANNERS_NAME"),
	"DESCRIPTION" => GetMessage("ZS_MODAL_BANNERS_DESC"),
	"ICON" => "/images/news_list.gif",
	"SORT" => 20,
//	"SCREENSHOT" => array(
//		"/images/post-77-1108567822.jpg",
//		"/images/post-1169930140.jpg",
//	),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => GetMessage('ZS_MODAL_BANNERS_PATH_PATH_ID'),
			"NAME" => GetMessage("ZS_MODAL_BANNERS_PATH_NAME"),
		),
	),
);
