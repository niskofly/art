$(function() {
	let items = $('#catalog-menu').find('.multilevel-nav__item--parrent');

	items.hover(
			function() {
				$(this).find('.multilevel-nav__sublevel').fadeIn();
			},
			function() {
				$(this).find('.multilevel-nav__sublevel').fadeOut();
			}
	);
});
