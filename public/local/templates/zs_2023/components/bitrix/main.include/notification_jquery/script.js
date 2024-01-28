$(function () {
	let messageElement = $(".cookie-notification");
	let ya_code = messageElement.attr("data-ya");

	// Если нет cookies, то показываем плашку
	if ($.cookie("agreement") === undefined) {
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

// Загружаем сам код счетчика сразу
(function (m, e, t, r, i, k, a) {
	m[i] =
		m[i] ||
		function () {
			(m[i].a = m[i].a || []).push(arguments);
		};
	m[i].l = 1 * new Date();
	(k = e.createElement(t)),
		(a = e.getElementsByTagName(t)[0]),
		(k.async = 1),
		(k.src = r),
		a.parentNode.insertBefore(k, a);
})(window, document, "script", "//mc.yandex.ru/metrika/tag.js", "ym");

// Функция, которая показывает предупреждение
function showMessage() {
	let messageElement = $(".cookie-notification");
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
	$.cookie("agreement", ageement, { expires: 28800, paht: "/" });
}

function initCounter(ya_code) {
	ym(ya_code, "init", {});
}
