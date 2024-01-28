<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
// get section items count and subsections
$arItemFilter = CMedc2::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CMedc2::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE', 'IBLOCK_ID', 'UF_TOP_SEO'));
CMedc2::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = CMedc2::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
$arSubSections = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));
?>
<?global $arTheme?>
<div class="row">
	<?if($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
		<div class="col-md-9 col-sm-12 col-xs-12 content-md">
		<?CMedc2::get_banners_position('CONTENT_TOP');?>
	<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
		<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
			<?CMedc2::ShowPageType('left_block')?>
		</div>
		<div class="col-md-9 col-sm-12 col-xs-12 content-md">
		<?CMedc2::get_banners_position('CONTENT_TOP');?>
	<?endif;?>

		<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
			<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
		<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
			<?CMedc2::goto404Page();?>
		<?else:?>

			<?// rss
			if($arParams['USE_RSS'] !== 'N'){
				CMedc2::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
			}?>
			<?if(!$arSubSections && !$itemsCnt):?>
				<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
			<?endif;?>	
			<div class="main-section-wrapper">
				<?// intro text?>
				<?if($arSection['UF_TOP_SEO']):?>
					<div class="text_before_items"><?=$arSection['UF_TOP_SEO']?></div>
				<?endif?>
				<?if($arSubSections):?>
					<?// sections list?>
					<?@include_once('page_blocks/'.$arParams["SECTION_TYPE_VIEW"].'.php');?>
				<?endif;?>
				<?// section elements?>
				<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
				<?if($arSection['DESCRIPTION'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
					<div class="text_after_items"><?=$arSection['DESCRIPTION'];?></div>
				<?endif;?>				
			</div>
		<?endif;?>
				
	<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
		<?CMedc2::get_banners_position('CONTENT_BOTTOM');?>
		</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
	<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
		<?CMedc2::get_banners_position('CONTENT_BOTTOM');?>
		</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
		<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
			<?CMedc2::ShowPageType('left_block')?>
		</div>
	<?endif;?>
</div>