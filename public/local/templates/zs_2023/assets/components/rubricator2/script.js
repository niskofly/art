$(function () {
	$("#rubricator_search2").on("keyup", function () {
		let filter = $(this).val();
		getRubricator2(filter);
	});
});

function getRubricator2(filter) {
	$.ajax({
		method: "POST",
		url: document.location.pathname,
		data: { rubricator_filter: filter },
		success: function (data) {
			let list_html = $(data).find("#rubricator_container").html();
			let container = $("#rubricator_container");
			container.empty();
			container.append(list_html);
		},
		error: function (response) {
			console.log(response);
		},
	});
}
