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
<div class="doctors-detail">
	<div class="doctors-top">
		<div class="doctors-top__left">
			<img
					class="detail_picture"
					border="0"
					src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
					width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
					height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
					title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
		</div>

		<div class="doctors-top__center">
			<div class="doctors-top__column">
				<div class="doctors-top__name">
					<?=$arResult["PROPERTIES"]["POST"]["NAME"]?>
				</div>
				<div class="doctors-top__value">
					<?=$arResult["PROPERTIES"]["POST"]["VALUE"]?>
				</div>

			</div>
			<div class="doctors-top__column">
				<div class="doctors-top__name">
					<?=$arResult["PROPERTIES"]["WORK"]["NAME"]?>
				</div>
				<div class="doctors-top__value">
					<?=$arResult["PROPERTIES"]["WORK"]["VALUE"]?>
				</div>

			</div>
			<div class="doctors-top__column">
				<div class="doctors-top__name">
					<?=$arResult["PROPERTIES"]["SPECIALIZATION"]["NAME"]?>
				</div>
				<div class="doctors-top__value">
					<?=$arResult["PROPERTIES"]["SPECIALIZATION"]["VALUE"][0]?>
				</div>


			</div>

		</div>

		<div class="doctors-top__right">
			<div data-form="2" class="button-form doctors-top__button">Записаться</div>
			<div class="doctors-top__text">Запишитесь на прием к доктору в удобное для вас время</div>
		</div>

	</div>





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




		<br />
</div>
