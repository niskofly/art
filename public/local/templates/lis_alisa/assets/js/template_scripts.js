$(function() {
	// Летающая шапка
	$(window).scroll(function() {
		if ($(this).scrollTop() > 1) {
			$('.site__header').addClass('sticky');
		} else {
			$('.site__header').removeClass('sticky');
		}
	});
});
