function close_popup(cont) {
	cont.addClass("hide_popup");
	setTimeout(() => {
		cont.remove();
	}, 1000);
}

function create_cont_popup(context, param, callback) {
	const text = $("<div>", { class: "zs-modal-popup__text" }).append(context);
	const cont = $("<div>", {
		class: `zs-modal-popup hide_popup ${  param.width_style}`,
	}).append(
		$("<div>", {
			class: "zs-modal-popup__item",
		}).append(
			$("<div>", {
				class: "zs-modal-popup__content",
				css: { width: param.width || "" },
			})
				.append($("<div>", { class: "zs-modal-popup__close" }))
				.append(text),
		),
	);
	$("body .site").append(cont);
	cont.find(".zs-modal-popup__close").click(() => {
		close_popup(cont);
	});
	if (typeof callback === "function") {
		callback(text);
	}
	cont.removeClass("hide_popup");
	return cont;
}

function connect_key(e) {
	e.preventDefault();
	const key = $(this);
	const file = key.data("file");
	const ajax_file = file || "form_ajax.php";
	const param = {};
	param.width_style = key.data("width_style") || "narrow";
	param.width = key.data("width");
	const path = `/local/ajax/${  ajax_file}`;
	$.ajax({
		method: "POST",
		url: path,
		dataType: "html",
		// context: this,
		data: key.data(),
		success (d) {
			create_cont_popup(d, param, initForm);
		},
		error (response) {
			// $("#result #error").show();
			// setTimeout('$("#result #error").hide()', 5000);
		},
	});
	return false;
}

$(() => {
	$(".popup_form_key_js").on("click", connect_key);
	const cont = ".zs-modal-popup";
	const pop = ".zs-modal-popup__content";
	$(document).on('click',(event) => {
		if ($(event.target).closest(pop).length) return;
		close_popup($(cont));
		event.stopPropagation();
	});
});
