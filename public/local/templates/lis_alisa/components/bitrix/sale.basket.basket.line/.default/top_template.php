<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<?
if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'): ?>
	<div class="bx-hdr-profile">
		<div class="bx-basket-block">
			<i class="fa fa-user"></i>
			<?
			if ($USER->IsAuthorized()):
				$name = trim($USER->GetFullName());
				if (!$name) {
					$name = trim($USER->GetLogin());
				}
				if (strlen($name) > 15) {
					$name = substr($name, 0, 12) . '...';
				}
				?>
				<a href="<?= $arParams['PATH_TO_PROFILE'] ?>"><?= htmlspecialcharsbx($name) ?></a>
				&nbsp;
				<a href="?logout=yes"><?= GetMessage('TSB1_LOGOUT') ?></a>
			<?
			else:
			$arParamsToDelete = array(
				"login",
				"login_form",
				"logout",
				"register",
				"forgot_password",
				"change_password",
				"confirm_registration",
				"confirm_code",
				"confirm_user_id",
				"logout_butt",
				"auth_service_id",
				"clear_cache"
			);

			$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
			if ($arParams['AJAX'] == 'N')
			{
			?>
				<script type="text/javascript"><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
			}
			else {
				$currentUrl = '#CURRENT_URL#';
			}
			?>
				<a href="<?= $arParams['PATH_TO_AUTHORIZE'] ?>?login=yes&backurl=<?= $currentUrl; ?>">
					<?= GetMessage('TSB1_LOGIN') ?>
				</a>
			<?
			if ($arParams['SHOW_REGISTRATION'] === 'Y')
			{
			?>
				<a href="<?= $arParams['PATH_TO_REGISTER'] ?>?register=yes&backurl=<?= $currentUrl; ?>">
					<?= GetMessage('TSB1_REGISTER') ?>
				</a>
				<?
			}
				?>
			<?
			endif ?>
		</div>
	</div>
<?
endif ?>
<a class="b1_a5" href="<?= $arParams['PATH_TO_BASKET'] ?>">
	<div class="b1_w1-1">
		<div class="b1_w1-1-1">
			<?
			/*=$arResult['NUM_PRODUCTS']*/ ?>
			<?= $arResult['TOTAL_QUANTITY'] ?>
		</div>
	</div>
	<div class="b1_w1-2">
		<?= str_replace(" руб", "", $arResult['TOTAL_PRICE']) ?> <span class="b1_w1-2-1">&#x20bd;</span>
	</div>
</a>


