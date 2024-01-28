(function ($) {
	$(function () {
		let tabs = $(".tabs");
		let tabs_nav = tabs.find(".tabs__nav");
		let tabs_pane = tabs.find(".tabs__pane");

		tabs_nav.on(
			"click",
			".tabs__nav-item:not(.tabs__nav-item--active)",
			function () {
				$(this)
					.addClass("tabs__nav-item--active")
					.siblings()
					.removeClass("tabs__nav-item--active");
				tabs_pane
					.removeClass("tabs__pane--show")
					.eq($(this).index())
					.addClass("tabs__pane--show");
			},
		);
	});
})(jQuery);
