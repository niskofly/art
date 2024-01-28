<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
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

<div class="container ">
	<div class="promo__items">
		<?php
		foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction(
				$arItem['ID'],
				$arItem['EDIT_LINK'],
				CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
			);
			$this->AddDeleteAction(
				$arItem['ID'],
				$arItem['DELETE_LINK'],
				CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
				array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
			);
			?>

			<div class="promo__item">
				<div class="card-promo__left">

					<img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="promo">
				</div>
				<div class="card-promo__center">
					<span class="card-promo__label">Акция</span>
					<div class="card-promo__title"><?= $arItem['NAME'] ?></div>
					<div class="card-promo__decrtiption"><?= $arItem['PREVIEW_TEXT'] ?> </div>
				</div>
				<div class="card-promo__right">
					<div class="card-promo__right-column">
						<?$APPLICATION->IncludeComponent(
								"aspro:form.medc2",
								"form-promo",
								Array(
										"AJAX_MODE" => "N",
										"AJAX_OPTION_ADDITIONAL" => "",
										"AJAX_OPTION_HISTORY" => "N",
										"AJAX_OPTION_JUMP" => "N",
										"AJAX_OPTION_STYLE" => "Y",
										"CACHE_GROUPS" => "Y",
										"CACHE_TIME" => "3600",
										"CACHE_TYPE" => "A",
										"CLOSE_BUTTON_CLASS" => "",
										"CLOSE_BUTTON_NAME" => "",
										"COMPONENT_TEMPLATE" => "form-promo",
										"DISPLAY_CLOSE_BUTTON" => "Y",
										"IBLOCK_ID" => "39",
										"IBLOCK_TYPE" => "aspro_medc2_form",
										"LICENCE_TEXT" => "btn btn-primary",
										"SEND_BUTTON_CLASS" => "btn btn-primary",
										"SEND_BUTTON_NAME" => "Отправить",
										"SHOW_LICENCE" => "Y",
										"SUCCESS_MESSAGE" => ""
								)
						);?>
						<div class="card-promo__politics">Нажимая кнопку «Отправить» вы соглашаетесь с политикой конфиденциальности</div>
					</div>
				</div>

			</div>
			<?php
		}
		?>
	</div>
</div>
