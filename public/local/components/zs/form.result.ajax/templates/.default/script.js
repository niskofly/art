/*****
 *
 *   Проверка капчи перенесена в файл аякса
 *
 *
 *****/

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
			$(autofill[index]).val($(val).text());
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

	need_check = $('.ajax-form[name=SIMPLE_FORM_4]').find('[check]');

	$(document).on('submit', '.ajax-form', function(e) {
		e.preventDefault();

		// yaCounter9459943.reachGoal('BACK_CALL');

		let form_container = $(this).closest('.form-container');
		let message_block = form_container.find('.message');
		let placeholder_block = form_container.find('.placeholder');
		let form = form_container.find('form');
		let ajax_file = form.attr('action');

		let need_check = form_container.find('[check]');
		let sending_allowed = true;

		console.log(need_check);

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
		}
				// else if ( !check_captcha( $(this) ) )
				// {
				// alert('Вы не заполнили капчу');
		// }
		else {
			autofill();

			let data_form = form.serialize();

			form.hide();
			placeholder_block.removeClass('hide');
			message_block.removeClass('warning').hide();

			$.ajax({
				method: 'POST',
				url: ajax_file,
				dataType: 'json',
				context: form_container,
				data: data_form,
				success: function(data) {
					message_block.text(data['message']);
					if (data['type'] === 'success') {
						setTimeout(function() {
							placeholder_block.addClass('hide');
							message_block.show();
						}, 3000);
					} else {
						setTimeout(function() {
							placeholder_block.addClass('hide');
							message_block.show();
							message_block.addClass(data['type']);
							form.show();
						}, 2000);
					}

				},
				error: function(response) {
					$('#result #error').show();
					setTimeout('$("#result #error").hide()', 5000);
				}
			});
		}

	});

});

