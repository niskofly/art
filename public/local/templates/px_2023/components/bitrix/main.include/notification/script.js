$(function () {
	let messageElement = $(".cookie-notification");
	let ya_code = messageElement.attr("data-ya");
	//initCounter(ya_code);
	// Если нет cookies, то показываем плашку
	if (BX.getCookie("agreement") === undefined) {
		setTimeout(showMessage(), 10000);
	} else if (BX.getCookie("agreement") === "Y") {
		initCounter(ya_code);
	}

	// Нажатие кнопки "Я согласен"
	$("#apply").on("click", function () {
		initCounter(ya_code);
		saveAnswer("Y");
		hideMessage();
	});
});

// Функция, которая показывает предупреждение
function showMessage() {
	let messageElement = $(".cookie-notification");
	//let ya_code = messageElement.attr('data-ya');
	messageElement.addClass("cookie-notification--show");
}

// Функция, которая прячет предупреждение
function hideMessage() {
	let messageElement = $(".cookie-notification");
	messageElement.removeClass("cookie-notification--show");
}

function saveAnswer(ageement) {
	let messageElement = $(".cookie-notification");
	// Прячем предупреждение
	hideMessage();
	// Ставим cookies
	BX.setCookie("agreement", ageement, { expires: 28800, path: "/" });
}

function initCounter(ya_code) {

}
