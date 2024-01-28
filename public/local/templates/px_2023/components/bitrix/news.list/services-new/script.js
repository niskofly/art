function closeSectionNav(rootContainer) {
	rootContainer.find(".show").removeClass("show");
}

$(function () {
	const rootContainer = $(".services-nav");
	const button = rootContainer.find(".js_show_nav");
	const navContainer = rootContainer.find(".services-nav__root-container");
	const navList = navContainer.find(".js_nav_list");
	const navParents = navContainer.find(".js-parent");

	button.on("click", function (e) {
		e.preventDefault();
		navContainer.toggleClass("show");
	});

	navList.on("click", ".js-show-items", function (e) {
		e.preventDefault();

		const item = $(this).closest(".js-parent");

		if (item.hasClass("show") === false) {
			navList.find(".show").removeClass("show");
		}
		item.toggleClass("show");
	});

	rootContainer.on("click", ".js_close", function () {
		closeSectionNav(rootContainer);
	});

	$(document).on("mouseup", function (e) {
		if (
			!rootContainer.is(e.target) &&
			rootContainer.has(e.target).length === 0
		) {
			closeSectionNav(rootContainer);
		}
	});

});
