<?php
/**
 * @var string $templateFolder
 * */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

// Если перенесли placeholder.css для использования на сайте впринципе, то нужно заменить адрес подключения
//$this->addExternalCss( $templateFolder . '/placeholder.css');
//$this->addExternalCss( SITE_TEMPLATE_PATH . '/assets/css/placeholder.css');

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

?>

<div class="form-container">

	<?php
	if( $arParams['SHOW_FORM_TITLE'] == "Y" )
	{
	    ?>
		<div class="modal-header">
			<div class="modal-title">
				<?= $arParams['FORM_TITLE'] ?: $arResult['arForm']['NAME']; ?>
			</div>
		</div>
	    <?php
	}
	?>

	<div class="form-body">
		<?php
		if ($arResult['arForm']['DESCRIPTION']) {
			?>
			<p><?= $arResult['arForm']['DESCRIPTION'] ?></p>
			<?php
		} ?>
		<hr>

		<div class="message"></div>
		<div class="placeholder" style="display: none;">
			<div class='sk-circle-bounce'>
				<div class='sk-child sk-circle-1'></div>
				<div class='sk-child sk-circle-2'></div>
				<div class='sk-child sk-circle-3'></div>
				<div class='sk-child sk-circle-4'></div>
				<div class='sk-child sk-circle-5'></div>
				<div class='sk-child sk-circle-6'></div>
				<div class='sk-child sk-circle-7'></div>
				<div class='sk-child sk-circle-8'></div>
				<div class='sk-child sk-circle-9'></div>
				<div class='sk-child sk-circle-10'></div>
				<div class='sk-child sk-circle-11'></div>
				<div class='sk-child sk-circle-12'></div>
			</div>
		</div>

		<?php
		// START   --   $arResult["FORM_HEADER"]; Делаем вручную
		?>
		<form
			class="ajax-form"
			name="<?= $arResult["arForm"]['SID'] ?>"
			action="<?= $templateFolder ?>/ajax.php"
			method="POST"
			enctype="multipart/form-data"
			<?php
			if (!empty($arParams['YA_TARGET_ID'])) {
				?>
				form-ya_target="<?= $arParams['YA_TARGET_ID'] ?>"
				<?php
			}
			?>
		>
			<?php
			// <input type="hidden" name="DATA[IBLOCK_ID]" value="17" > ?>
			<input type="hidden" name="sessid" id="sessid" value="bitrix_sessid()">
			<input type="hidden" name="WEB_FORM_ID" value="<?= $arParams["WEB_FORM_ID"] ?>">
			<?php
			if (!empty($arParams['YA_TARGET_ID'])) {
				?>
				<input type="hidden" name="DATA[YA_TARGET_ID]" value="<?= $arParams["YA_TARGET_ID"] ?>">
				<?php
			}
			// END   --   $arResult["FORM_HEADER"];

			// START   --   Перебор полей

			foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
				$inputClass = strtolower($FIELD_SID);

				$FIELD_TYPE = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
				$REQUIRED = $arQuestion['REQUIRED'] == "Y" ? "required" : '';
				$ID = $arQuestion['STRUCTURE'][0]['ID'];
				$comments = $arResult['arQuestions'][$FIELD_SID]['COMMENTS'];

				$placeholder = '';
				$label = '';

				if ($arParams['TITLE_IN_PLACEHOLDER'] == 'Y') {
					$placeholder = $arQuestion['CAPTION'] . ($REQUIRED ? "*" : "");
				} else {
					$label = $arQuestion['CAPTION'] . ($REQUIRED ? "<b>*</b>" : "");
				}


				if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
					if ($FIELD_SID === 'ya_target_id') {
						?>
						<input type="hidden" name="DATA[YA_TARGET_ID]"
							   value="<?= $arQuestion['STRUCTURE'][0]['VALUE'] ?>"/>
						<?php
					}

					$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $ID . ']';
					foreach ($arQuestion['STRUCTURE'] as $question) {
						$value = $question['VALUE'];
						if (strpos($question['FIELD_PARAM'], 'ARPARAM_') === 0) {
							$value = $arParams[str_replace('ARPARAM_', '', $question['FIELD_PARAM'])];
						}
						?>

						<input
							class="form-check-input <?= $inputClass ?>"
							type="<?= $question['FIELD_TYPE'] ?>"
							id="field_<?= $ID ?>"
							name="<?= $NAME ?>"
							value="<?= $value ?>"
							<?= $REQUIRED ?>
							<?= $question['FIELD_PARAM'] ?>
						/>

						<?php
					}
					?>
					<div class="invalid-feedback"><?= GetMessage("ENTER_NOMINATION"); ?></div>
					<?php
				} else {
					?>
					<div class="form-group" id="field-<?= $ID ?>">
						<?php
						if (!empty($arQuestion['IMAGE'])) {
							?>
							<img src="<?= $arQuestion['IMAGE']['URL'] ?>" alt="<?= $arQuestion['CAPTION'] ?>">
							<?php
						}

						if ($label != '') {
							?>
							<label class="form-group__field-label" for="field_<?= $ID ?>">
								<?= $label ?>
							</label>
							<?php
						}

						if ($FIELD_TYPE == 'radio' || $FIELD_TYPE == 'checkbox') {
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $FIELD_SID . ']';
							$NAME .= $FIELD_TYPE == 'checkbox' ? '[]' : '';
							?>
							<div class="form-check__list">
								<?php
								foreach ($arQuestion['STRUCTURE'] as $question) {
									pre($question['FIELD_PARAM']);
									?>
									<div class="form-check">
										<input
											class="form-check-input <?= $inputClass ?>"
											type="<?= $question['FIELD_TYPE'] ?>"
											id="question_<?= $question['ID'] ?>"
											name="<?= $NAME ?>"
											value="<?= $question['ID'] ?>"
											<?= $REQUIRED ?>
											<?= $question['FIELD_PARAM'] ?>
										/>
										<label for="question_<?= $question['ID'] ?>" class="form-group__check-label">
											<?= $question['MESSAGE'] ?>
										</label>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						} elseif ($FIELD_TYPE == 'dropdown' || $FIELD_TYPE == 'multiselect') {
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $FIELD_SID . ']';
							$NAME .= $FIELD_TYPE == 'multiselect' ? '[]' : '';
							?>
							<select
								class="form-control"
								id="field_<?= $ID ?>"
								name="<?= $NAME ?>"
								<?= $REQUIRED ?>
								<?= $FIELD_TYPE == 'multiselect' ? 'multiple' : ''; ?>
							>
								<?php
								foreach ($arQuestion['STRUCTURE'] as $question) {
									?>
									<option
										value="<?= $question['ID'] ?>" <?= $question['FIELD_PARAM'] ?>><?= $question['MESSAGE'] ?></option>
									<?php
								} ?>
							</select>
							<?php
						} elseif ($FIELD_TYPE == 'textarea') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<textarea class="form-control" id="field_<?= $ID ?>" name="<?= $NAME ?>"
									  rows="<?= $question['FIELD_HEIGHT'] ?>"
									  placeholder="<?= $placeholder ?>"
							></textarea>
							<?php
						} elseif ($FIELD_TYPE == 'date') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							$image = $arQuestion['IMAGE']['URL'] ?: '/bitrix/js/main/core/images/calendar-icon.gif';
							?>
							<input
								class="form-control <?= $inputClass ?>"
								type="date"
								id="field_<?= $ID ?>"
								name="<?= $NAME ?>"
								value=""
								placeholder="Например 01.01.2019, или выберите в календаре ->"
								<?= $REQUIRED ?>
							>

							<?php
						} // elseif( $FIELD_TYPE == '' ){}
						elseif ($FIELD_TYPE == 'image' || $FIELD_TYPE == 'file') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<input
								class="form-control-file <?= $inputClass ?>"
								type="file"
								id="field_<?= $ID ?>"
								name="<?= $NAME ?>"
								<?= $REQUIRED ?>
							>
							<?php
						} elseif ($FIELD_TYPE == 'email') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<input
								class="form-control <?= $inputClass ?>"
								type="<?= $FIELD_TYPE ?>"
								id="field_<?= $ID ?>"
								name="<?= $NAME ?>"
								aria-describedby="emailHelp"
								placeholder="<?= $placeholder ?>"
								<?= $REQUIRED ?>
								<?= $question['FIELD_PARAM'] ?>
							>
							<?php
						} else {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<input
								class="form-control <?= $inputClass ?>"
								type="<?= $FIELD_TYPE ?>"
								id="field_<?= $ID ?>"
								name="<?= $NAME ?>"
								placeholder="<?= $placeholder ?>"
								<?= $REQUIRED ?>
								<?= $question['FIELD_PARAM'] ?>
							>
							<?php
						}
						?>
					</div>
					<?php
				}
			}


			// END   --   Перебор полей

			// START   --   Капча

			if ($arResult["isUseCaptcha"] == "Y") {
				?>
				<input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"/>
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>"
					 width="180" height="40"/>
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" required />
				<?php
			}

			// END   --   Капча

			$buttonText = Loc::GetMessage("FORM_ADD");

			if (isset($arParams['BUTTON_TEXT']) && !empty($arParams['BUTTON_TEXT'])) {
				$buttonText = $arParams['BUTTON_TEXT'];
			} elseif (isset($arResult["arForm"]["BUTTON"]) && !empty($arResult["arForm"]["BUTTON"])) {
				$buttonText = $arResult["arForm"]["BUTTON"];
			}
			?>
			<div class="ajax-form__footer">
				<div class="ajax-form__buttons">
					<input
						class="button button--dark"
						type="submit"
						name="web_form_submit"
						value="<?= $buttonText ?>"
					/>
				</div>


				<div class="agreement">
					<?php
					if ($arParams["FOOTER_TEXT"]) { ?>
						<?= $arParams["FOOTER_TEXT"] ?><br>
						<?php
					} ?>
					Нажимая на кнопку «отправить», Вы принимаете условия <a target="_blank" href="<?=$arParams['AGREEMENT_LINK']?>">Пользовательского
						соглашения</a>
				</div>

			</div>
		</form>
	</div>
</div>


