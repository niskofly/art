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

$this->addExternalCss('/local/media/css/normalize.css');

$this->addExternalJs('/local/vendor/Inputmask-5.x/dist/jquery.inputmask.js');
$this->addExternalJs(SITE_TEMPLATE_PATH.'/assets/components/forms/script.js');
$this->addExternalJs(SITE_TEMPLATE_PATH.'/assets/components/modal/script.js');
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/forms/forms.css");
$this->addExternalCss(SITE_TEMPLATE_PATH . "/assets/components/forms/placeholder.css");
$this->addExternalCss(SITE_TEMPLATE_PATH.'/assets/components/buttons/style.css');
$this->addExternalCss(SITE_TEMPLATE_PATH.'/assets/components/modal/style.css');
$this->addExternalCss(SITE_TEMPLATE_PATH.'/components/bitrix/form.result.new/ajax_form/style.css');

?>
<div class="ajax-form-1" style="background-image: url(<?=$templateFolder?>/images/about-bg.png);">
	<div class="ajax-form-1__content">
		<div class="ajax-form-1__top">
			<svg class="ajax-form-1__icon">
				<use xlink:href="/local/templates/2020/media/sprite.svg#clock"></use>
			</svg>
			<?php
			if ($arParams['TITLE']) {
				?>
				<p class="ajax-form-1__text">
					<?= $arParams['TITLE'] ?>
				</p>
				<?php
			}
			?>
		</div>
		<p class="ajax-form-1__bottom">
			<?php
			include($arResult["FILE"]); ?>
		</p>
	</div>
	<span class="modal-button ajax-form-1__btn popup_form_key_js"
	<?//			data-type="form" ?>
				data-type="form"
				data-form-id="<?= $arParams['FORM_ID'] ?>"

	>
		<?= $arParams['BUTTON_TEXT'] ?>
	</span>
</div>
