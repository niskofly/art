function check_captcha(context) {
	let result;

	if (context.find('input[name=captcha_sid]').length > 0) {
		$.ajax({
			method: 'POST',
			url: '/local/ajax/forms/captcha.php',
			dataType: 'json',
			async: false,
			data: {
				captcha_sid: context.find('input[name=captcha_sid]').val(),
				captcha_word: context.find('input[name=captcha_word]').val()
			},
			complete: function(data) {
				let captcha_result = JSON.parse(data.responseText);
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
	let autofill = $('*[data-autofill]');
	$.each(autofill, function(index, value) {
		let val = $(value).val();
		if (val.indexOf('PAGE_') !== -1) {
			val = val.replace('PAGE_', '');
			if (val == 'CURRENT') {
				$(autofill[index]).val(window.location.href);
			}
		} else if (val.indexOf('SEL_') !== -1) {
			val = val.replace('SEL_', '');
			val = val.replace('_', ' ');
			$(value).val($(val).text());
		} else if (val.indexOf('CLASS_') !== -1) {
			val = val.replace('CLASS_', '');
			val = val.replace('_', ' ');
			$(value).val($('.' + val).text());
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

$(function() {
	//
	//  присваивать переменной значение не done а success
	//  Почитать о событиях, особенно before.
	//  Обязательно событие errror - почитать какие есть статусы
	//

	//подключение маски для проверки и валидации телефона
	//phone_mask указать в параметре телефона
	var mask_elem = [];
	let mask = $('.ajax-form input[phone_mask], .ajax-form input[email_mask]');
	if (mask.length) {
		//если есть поля то обрабатываем
		mask.each(function(ind, el) {
			let phone_m = '+7(999) 999-99-99',
					email_m =
							'*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]',
					m = '';
			if (el.hasAttribute('phone_mask')) {
				$(el).inputmask(phone_m, {
					onKeyValidation: function(key, result) {
						//валидация при вводе
						let el = $(this);
						if ($(this).inputmask('isComplete')) {
							//проверка валидации поля
							el.removeClass('error');
							//console.log(ind,mask_elem[ind])
						} else {
							el.addClass('error'); //установка класса ошибки валидации
						}
					}
				});
			} else if (el.hasAttribute('email_mask')) {
				let inp = $(el).inputmask({
					alias: 'email',
					onKeyValidation: function(key, result) {
						//валидация при вводе
						console.log(this);
						let el = $(this);
						if (el.val().length) {
							if (el.inputmask('isComplete')) {
								//проверка
								// валидации поля
								el.removeClass('error');
							} else {
								el.addClass('error'); //установка класса ошибки валидации
							}
						}
					},
					onBeforePaste: function(pastedValue, opts) {
						var processedValue = pastedValue;
						let el = $(this.el);
						el.val(pastedValue);
						if (processedValue.length) {
							if (el.inputmask('isComplete')) {
								//проверка
								// валидации поля
								el.removeClass('error');
							} else {
								el.addClass('error'); //установка класса ошибки валидации
							}
						}
						return processedValue;
					}
				});
			}
			let i = $(el);
			mask_elem[ind] = {el: i}; //добавляем в стек поле
		});
	}

	$(document).on('submit', '.ajax-form', function(e) {
		e.preventDefault();
		if (mask_elem.length) {
			//проверка валидации добавленных полей
			for (let i in mask_elem) {
				if (!mask_elem[i].el.inputmask('isComplete')) {
					//если одно из полей не валидно
					let val = mask_elem[i].el.val();
					//console.log(mask_elem[i].el,mask_elem[i].el.is(':required'),val.length)
					if (!mask_elem[i].el.is(':required') && val.length == 0) {
						continue;
					}
					mask_elem[i].el.focus(); //то фокус на него
					console.log(mask_elem[i].el.val());
					return false; //и отменяем отправку
				}
			}
		}

		// yaCounter9459943.reachGoal('BACK_CALL');

		let form_container = $(this).closest('.form-container');
		let message_block = form_container.find('.message');
		let placeholder_block = form_container.find('.placeholder');
		let form = form_container.find('form');
		let ajax_file = form.attr('action');

		let need_check = form_container.find('[check]');
		let sending_allowed = true;

		$.each(need_check, function(index, value) {
			let type = $(value).attr('check');
			let data = $(value).val();

			if (!check_data(type, data)) {
				sending_allowed = false;
				return false;
			}
		});

		if (!sending_allowed) {
			alert('Ссылки и теги использовать нельзя');
		} else if (!check_captcha($(this))) {
			alert('Вы не заполнили капчу');
		} else {
			autofill();

			let data_form = new FormData(this); //для отправки файлов

			form.hide();
			placeholder_block.show();

			$('html, body').animate(
					{scrollTop: form_container.offset().top - 30},
					600
			);

			$.ajax({
				method: 'POST',
				url: ajax_file,
				dataType: 'json',
				context: form_container,
				dataType: 'json',
				//для отправки файлов
				// отключаем обработку передаваемых данных, пусть передаются как есть
				processData: false,
				//для отправки файлов
				// отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
				contentType: false,
				data: data_form,
				success: function(data) {
					message_block.text(data['message']);
					setTimeout(function() {
						placeholder_block.hide();
						message_block.show();
					}, 3000);
				},
				error: function(response) {
					$('#result #error').show();
					setTimeout('$("#result #error").hide()', 5000);
				}
			});
		}
	});
});
