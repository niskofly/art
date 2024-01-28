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
$this->setFrameMode(true); ?>

<form action="<?= $arResult["FORM_ACTION"] ?>" class="search">

	<div class="search__fild">
		<?php
		if ($arParams["USE_SUGGEST"] === "Y") {
			$APPLICATION->IncludeComponent(
					"bitrix:search.suggest.input",
					"",
					array(
							"NAME" => "q",
							"VALUE" => "",
							"INPUT_SIZE" => 15,
							"DROPDOWN_SIZE" => 10,
					),
					$component, array("HIDE_ICONS" => "Y")
			);
		} else {
			?>
			<input type="text" name="search" class="input input--search search__input" placeholder="Поиск по сайту"/>
			<?php
		}
		?>
		<div class="search__result">
			<a href="/" class="search-item">
				<div class="search-item__preview">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/search-preview.png" alt="">
				</div>
				<div class="search-item__desc">
					<div class="search-item__name">
						Обертывание для похудения
					</div>
					<div class="search-item__chapter">
						услуга
					</div>
				</div>
			</a>
			<a href="/" class="search-item">
				<div class="search-item__preview">
					<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/search-preview.png" alt="">
				</div>
				<div class="search-item__desc">
					<div class="search-item__name">
						Обертывание для похудения
					</div>
					<div class="search-item__chapter">
						услуга
					</div>
				</div>
			</a>
		</div>
	</div>
<!--	<input src="--><?php //= SITE_TEMPLATE_PATH ?><!--/assets/icons/search.svg" alt="Искать" name="s" type="image"-->
<!--		   value="--><?php //= GetMessage("BSF_T_SEARCH_BUTTON"); ?><!--"/>-->

	<button type="submit" class="search__button" value="<?= GetMessage("BSF_T_SEARCH_BUTTON"); ?>" alt="Искать">
		<svg class="icon">
			<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/icons/svg-sprite.svg#search"></use>
		</svg>
	</button>
</form>
