<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<div class="oborudovanie-detail">
	<div class="oborudovanie-top">
		<div class="oborudovanie-top__left">
			<img
					class="detail_picture"
					border="0"
					src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
			/>
		</div>

		<div class="oborudovanie-top__right">
			<?if($arResult["NAV_RESULT"]):?>
				<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
				<?echo $arResult["NAV_TEXT"];?>
				<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
			<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
			<div style="clear:both"></div>
			<br />
		</div>

	</div>










		<br />
</div>
