<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
global $USER;
if ($USER->IsAuthorized()) {
	LocalRedirect("/");
}
CJSCore::Init();
?>

<div class="form-container">

	<?
	if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) {
		ShowMessage($arResult['ERROR_MESSAGE']);
	}
	?>


	<form name="system_auth_form<?= $arResult["RND"] ?>" method="post"
		  target="_top" action="<?= $arResult["AUTH_URL"] ?>&backurl=/">
		<?
		if ($arResult["BACKURL"] <> ''): ?>
			<input type="hidden" name="backurl"
				   value="<?= $arResult["BACKURL"] ?>"/>
		<?
		endif ?>
		<?
		foreach ($arResult["POST"] as $key => $value): ?>
			<input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
		<?
		endforeach ?>
		<input type="hidden" name="AUTH_FORM" value="Y"/>
		<input type="hidden" name="TYPE" value="AUTH"/>
		<div class="form-group" id="field-2">
			<img src="<?= SITE_TEMPLATE_PATH ?>/assets/ico/password.png" alt="логин">
			<input class="form-control name" type="text" id="field_2" name="USER_LOGIN"
				   placeholder="<?= GetMessage("AUTH_LOGIN") ?>">
			<script>
							BX.ready(function() {
								var loginCookie = BX.getCookie("<?=CUtil::JSEscape(
					$arResult["~LOGIN_COOKIE_NAME"]
				)?>");
								if (loginCookie) {
									var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
									var loginInput = form.elements['USER_LOGIN'];
									loginInput.value = loginCookie;
								}
							});
			</script>
		</div>
		<div class="form-group" id="field-2">
			<img src="<?= SITE_TEMPLATE_PATH ?>/assets/ico/mail.png" alt="почта">
			<input class="form-control name" type="password" id="field_2" name="USER_PASSWORD"
				   placeholder="<?= GetMessage("AUTH_PASSWORD") ?>">
		</div>
		<table width="95%">
			<?
			if ($arResult["STORE_PASSWORD"] == "Y"): ?>
				<tr>
					<td valign="top"><input type="checkbox"
											id="USER_REMEMBER_frm"
											name="USER_REMEMBER" value="Y"/>
					</td>
					<td width="100%"><label for="USER_REMEMBER_frm"
											title="<?= GetMessage(
												"AUTH_REMEMBER_ME"
											) ?>"><?
							echo GetMessage("AUTH_REMEMBER_SHORT") ?></label>
					</td>
				</tr>
			<?
			endif ?>
			<?
			if ($arResult["CAPTCHA_CODE"]) { ?>
				<tr>
					<td colspan="2">
						<?
						echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
						<input type="hidden" name="captcha_sid" value="<?
						echo $arResult["CAPTCHA_CODE"] ?>"/>
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?
						echo $arResult["CAPTCHA_CODE"] ?>" width="180"
							 height="40" alt="CAPTCHA"/><br/><br/>
						<input type="text" name="captcha_word" maxlength="50"
							   value=""/></td>
				</tr>
			<?
			} ?>
			<?
			if ($arResult["NEW_USER_REGISTRATION"] == "Y" && 0) { ?>
				<tr>
					<td colspan="2">
						<noindex><a href="<?= $arResult["AUTH_REGISTER_URL"] ?>"
									rel="nofollow"><?= GetMessage(
									"AUTH_REGISTER"
								) ?></a></noindex>
						<br/></td>
				</tr>
			<?
			} ?>

		</table>
		<div class="ajax-form__footer">
			<div class="ajax-form__buttons">
				<input class="button button--dark" type="submit" name="Login" value="<?= GetMessage(
					"AUTH_LOGIN_BUTTON"
				) ?>">
			</div>
		</div>
	</form>


</div>
