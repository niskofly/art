<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

?>

	<div class="form-container">
		<div class="modal-header">
			<p class="modal-title uppercase">
				<i class="fa fa-bell-o"></i> <?= $arResult['arForm']['NAME'] ?>
			</p>
		</div>

		<div class="form-body">
			<p><?= $arResult['arForm']['DESCRIPTION'] ?></p>
			<hr>

			<div class="message"></div>
			<div class="placeholder hide">
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
			<?
			/*
					<form
						class="ajax-form"
						name="<?=$arResult["arForm"]['SID']?>"
						action="<?=$componentPath . 'component.php'?>"
						method="POST"
						enctype="multipart/form-data"
					>
						<?// <input type="hidden" name="DATA[IBLOCK_ID]" value="17" > ?>
						<input type="hidden" name="sessid" id="sessid" value="bitrix_sessid()">
						<input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>">

						<?php
					*/ ?>
			<?= $arResult["FORM_HEADER"] ?>
			<?
			// END   --   $arResult["FORM_HEADER"];

			// START   --   Перебор полей

			// перечислим id вопросов которые нужно отработать отдельно
			$exception = array(
				'

            '
			);

			foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
				$FIELD_TYPE = $arQuestion['STRUCTURE'][0]['FIELD_TYPE'];
				$REQUIRED = $arQuestion['REQUIRED'] == "Y" ? "required" : '';
				$ID = $arQuestion['STRUCTURE'][0]['ID'];
				$comments = $arResult['arQuestions'][$FIELD_SID]['COMMENTS'];

				// pre($FIELD_SID);
				// pre($arQuestion['STRUCTURE'][0]['QUESTION_ID']);
				// pre($arQuestion);

				if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
					$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $ID . ']';
					foreach ($arQuestion['STRUCTURE'] as $question) {
						?>

						<input
							class="form-check-input"
							type="<?= $question['FIELD_TYPE'] ?>"
							id="<?= $ID ?>"
							name="<?= $NAME ?>"
							value="<?= $question['VALUE'] ?>"
							<?= $REQUIRED ?>
							<?= $question['FIELD_PARAM'] ?>
						/>

						<?
					}
					?>
					<div class="invalid-feedback"><?= GetMessage("ENTER_NOMINATION"); ?></div>
					<?php
					// echo $arQuestion["HTML_CODE"];
					// pre($arResult['QUESTIONS']['page']);
					// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_ID']);
					// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['MESSAGE']);
					// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['VALUE']);
					// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_TYPE']);
					// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_PARAM']);
					// pre($arResult['arQuestions']['page']['COMMENTS']);


				} else {
					?>
					<div class="form-group" id="field-<?= $ID ?>">
						<label for="<?= $ID ?>">
							<?php
							/* if( !empty( $arQuestion['IMAGE'] ) ){?>
														   <img src="<?=$arQuestion['IMAGE']['URL']?>" alt="<?=$arQuestion['CAPTION']?>">
													   <?} */
							?>
							<?= $arQuestion['CAPTION'] ?><?= $REQUIRED ? "<b>*</b>" : "" ?>
						</label>

						<?php
						if ($FIELD_TYPE == 'radio' || $FIELD_TYPE == 'checkbox') {
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $FIELD_SID . ']';
							$NAME .= $FIELD_TYPE == 'checkbox' ? '[]' : '';

							foreach ($arQuestion['STRUCTURE'] as $question) {
								?>
								<div class="form-check">
									<input
										class="form-check-input"
										type="<?= $question['FIELD_TYPE'] ?>"
										id="<?= $ID ?>"
										name="<?= $NAME ?>"
										value="<?= $question['ID'] ?>"
										<?= $REQUIRED ?>
										<?= $question['FIELD_PARAM'] ?>
									/>
									<label class="form-check-label">
										<?= $question['MESSAGE'] ?>
									</label>
								</div>
								<?php
							}
							?>
							<?php
						} elseif ($FIELD_TYPE == 'dropdown' || $FIELD_TYPE == 'multiselect') {
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $FIELD_SID . ']';
							$NAME .= $FIELD_TYPE == 'multiselect' ? '[]' : '';
							?>
							<select
								class="form-control"
								id="<?= $ID ?>"
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
							<textarea class="form-control" id="<?= $ID ?>" name="<?= $NAME ?>"
									  rows="<?= $question['FIELD_HEIGHT'] ?>"
									  placeholder="<?= $comments ?>" <?= $REQUIRED ?>></textarea>
							<?php
						} elseif ($FIELD_TYPE == 'date') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							$image = $arQuestion['IMAGE']['URL'] ?: '/bitrix/js/main/core/images/calendar-icon.gif';
							?>
							<input
								class="form-control "
								type="date"
								id="<?= $ID ?>"
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
								class="form-control-file"
								type="file"
								id="<?= $ID ?>"
								name="<?= $NAME ?>"
								<?= $REQUIRED ?>
							>
							<?php
						} elseif ($FIELD_TYPE == 'email') {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<input
								class="form-control"
								type="<?= $FIELD_TYPE ?>"
								id="<?= $ID ?>"
								name="<?= $NAME ?>"
								aria-describedby="emailHelp"
								placeholder="<?= $comments ?>"
								<?= $REQUIRED ?>
							>
							<?php
						} else {
							$question = $arQuestion['STRUCTURE'][0];
							$NAME = 'DATA[form_' . $FIELD_TYPE . '_' . $question['ID'] . ']';
							?>
							<input
								class="form-control"
								type="<?= $FIELD_TYPE ?>"
								id="<?= $ID ?>"
								name="<?= $NAME ?>"
								placeholder="<?= $comments ?>"
								<?= $REQUIRED ?>
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
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
				<?php
			}

			// END   --   Капча
			?>

			<label class="agreement1" for="agreement1">
				Нажимая на кнопку «отправить», Вы принимаете условия <a href="/about/agreement/">Пользовательского
					соглашения</a>
			</label>

			<div class="modal-footer">
				<input
					class="btns forms"
					type="submit"
					name="web_form_submit"
					value="<?= htmlspecialcharsbx(
						strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage(
							"FORM_ADD"
						) : $arResult["arForm"]["BUTTON"]
					); ?>"
				/>
			</div>
			</form>
		</div>
	</div>

	<script>
			//Recaptchafree.reset();
	</script>
<?
// pre($arResult['QUESTIONS']['page']);
// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_ID']);
// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['MESSAGE']);
// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['VALUE']);
// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_TYPE']);
// pre($arResult['QUESTIONS']['page']['STRUCTURE'][0]['FIELD_PARAM']);
// pre($arResult['arQuestions']['page']['COMMENTS']);

?>
