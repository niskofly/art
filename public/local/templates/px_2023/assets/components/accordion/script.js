/*
Аккордион может скрывать блок полностью или частично

ToDo Переписать на чистый js
https://www.youtube.com/watch?v=G2-XO0Waj6g&t=441s

*/

$(function() {
	$('.accordion').each(function() {
		accordion_toggle($(this), true);
	});

	$('.accordion__button').on('click', function() {

		let accordion_id = $(this).data('accordionId');
		let context;

		if (typeof (accordion_id) === 'undefined') {
			context = $(this).closest('.accordion');
		} else {
			context = $('#' + accordion_id);
		}

		accordion_toggle(context);

		return false;
	});

});

function accordion_toggle(context, init = false) {

	let container = context;
	let wrapper = container.find('.accordion__wrapp-hide');
	let content_container = wrapper.find('.accordion__content');
	let show_items_num = container.attr('data-show-items');
	let real_content_height = content_container.innerHeight();
	let start_heigth = 0;
	let accordion_off = false;

	if (show_items_num !== undefined) {
		let all_items_num = content_container.find('.accordion__count-here').length;
		let items_container = content_container;

		if (all_items_num > 0) {
			items_container = content_container.find('.accordion__count-here');
		}

		let items = items_container.children();

		if (items_container.children().length <= show_items_num) {
			accordion_off = true;
		} else {
			$.each(items, function(index, element) {
				if (index >= show_items_num) return false;
				start_heigth += $(element).innerHeight();
			});
			container.find('.accordion__buttons').show();
		}

		console.log(accordion_off);
		console.log(start_heigth);

	} else if (real_content_height > 0) {
		container.find('.accordion__buttons').show();
	}

	let height = start_heigth;
	if (!init) {
		if (!container.hasClass('accordion--open')) {
			height = real_content_height;
		}
		container.toggleClass('accordion--open');
	}
	if (accordion_off) {
		wrapper.addClass('accordion_off');
	} else {
		wrapper.animate({height: height}, 500);
	}

}


