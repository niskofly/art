<?
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


$this->addExternalCss('/local/vendors/slick-1.8.1/slick/slick.css');
$this->addExternalCss('local/vendors/slick-1.8.1/slick/slick-theme.css');
$this->addExternalJs('/local/vendors/slick-1.8.1/slick/slick.min.js');

?>
<div class="catalog-detail">
	<div class="catalog-detail__image present-slider">
		<h1 class="catalog-detail__image-title"><?= $arResult['NAME'] ?></h1>
		<div class="present-slider__big">
			<?php
			foreach ($arResult['MOD']['PHOTOS']['BIG'] as $id => $big_image) {
				?>
				<img id="img_<?= $id ?>" class="present-slider__big-item" src="<?= $big_image['src'] ?>"
					 alt="Изображение для <?= $arResult['NAME'] ?>">
				<?php
			}
			?>
		</div>
		<div class="present-slider__thumbs">
			<div class="present-slider__thumbs-list slider">
				<?php
				foreach ($arResult['MOD']['PHOTOS']['THUMBS'] as $id => $thumb) {
					?>
					<div class="slider__item">
						<img id="img_<?= $id ?>" class="present-slider__thumbs-item" src="<?= $thumb['src'] ?>"
							 alt="Превью изображения для <?= $arResult['NAME'] ?>">
					</div>
					<?php
				}
				?>
			</div>

		</div>


	</div>
	<div class="catalog-detail__lid">
		<div class="container">
			<h1 class="catalog-detail__title"><?= $arResult['NAME'] ?></h1>
			<div class="catalog-detail__lid-text">
				<?= $arResult['DETAIL_TEXT'] ?>
			</div>
			<div class="block-button">
				<div class="button" data-fancybox data-src="#ask_question" href="javascript:;">Задать вопрос о модели
				</div>
			</div>
		</div>
	</div>
	<div id="ask_question" class="" style="display: none;">
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:iblock.element.add.form",
			"template",
			array(
				"AJAX_MODE" => "N",
				"AJAX_OPTION_SHADOW" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
				"CUSTOM_TITLE_DETAIL_PICTURE" => "",
				"CUSTOM_TITLE_DETAIL_TEXT" => "",
				"CUSTOM_TITLE_IBLOCK_SECTION" => "",
				"CUSTOM_TITLE_NAME" => "Ваше имя",
				"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
				"CUSTOM_TITLE_PREVIEW_TEXT" => "Ваш вопрос или пожелание",
				"CUSTOM_TITLE_TAGS" => "",
				"DEFAULT_INPUT_SIZE" => "30",
				"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
				"ELEMENT_ASSOC" => "CREATED_BY",
				"GROUPS" => array(
					0 => "2",
				),
				"IBLOCK_ID" => "10",
				"IBLOCK_TYPE" => "information",
				"LEVEL_LAST" => "Y",
				"LIST_URL" => "",
				"MAX_FILE_SIZE" => "0",
				"MAX_LEVELS" => "100000",
				"MAX_USER_ENTRIES" => "100000",
				"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
				"PROPERTY_CODES" => array(
					0 => "5",
					1 => "6",
				),
				"PROPERTY_CODES_REQUIRED" => array(
					0 => "5",
				),
				"RESIZE_IMAGES" => "N",
				"SEF_MODE" => "N",
				"STATUS" => "ANY",
				"STATUS_NEW" => "N",
				"USER_MESSAGE_ADD" => "",
				"USER_MESSAGE_EDIT" => "",
				"USE_CAPTCHA" => "N",
				"PAGE_NAME" => $arResult["NAME"],
				"COMPONENT_TEMPLATE" => "template",
				"PROP_COLOR_PLACEHOLDER" => "",
				"PROP_HIDE_HEADER" => "N",
				"PROP_HIDE_DISCRIPT" => "N",
				"PROP_HIDE_NAME_FIELD" => "N",
				"PROP_HIDE_AGREEMENT" => "N",
				"PROP_LINK_AGREEMENT" => "",
				"PROP_CSS_CLASS" => "",
				"PROP_EVENT_NAME" => "ASK_QUESTION_ABOUT_ MODEL",
				"PROP_SEND_NAME" => "Отправить",
				"PROP_HEADER_FORM" => "Мы свяжемся с вами"
			),
			false
		); ?>
	</div>
	<div class="page_navigation_cont container">
		<div class="prev_page">
			<a href="<?= $arResult['MOD']['NEIGHBORS']['ITEMS']['prew']['DETAIL_PAGE_URL'] ?>">
				<?= $arResult['MOD']['NEIGHBORS']['ITEMS']['prew']['NAME'] ?>
			</a>
		</div>
		<div class="next_page">
			<a href="<?= $arResult['MOD']['NEIGHBORS']['ITEMS']['next']['DETAIL_PAGE_URL'] ?>">
				<?= $arResult['MOD']['NEIGHBORS']['ITEMS']['next']['NAME'] ?>
			</a>
		</div>
	</div>
</div>
