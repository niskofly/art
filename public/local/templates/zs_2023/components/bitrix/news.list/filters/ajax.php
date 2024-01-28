<?php
/** @global \CMain $APPLICATION */
define( 'STOP_STATISTICS', true );
define( 'NOT_CHECK_PERMISSIONS', true );

include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$iblock_id = 33;
$filter = $_POST['filter'];
$sort = $_POST['sort'];
print_r($sort);
if($sort){
	$sort1 = trim($sort["name"],"%");
	$order1 = $sort["value"];
	echo "$sort1 $order1<br>";
}
else {
	$sort1 = "ACTIVE_FROM";
	$order1 = "DESC";
}
global $arrFilter_ajax;
foreach( $filter as $prop  ){
  if( $prop['value'] && $prop['value'] !== 0 )
  {
    $arrFilter_ajax['PROPERTY_'.$prop['name']] = $prop['value'];
  }
}
$APPLICATION->IncludeComponent(
  "bitrix:news.list",
  "registry",
  array(
    "ajax_custom" =>  $_POST['marker'] == 'ajax' ? "Y":"N",
    "ACTIVE_DATE_FORMAT" => "d.m.Y",
    "ADD_SECTIONS_CHAIN" => "Y",
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_ADDITIONAL" => "",
    "AJAX_OPTION_HISTORY" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "Y",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "Y",
    "CACHE_TIME" => "36000000",
    "CACHE_TYPE" => "A",
    "CHECK_DATES" => "Y",
    "DETAIL_URL" => "",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_NAME" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_TOP_PAGER" => "N",
    "FIELD_CODE" => array(
      0 => "",
      1 => "",
    ),
    "FILTER_NAME" => "arrFilter_ajax",
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "IBLOCK_ID" => $iblock_id,
    "IBLOCK_TYPE" => "register_members",
    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
    "INCLUDE_SUBSECTIONS" => "Y",
    "MESSAGE_404" => "",
    "NEWS_COUNT" => "9999",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => ".default",
    "PAGER_TITLE" => "Новости",
    "PARENT_SECTION" => "",
    "PARENT_SECTION_CODE" => "",
    "PREVIEW_TRUNCATE_LEN" => "",
    "PROPERTY_CODE" => array(
      0 => "GROUP1_FULL_NAME",
      1 => "GROUP1_REGISTRATION_NUMBER",
      2 => "GROUP1_INN",
      3 => "GROUP1_SRO_MEMBER_STATUS",
      4 => "GROUP2_LEGAL_STATUS",
      5 => "",
    ),
    "SET_BROWSER_TITLE" => "Y",
    "SET_LAST_MODIFIED" => "N",
    "SET_META_DESCRIPTION" => "Y",
    "SET_META_KEYWORDS" => "Y",
    "SET_STATUS_404" => "N",
    "SET_TITLE" => "Y",
    "SHOW_404" => "N",
    "SORT_BY1" => $sort1,
    "SORT_BY2" => "SORT",
    "SORT_ORDER1" => $order1,
    "SORT_ORDER2" => "ASC",
    "STRICT_SECTION_CHECK" => "N",
    "COMPONENT_TEMPLATE" => "registry",
    "CACHE_NOTES" => ""
  ),
  $component,
   array("HIDE_ICONS" => "Y")
);
