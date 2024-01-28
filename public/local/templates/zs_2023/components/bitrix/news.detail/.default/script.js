$(function () {
	$(".present-slider__big").slick({
		// lazyLoad: 'ondemand',
		// autoplay: true,
		autoplaySpeed: 5000,
		speed: 1000,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		// fade: true,
		asNavFor: ".present-slider__thumbs-list",
	});
	$(".present-slider__thumbs-list").slick({
		// mobileFirst:true,
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: ".present-slider__big",
		centerMode: true,
		centerPadding: "1px",
		focusOnSelect: true,
		arrows: false,
		responsive: [
			{
				breakpoint: 1439,
				settings: {
					slidesToShow: 4,
				},
			},
			{
				breakpoint: 400,
				settings: {
					slidesToShow: 3,
				},
			},
		],
	});
});
