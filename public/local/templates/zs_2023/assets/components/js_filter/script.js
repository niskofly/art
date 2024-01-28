$(function () {
	init_js_filters();

	$(document).on("click", "[data-filter-selector]", function () {
		let container = $(this).closest(".js_filter");
		let target = $(this).data("filter-selector");
		show_js_filters(target, container);
	});
});

function init_js_filters() {
	$(".js_filter").each(function () {
		let target = $(this)
			.find("[data-filter-selector].active")
			.data("filter-selector");
		show_js_filters(target, $(this));
	});
}

function show_js_filters(target, context) {
	context.find("[data-filter-item]").hide();
	context.find("[data-filter-item=" + target + "]").show();
}
