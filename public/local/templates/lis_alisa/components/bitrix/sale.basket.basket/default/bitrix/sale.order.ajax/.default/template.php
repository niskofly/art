<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

$signer = new Main\Security\Sign\Signer();
$signedParams = $signer->sign(
	base64_encode(serialize($arParams)),
	'sale.order.ajax'
);
Asset::getInstance()->addJs(
	"/local/vendors/Inputmask-5.x_2/dist/jquery.inputmask.min.js"
);
if (strlen($request->get('ORDER_ID')) > 0) {
	include(Main\Application::getDocumentRoot() . $templateFolder . '/confirm.php');
} else {
	?>
	<div id="message_pre_order"></div>
	<form action="/local/ajax/pre_order_form.php" method="POST" name="ORDER_FORM"
		  id="bx-soa-order-form" enctype="multipart/form-data">
		<?
		echo bitrix_sessid_post();

		if (strlen($arResult['PREPAY_ADIT_FIELDS']) > 0) {
			echo $arResult['PREPAY_ADIT_FIELDS'];
		}
		//echo "<pre>".print_r($arResult)."</pre>";
		?>
		<input type="hidden" name="<?= $arParams['ACTION_VARIABLE'] ?>"
			   value="saveOrderAjax">
		<input type="hidden" name="location_type" value="code">
		<input type="hidden" name="BUYER_STORE" id="BUYER_STORE"
			   value="<?= $arResult['BUYER_STORE'] ?>">
		<input type="hidden" name="signedParamsString"
			   value='<?= CUtil::JSEscape($signedParams) ?>'>
		<input type="hidden" name="PERSON_TYPE" value="1">
		<input type="hidden" name="via_ajax" value="Y">
		<input type="hidden" name="SITE_ID" value="s1">
		<input type="hidden" name="ONCLICK" value="1">

		<div id="bx-soa-order" class="row bx-blue">
			<!--	MAIN BLOCK	-->
			<!--	SIDEBAR BLOCK	-->
			<div id="bx-soa-properties" data-visited="true"
				 class="bx-soa-section bx-active bx-selected">
				<div id="bx-soa-main-notifications">
					<div class="alert alert-danger" style="display:none"></div>
					<div data-type="informer" style="display:none"></div>
				</div>
				<div class="bx-soa-section-title-container">
					<h2 class="bx-soa-section-title col-sm-9">
						<span class="bx-soa-section-title-count"></span>Покупатель
					</h2>
				</div>

				<div class="bx-soa-section-content container-fluid">
					<div class="alert alert-danger" style="display: none"></div>
					<div class="row">
						<div class="col-sm-12 bx-soa-customer">
							<?
							foreach (
								$arResult["JS_DATA"]["ORDER_PROP"]["properties"] as
								$prop
							) {
								//pre($prop);
								$prop_code = strtolower($prop["CODE"]);
								if ($prop["TYPE"] == "STRING") {
									?>
									<div class="form-group bx-soa-customer-field"
										 data-property-id-row="<?= $prop["ID"] ?>">
										<label for="soa-property-<?= $prop_code ?>"
											   class="bx-soa-custom-label">
											<?
											if ($prop["REQUIRED"] == "Y") {
												?>
												<span class="bx-authform-starrequired">*</span><?
											} ?> <?= $prop["NAME"] ?>
										</label>
										<div class="soa-property-container">
											<input <?= ($prop["REQUIRED"] == "Y"
												? "required" : "") ?> type="text"
																	  size="30"
																	  name="ORDER_PROP_<?= $prop["ID"] ?>"
																	  id="soa-property-<?= $prop_code ?>"
																	  autocomplete="name"
																	  placeholder=""
																	  class="form-control
                                        bx-soa-customer-input
                                        bx-ios-fix"
																	  value="<?= $prop["VALUE"][0] ?>">
										</div>
									</div>
									<?
								} elseif ($prop["TYPE"] == "Y/N") {
									?>
									<div class="form-group bx-soa-customer-field"
										 data-property-id-row="<?= $prop["ID"] ?>">
										<label for="soa-property-<?= $prop_code ?>"
											   class="bx-soa-custom-label">
											<?
											if ($prop["REQUIRED"] == "Y") {
												?>
												<span class="bx-authform-starrequired">*</span><?
											} ?> <?= $prop["NAME"] ?>
										</label>
										<div class="soa-property-container">
											<input type="checkbox"
												   name="ORDER_PROP_<?= $prop["ID"] ?>"
												   value="Y">
										</div>
									</div>

									<?
								}
							}
							?>
							<div class="form-group bx-soa-customer-field">
								<div class="form-group bx-soa-customer-field bx-soa-customer-description">
									<label for="orderDescription"
										   class="bx-soa-customer-label">Комментарий:</label>
									<textarea id="orderDescription" cols="4"
											  class="form-control bx-soa-customer-textarea bx-ios-fix"
											  name="ORDER_DESCRIPTION"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row bx-soa-more">
						<div class="bx-soa-more-btn col-xs-12">
							<button class="button_red" type="submit">
								Отправить заказ
							</button>
						</div>
					</div>
				</div>
			</div>


		</div>
	</form>
	<script>
			let f = $('#bx-soa-order-form');
			var mask_elem = [];
			f.submit(function() {
				if (mask_elem.length) {//проверка валидации добавленных полей
					for (let i in mask_elem) {
						if (!mask_elem[i].valid) {//если одно из полей не валидно
							let val = mask_elem[i].el.val();
							if (!mask_elem[i].el.is(':required') && val.length == 0) {
								continue;
							}
							mask_elem[i].el.focus();//то фокус на него
							//console.log(mask_elem[i].el.val());
							return false;//и отменяем отправку
						}
					}
				}
				let ob = $(this),
						ajax_file = '/bitrix/components/bitrix/sale.order.ajax/ajax.php',//ob.prop("action"),
						data = ob.serialize(),
						key = ob.find('input[type=\'submit\']');
				key.prop('disabled', 'disabled');
				$('#bx-soa-main-notifications .alert-dange').hide();

				$.ajax({
					method: 'POST',
					url: ajax_file,
					dataType: 'json',
					context: ob,
					data: data,
					contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
					success: function(data) {
						if (typeof data.order.ID != 'undefined' &&
								typeof data.order.REDIRECT_URL != 'undefined') {
							window.location = data.order.REDIRECT_URL;
							return;
							$('#message_pre_order').
									html(
											'Спасибо за заказ. Менеджер свяжется с вами в ближайшее время').
									removeClass('warning');
							ob.hide();
							return;
							$.ajax({
								url: data.order.REDIRECT_URL,
								context: $(this),
								success: function(data) {
									let cont = $(this).parent();
									$(this).remove();
									cont.append(data);
									window.complite_oneclick = true;
								}
							});
						} else {
							key.prop('disabled', '');

							//data.order.ERROR
							if (typeof data.order.ERROR != 'undefined') {
								let c = $('#bx-soa-main-notifications .alert-danger');
								c.empty();
								c.show();
								for (let i in data.order.ERROR) {
									for (let j in data.order.ERROR[i]) {
										c.append($('<div>', {text: data.order.ERROR[i][j]}));

									}
								}
							}
						}

					},
					error: function(response) {
						key.prop('disabled', '');
						$('#result #error').show();
						setTimeout('$("#result #error").hide()', 5000);
					}
				});
				return false;
			});
			mask_elem[0] = {el: $('#soa-property-phone'), valid: false};//добавляем в стек поле телефон
			mask_elem[1] = {el: $('#soa-property-email'), valid: false};//добавляем в стек поле email
			//console.log(mask_elem)
			mask_elem[0].el.inputmask('+7 (999) 999-99-99', {
				'onKeyValidation': function(key, result) {//валидация при вводе
					let el = $(this);
					//console.log(el.inputmask('isComplete'));
					if (el.inputmask('isComplete')) {//проверка валидации поля
						mask_elem[0].valid = true;
						el.removeClass('error');
					} else {
						mask_elem[0].valid = false;
						el.addClass('error');//установка класса ошибки валидации
					}
				}
			});
			if (mask_elem[0].el.inputmask('isComplete')) {
				mask_elem[0].valid = true;
			}
			mask_elem[1].el.inputmask(
					{
						alias: 'email',
						'onKeyValidation': function(key, result) {//валидация при вводе
							let el = $(this);
							if (el.val().length) {
								if ($(this).inputmask('isComplete')) {//проверка валидации поля
									mask_elem[1].valid = true;
									el.removeClass('error');
								} else {
									mask_elem[1].valid = false;
									el.addClass('error');//установка класса ошибки валидации
								}
							}
						}
					});
			if (mask_elem[1].el.inputmask('isComplete')) {
				mask_elem[1].valid = true;
			}
			let input = document.getElementById('soa-property-name_contact');//поля имя
			input.addEventListener('input', () => {
				input.value = auto_layout_keyboard(input.value);
			});

			function auto_layout_keyboard(str) {
				replacer = {
					'q': 'й', 'w': 'ц', 'e': 'у', 'r': 'к', 't': 'е', 'y': 'н', 'u': 'г',
					'i': 'ш', 'o': 'щ', 'p': 'з', '[': 'х', ']': 'ъ', 'a': 'ф', 's': 'ы',
					'd': 'в', 'f': 'а', 'g': 'п', 'h': 'р', 'j': 'о', 'k': 'л', 'l': 'д',
					';': 'ж', '\'': 'э', 'z': 'я', 'x': 'ч', 'c': 'с', 'v': 'м', 'b': 'и',
					'n': 'т', 'm': 'ь', ',': 'б', '.': 'ю', '/': '.'
				};

				return str.replace(/[A-z/,.;\'\]\[]/g, function(x) {
					return x == x.toLowerCase() ?
							replacer[x] :
							replacer[x.toLowerCase()].toUpperCase();
				});
			}

	</script>
	<?
} ?>
