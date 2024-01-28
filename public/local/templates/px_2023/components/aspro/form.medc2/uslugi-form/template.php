<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<?
$this->setFrameMode(false); ?>
<style>


</style>
<div class="form inline<?= ($arResult['isFormNote'] == 'Y' ? ' success' : '') ?><?= ($arResult['isFormErrors'] == 'Y' ? ' error' : '') ?>">
	<?
	if ($arResult["isFormNote"] == "Y") { ?>
		<div class="form-header">
			<div class="text">
				<div class="title"><?= GetMessage("SUCCESS_TITLE") ?></div>
			</div>
		</div>
		<script>
					if (arMedc2Options['THEME']['USE_FORMS_GOALS'] !== 'NONE') {
						var eventdata = {
							goal: 'goal_webform_success' +
									(arMedc2Options['THEME']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?=$arParams["IBLOCK_ID"]?>'),
							params: <?=CUtil::PhpToJSObject($arParams, false)?>
						};
						BX.onCustomEvent('onCounterGoals', [eventdata]);
					}
		</script>

	<?
	}else{ ?>
	<?= $arResult["FORM_HEADER"] ?>
	<?
	if ($arResult['isFormErrors'] == 'Y'): ?>
		<div class="form-error alert alert-danger">
			<?= $arResult['FORM_ERRORS_TEXT'] ?>
		</div>
	<?
	endif; ?>
			<div class="form-main__row">
				<div class="form-body">
					<?
					if (is_array($arResult["QUESTIONS"])): ?>
						<?
						foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
							if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
								echo $arQuestion["HTML_CODE"];
							} else {
								?>
								<div class="row" data-SID="<?= $FIELD_SID ?>">

									<div class="form-group <?= ($arQuestion['FIELD_TYPE'] != "file" ? "animated-labels" : ""); ?> <?= ($arQuestion['VALUE'] ? "input-filed" : ""); ?>">

										<div class="input-field"><input class="form-control required phone"
																		type="<?= $arQuestion['FIELD_TYPE'] ?>"
																		id="<?= $arQuestion['CODE'] ?>"
																		name="<?= $arQuestion['CODE'] ?>"
																		placeholder="<?= $arQuestion['NAME'] ?>"></div>
										<? if (!empty($arQuestion["HINT"])) {
											?>
											<div class="hint"><?= $arQuestion["HINT"] ?></div>
											<?
										} ?>
									</div>

								</div>
								<?
							}
						} ?>
					<?
					endif; ?>
				</div>
				<div class="form-footer clearfix">
					<div class="">
						<button class="btn-lg button button--new btn btn-primary btn-default" type="submit">Отправить</button>
					</div>
				</div>
				<?= $arResult["FORM_FOOTER"] ?>
				<?
				} ?>
			</div>

</div>

<script>
	$(document).ready(function() {
		$('.inline form[name="<?=$arResult["IBLOCK_CODE"]?>"]').validate({
			highlight: function(element) {
				$(element).parent().addClass('error');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass('error');
			},
			submitHandler: function(form) {
				if ($('.inline form[name="<?=$arResult["IBLOCK_CODE"]?>"]').valid()) {
					$(form).find('button[type="submit"]').attr('disabled', 'disabled');
					form.submit();
				}
			},
			errorPlacement: function(error, element) {
				$(element).parent().append(error);
			},
			messages: {
				licenses: {
					required: BX.message('JS_REQUIRED_LICENSES')
				}
			}
		});

		if (arMedc2Options['THEME']['PHONE_MASK'].length) {
			var base_mask = arMedc2Options['THEME']['PHONE_MASK'].replace(/(\d)/g, '_');
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.phone').
					inputmask('mask', {'mask': arMedc2Options['THEME']['PHONE_MASK'], 'showMaskOnHover': false});
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.phone').blur(function() {
				if ($(this).val() == base_mask || $(this).val() == '') {
					if ($(this).hasClass('required')) {
						$(this).parent().find('div.error').html(BX.message('JS_REQUIRED'));
					}
				}
			});
		}

		if (arMedc2Options['THEME']['DATE_MASK'].length)
			$('.inline form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.date').
					inputmask(arMedc2Options['THEME']['DATE_MASK'],
							{'placeholder': arMedc2Options['THEME']['DATE_PLACEHOLDER'], 'showMaskOnHover': false});

		$('.jqmClose').closest('.jqmWindow').jqmAddClose('.jqmClose');

		$('input[type=file]').
				uniform({fileButtonHtml: BX.message('JS_FILE_BUTTON_NAME'), fileDefaultHtml: BX.message('JS_FILE_DEFAULT')});
	});
</script>
