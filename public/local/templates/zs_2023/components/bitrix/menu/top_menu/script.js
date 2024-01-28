$(function () {
	$(".js-top-nav-button").on("click", function () {
		let top_nav = $("#top-nav");
		let height =
			"calc( 100vh - " + $(".site-header_top-row").outerHeight() + "px )";
		$(this).toggleClass("active");

		if (!$(this).hasClass("active")) {
			top_nav.css("height", "0");
		} else {
			top_nav.css("height", height);
		}
	});
});
