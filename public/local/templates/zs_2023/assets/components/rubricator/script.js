$(function () {
	$("#rubricator_search").on("keyup", function () {
		let filter = {};
		filter.name = $(this).val();
		filter.section = $(this).data("section");
		getRubricator(filter);
	});
});

function getRubricator(filter = "") {
	let container = $("[data-ajax-content=rubricator]");

	$.ajax({
		method: "POST",
		url: "/local/templates/tpl_2021/assets/components/rubricator/ajax.php",
		// dataType: 'json',
		data: { filter: filter },
		context: container,
		success: function (data) {
			let container = $("#filter-content");
			console.log(data);
			container.empty();
			container.append(data);
		},
		error: function (response) {
			console.log(response);
		},
	});
}
