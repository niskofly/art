window.addEventListener('DOMContentLoaded', function() {
	const specialsSlider = new Swiper('.products-sections .swiper', {
		loop: false,
		navigation: {
			nextEl: '.products-sections .slider__arrow'
		},
		slidesPerView: 'auto',
		spaceBetween: 0,
		watchOverflow: !0
	});
});
