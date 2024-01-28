// eslint-disable-next-line camelcase
function checkCaptcha(context) {
	let result;

	if (context.find('input[name=captcha_sid]').length > 0) {
		$.ajax({
			method: 'POST',
			url: 'reload_captcha.php',
			dataType: 'json',
			async: false,
			data: {
				captcha_sid: context.find('input[name=captcha_sid]').val(),
				captcha_word: context.find('input[name=captcha_word]').val()
			},
			complete(data) {
				const captcha_result = JSON.parse(data.responseText);
				result = captcha_result.success;
				// console.log(result);
			}
		});
	} else {
		result = true;
	}
	return result;
}

function autofill() {
	const autofillElement = $('*[data-autofill]');
	$.each(autofillElement, (index, value) => {
		let val = $(value).val();
		if (val.indexOf('PAGE_') !== -1) {
			val = val.replace('PAGE_', '');
			if (val == 'CURRENT') {
				$(autofillElement[index]).val(window.location.href);
			}
		} else if (val.indexOf('TAG_') !== -1) {
			val = val.replace('TAG_', '');
			val = val.replace('_', ' ');
			$(value).val($(val).text());
		} else if (val.indexOf('CLASS_') !== -1) {
			val = val.replace('CLASS_', '');
			val = val.replace('_', ' ');
			$(value).val($(`.${val}`).text());
		}
	});
}

function check_data(type, data) {
	if (type == 'nohtml') {
		if (data.match(/https?:\/\//)) return false;
		if (data.match(/<[^>]+>/)) return false;
	}
	return true;
}

function serializeForm(formNode) {
	return formNode.serialize();
}

/** var jquery object cont */
function initForm(formContainer) {
	const mask_elem = [];
	const mask = formContainer.find(
			'.ajax-form input[phone_mask]'
	);
	if (mask.length) {
		// если есть поля то обрабатываем
		mask.each((ind, el) => {
			const phone_m = '+7(999) 999-99-99';
			let m = '';
			if (el.hasAttribute('phone_mask')) {
				m = phone_m;
			}
			mask_elem[ind] = {el: $(el), valid: false}; // добавляем в стек поле
			$(el).inputmask(m, {
				onKeyValidation(key, result) {
					// валидация при вводе
					const el = $(this);
					if ($(this).inputmask('isComplete')) {
						// проверка валидации поля
						mask_elem[ind].valid = true;
						el.removeClass('error');
					} else {
						mask_elem[ind].valid = false;
						el.addClass('error'); // установка класса ошибки валидации
					}
				},
				onBeforeMask(value, opts) {
					let processedValue = value;
					const el = $(this.el);
					if (this.el.hasAttribute('phone_mask')) {
						processedValue = value.replace(/^8/, '');
					}
					return processedValue;
				}
			});
			$(el).on('input', function(e) {
				const el = $(this);
				if (el.inputmask('isComplete')) {
					// проверка валидации поля
					mask_elem[ind].valid = true;
					el.removeClass('error');
				} else {
					mask_elem[ind].valid = false;
					el.addClass('error'); // установка класса ошибки валидации
				}
			});
		});
	}

	formContainer.on('submit', '.ajax-form', function(e) {
		e.preventDefault();
		if (mask_elem.length) {
			// проверка валидации добавленных полей
			for (const i in mask_elem) {
				if (!mask_elem[i].valid) {// валидность можно прверить так mask_elem[i].el.inputmask("isComplete"), флаг valid можно будет убрать
					// если одно из полей не валидно
					mask_elem[i].el.focus(); // то фокус на него
					return false; // и отменяем отправку
				}
			}
		}

		const messageBlock = formContainer.find('.message');
		const placeholderBlock = formContainer.find('.placeholder');
		const formBody = formContainer.find('form');
		const path = formBody.attr('action');
		// let ya_target = $(this).attr('form-ya_target');
		const need_check = formContainer.find('[check]');
		const sendingAllowed = true;

		if (!sendingAllowed) {
			alert('Ссылки и теги использовать нельзя');
		} else if (!checkCaptcha($(this))) {
			alert('Вы не заполнили капчу');
		} else {
			autofill();

			const dataForm = serializeForm($(this));

			formBody.hide();
			placeholderBlock.show();

			$('html, body').animate(
					{scrollTop: formContainer.offset().top - 30},
					600
			);

			const params = dataForm;

			fetch(path, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				},
				body: params
			}).then((response) => response.json()).then((result) => {
				setTimeout(() => {
					messageBlock.text(result.message).
							removeClass().
							addClass(`message ${result.type}`);
					placeholderBlock.hide();
					messageBlock.show();
				}, 3000);
			});
		}
	});
}

$(() => {
	initForm($('.form-container'));

	$('body').on('focus', '[phone_mask]', function() {
		$(this).inputmask({mask: '+7 (999) 999-9999'});
	});

	// $('body').on('submit', '.ajax-form', function (e) {
	// 	e.preventDefault();
	// 	const container = $(this).closest('.form-container');
	// 	initForm(container);
	// });

	//
	//  присваивать переменной значение не done а success
	//  Почитать о событиях, особенно before.
	//  Обязательно событие errror - почитать какие есть статусы
	//
});
