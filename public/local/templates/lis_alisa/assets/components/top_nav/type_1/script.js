$(function() {
	let top_menu = $('.site__general-nav');
	let top_menu_button = $('.header__menu-btn');

	top_menu_button.on('click', toggleNav);

	$(document).on('click', '.show-nav', function(e) {
		// событие клика по веб-документу
		if (
				!top_menu.is(e.target) && // если клик был не по нашему блоку
				top_menu.has(e.target).length === 0 &&
				!top_menu_button.is(e.target) &&
				top_menu_button.has(e.target).length === 0
		) {
			// и не по его дочерним элементам
			toggleNav(); // скрываем его
		}
	});
});

function toggleNav() {
	$('body').toggleClass('show-nav');
}
