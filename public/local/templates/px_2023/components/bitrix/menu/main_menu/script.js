/*
 * Улучшить,  вынести настройки типа исключений, root и тп в единый интерфейс
 *
 * */

$(function () {
	let root = $("body");
	let top_menu_button = $(".js-show-nav");

	top_menu_button.on("click", function () {
		toggleNav(root);
	});

	$(document).on("click", ".show-nav", function (e) {
		let header = $(".site__header");
		if (
			!header.is(e.target) && // если клик был не по нашему блоку
			header.has(e.target).length === 0 && // и не по его дочерним элементам
			!top_menu_button.is(e.target) && // и если клик был не по кнопке
			top_menu_button.has(e.target).length === 0 // и не по её дочерним элементам
		) {
			toggleNav(root);
		}
	});
});

function toggleNav(root) {
	root.toggleClass("show-nav");
}
