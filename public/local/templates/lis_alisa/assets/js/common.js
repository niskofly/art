$(function() {
	/*
	Перенести в counters
	function yaCounterGoal(target) {
		yaCounter<ID метрики>.reachGoal(target);
	}
	*/

	$(function() {
		/* Есть места, например формы, в которых */
		$('[data-ya_target]').on('click', function() {
			yaCounterGoal($(this).attr('data-ya_target'));
		});
	});

	/* Мобильное меню и тп */
	let top_menu_button = $('#mob-nav-button');
	let top_menu = $('#mob-nav');
	top_menu_button.on('click', function() {
		top_menu.slideToggle();
	});
	$(document).on('mouseup', function(e) {
		// событие клика по веб-документу
		if (
				!top_menu.is(e.target) && // если клик был не по нашему блоку
				top_menu.has(e.target).length === 0 &&
				!top_menu_button.is(e.target) &&
				top_menu_button.has(e.target).length === 0
		) {
			// и не по его дочерним элементам
			top_menu.slideUp(); // скрываем его
		}
	});

	let header_services_button = $('#header-services-button');
	let header_services = $('#header-services');
	header_services_button.on('click', function() {
		header_services.slideToggle();
	});
	$(document).on('mouseup', function(e) {
		// событие клика по веб-документу
		if (
				!header_services.is(e.target) && // если клик был не по нашему блоку
				header_services.has(e.target).length === 0 &&
				!header_services_button.is(e.target) &&
				header_services_button.has(e.target).length === 0
		) {
			// и не по его дочерним элементам
			header_services.slideUp(); // скрываем его
		}
	});

	// Плавная прокрутка
	var margin = -50; // переменная для контроля докрутки
	$('a[href^=\'#\']').click(function() {
		// тут пишите условия, для всех ссылок или для конкретных
		$('html, body').animate(
				{
					scrollTop: $($(this).attr('href')).offset().top + margin + 'px' // .top+margin - ставьте минус, если хотите увеличить отступ
				},
				{
					duration: 1600, // тут можно контролировать скорость
					easing: 'swing'
				}
		);
		return false;
	});
});
