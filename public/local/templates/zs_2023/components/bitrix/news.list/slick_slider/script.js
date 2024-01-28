$(function () {
	let photos_slider = $(".photos__list.slick");

	photos_slider.slick({
		centerMode: true,
		centerPadding: "60px",
		arrows: false,
		dots: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		responsive: [
			{
				breakpoint: 700,
				settings: {
					centerMode: false,
					centerPadding: false,
					slidesToShow: 2,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 1100,
				settings: {
					centerMode: false,
					centerPadding: false,
					slidesToShow: 3,
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 1670,
				settings: {
					centerMode: false,
					centerPadding: false,
					slidesToShow: 4,
					slidesToScroll: 1,
				},
			},
		],
	});

	// Пример синхронизации двух слайдеров
	/*
							$('.slider-for').slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									arrows: false,
									fade: true,
									asNavFor: '.slider-nav'
							});
							$('.slider-nav').slick({
									slidesToShow: 3,
									slidesToScroll: 1,
									asNavFor: '.slider-for',
									dots: true,
									centerMode: true,
									focusOnSelect: true
							});

			*/
});
