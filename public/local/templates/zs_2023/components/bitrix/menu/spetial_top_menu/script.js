$(function () {
	var nav = priorityNav.init({
		mainNavWrapper: ".special-top-menu", // mainnav wrapper selector (must be direct parent from mainNav)
		mainNav: ".special-top-menu__list", // mainnav selector. (must be inline-block)
		navDropdownClassName: "nav__dropdown", // class used for the dropdown.
		navDropdownToggleClassName: "nav__dropdown-toggle", // class used for the dropdown toggle.
		navDropdownLabel: "...",
		navDropdownBreakpointLabel: '<div class="hamburger"><div class="nav-icon"><span></span><span></span><span></span></div></div>',
		breakPoint: 1200,
	});
/*	let items = $(".header__menu").find(".special-top-menu__item--parent");
	items.on("click", function () {
		let that = this;
		$(".special-top-menu__item--parent.special-top-menu__item--parent--show-sub-menu").each(function () {
			if (that != this) {
				$(this).removeClass("show_sub_menu");
			}
		});
		$(this).toggleClass("show_sub_menu");
	});
	$(".special-top-menu .nav__dropdown-toggle").on("click", function () {
		$(".special-top-menu__item--parent.special-top-menu__item--parent--show-sub-menu").removeClass(
			"show_sub_menu",
		);
	});*/
	/*items.hover(function () {
			$(this).find('.multilevel-nav__sublevel').fadeIn();
	}, function () {
			$(this).find('.multilevel-nav__sublevel').fadeOut();
	});*/
});
