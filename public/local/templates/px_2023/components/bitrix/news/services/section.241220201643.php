<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Localization\Loc; ?>
<? $this->setFrameMode(true); ?>
<?
  // get section items count and subsections
  $arItemFilter = CMedc2::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
  $arSectionFilter = CMedc2::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
  $itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
  $arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'NAME', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE', 'IBLOCK_ID', 'UF_TOP_SEO'));

  CMedc2::AddMeta(
    array(
      'og:description' => $arSection['DESCRIPTION'],
      'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
    )
  );
  //echo "<pre>"; print_r($arSection); echo "</pre>";
  $arSubSectionFilter = CMedc2::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
  $arSubSections = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));
  if (!$arSection) {
    header("HTTP/1.1 404 Not Found");
  }
?>
<? global $arTheme ?>
<div class="row">
  <? if ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
  <div class="col-md-9 col-sm-12 col-xs-12 content-md">
    <? CMedc2::get_banners_position('CONTENT_TOP'); ?>
    <? elseif ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
    <div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
      <? CMedc2::ShowPageType('left_block') // menu?>
    </div>
    <div class="col-md-9 col-sm-12 col-xs-12 content-md">
      <? CMedc2::get_banners_position('CONTENT_TOP'); ?>
      <? endif; ?>

      <? if (!$arSection && $arParams['SET_STATUS_404'] !== 'Y'): ?>
        <div class="alert alert-warning"><?= GetMessage("SECTION_NOTFOUND") ?></div>
      <? elseif (!$arSection && $arParams['SET_STATUS_404'] === 'Y'): ?>
        <? CMedc2::goto404Page(); ?>
      <? else: ?>

        <? // rss
        if ($arParams['USE_RSS'] !== 'N') {
          CMedc2::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'] . $arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
        } ?>
        <? if (!$arSubSections && !$itemsCnt): ?>
          <!-- <div class="alert alert-warning"><?= GetMessage("SECTION_EMPTY") ?></div> -->
        <? endif; ?>
        <!-- <div class="main-section-wrapper"> -->
        <? // intro text?>
        <? if ($arSection['UF_TOP_SEO']): ?>
          <!-- <div class="text_before_items"><?= $arSection['UF_TOP_SEO'] ?></div> -->
        <? endif ?>

        <? if ($arSection['DESCRIPTION'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false): ?>

          <!--<div class="text_after_items"><? //=$arSection['DESCRIPTION'];?></div>-->

          <?
          $rsUf = CIBlockSection::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => $arSectionFilter["IBLOCK_ID"], "ID" => $arSectionFilter["ID"]], false, ["ID", "IBLOCK_ID", "UF_PRICE", "UF_MORE_PHOTO", "UF_LINK_REVIEWS", "UF_LINK_QUESTIONS", "UF_DETAIL_TEXT", "NAME", "UF_OUR_WORKS", "UF_LINK_STAFF", "UF_BLOCK_1", "UF_BLOCK_1_PRICE", "UF_BLOCK_3", "UF_BLOCK_4", "UF_BLOCK_2", "UF_ENABLE_CALC"]);
          $arUf = $rsUf->Fetch();

          foreach ($arUf["UF_MORE_PHOTO"] as $i => $fileID) // gallery
          {
            //$arGallery[] = CFile::GetFileArray($fileID);

            $arResult['GALLERY'][] = array(
              'DETAIL' => ($arPhoto = CFile::GetFileArray($fileID)),
              'PREVIEW' => CFile::ResizeImageGet($fileID, array('width' => 1500, 'height' => 1500), BX_RESIZE_PROPORTIONAL_ALT, true),
              'THUMB' => CFile::ResizeImageGet($fileID, array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
              'TITLE' => $arUf['NAME'],
              'ALT' => $arUf['NAME'],
            );
          }

          global $UF_BLOCK_1, $UF_BLOCK_1_PRICE, $UF_BLOCK_3, $UF_BLOCK_4, $UF_BLOCK_2, $UF_ENABLE_CALC;
          $UF_BLOCK_1 = $arUf["UF_BLOCK_1"];
          $UF_BLOCK_1_PRICE = $arUf["UF_BLOCK_1_PRICE"];
          $UF_BLOCK_3 = $arUf["UF_BLOCK_3"];
          $UF_BLOCK_4 = CFile::GetPath($arUf["UF_BLOCK_4"]);
          $UF_BLOCK_2 = $arUf["UF_BLOCK_2"];
          $UF_ENABLE_CALC = $arUf["UF_ENABLE_CALC"];

          $arResult["NAME"] = $arSection["NAME"];

          foreach ($arUf["UF_PRICE"] as $i => $elementID) // prices
          {
            $arResult['DISPLAY_PROPERTIES']['LINK_PRICES']['VALUE'][] = $elementID;
          }

          foreach ($arUf["UF_LINK_REVIEWS"] as $i => $elementID) // reviews
          {
            $arResult['DISPLAY_PROPERTIES']['LINK_REVIEWS']['VALUE'][] = $elementID;
          }

          foreach ($arUf["UF_LINK_QUESTIONS"] as $i => $elementID) // questions
          {
            $arResult['DISPLAY_PROPERTIES']['LINK_QUESTIONS']['VALUE'][] = $elementID;
          }

          foreach ($arUf["UF_LINK_STAFF"] as $i => $elementID) {
            $arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'][] = $elementID;
          }

          // description
          $arResult['DETAIL_TEXT_TYPE'] = $arSection["DESCRIPTION_TYPE"];
          $arResult['FIELDS']["DETAIL_TEXT"] = $arSection["DESCRIPTION"];
          ?>


          <div class="detail services">
            <? include_once($_SERVER["DOCUMENT_ROOT"] . '/include/services_template.php'); ?>
          </div>
          <? // section elements?>
          <? @include_once('page_blocks/' . $arParams["SECTION_ELEMENTS_TYPE_VIEW"] . '.php'); ?>
        <? endif; ?>
        <!-- </div> -->
      <? endif; ?>

      <? if ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
      <? CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
    </div><? // class=col-md-9 col-sm-9 col-xs-8 content-md?>
    <? elseif ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
    <? CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
  </div><? // class=col-md-9 col-sm-9 col-xs-8 content-md?>
  <div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
    <? CMedc2::ShowPageType('left_block') ?>
  </div>
<? endif; ?>
</div>