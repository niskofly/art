$(document).ready(function () {
	let cont = $("footer") || $("body");
	let upBtn = $("<div>", {
		class: "up_scroll_site",
		click: function () {
			$("html, body").animate(
				{
					scrollTop: 0,
				},
				300,
			);
		},
	}); //<div class="up"></div>
	cont.append(upBtn);
	//кнопка вверх
	$(window).scroll(function () {
		if ($(window).scrollTop() > $(window).height()) upBtn.fadeIn();
		else upBtn.fadeOut();
		let f = $("footer").offset();
		if (typeof f !== "undefined") {
			if (f.top - $(window).scrollTop() - $(window).height() < 0)
				upBtn.addClass("fixed");
			else upBtn.removeClass("fixed");
		}
	});
});
