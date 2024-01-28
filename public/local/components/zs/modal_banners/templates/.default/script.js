let current = 0;
$(function () {
	zs_init_popup_banner();
	$(".zs-modal__close").on("click", zs_close_popup_banner);
});

function zs_init_popup_banner() {
	let modals = $(".zs-modal__item");
	let current_modal = $(modals[current]);
	let id = current_modal.attr("id");
	let ignore = current_modal.attr("data-ignore") == 1;
	if (current >= modals.length) {
		return false;
	}

	if (BX.getCookie(id) == "y" && !ignore) {
		++current;
		zs_init_popup_banner();
		return false;
	}

	let timeout_start = current_modal.attr("data-timeout") * 1000; // сек, Время от открытия страницы до появления
	setTimeout(zs_show_popup_banner, timeout_start);
}

function zs_show_popup_banner() {
	let modals = $(".zs-modal__item");
	let current_modal = $(modals[current]);
	let timeout_repeat = current_modal.attr("data-repeat"); // мин, Время до повтора в минутах было 720
	let time_fadeOut = current_modal.attr("data-fade"); // миллисек, время анимации затухания
	// let timeout_close = current_modal.attr('data-close'); // миллисек, время анимации затухания
	let id = current_modal.attr("id");
	let options = { path: "/", secure: false };

	// показываем всплываху
	current_modal.fadeIn(time_fadeOut).css("display", "flex");

	// Устанавливаем куки
	if (timeout_repeat) {
		BX.setCookie(id, "y", {
			expires: timeout_repeat * 60,
			path: "/",
			secure: false,
		});
	}

	// Тут надо подружить закрытие по таймеру и по кнопке
	// setTimeout( zs_close_popup_banner, timeout_close);
}

function zs_close_popup_banner() {
	let modals = $(".zs-modal__item");
	let current_modal = $(modals[current]);
	let time_fadeOut = current_modal.attr("data-fade"); // миллисек, время анимации затухания

	++current;
	current_modal.fadeOut(time_fadeOut);
	zs_init_popup_banner();
}

