$(function () {
	let top_slider_options = {
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		dots: true,
		loop: true,
		autoHeight: true,
		loadedClass: "",
		responsive: {
			0: {
				nav: false,
				items: 1,
			},
			768: {
				nav: true,
				items: 1,
			},
		},
		onInitialize: initialized_top_slider,
	};

	function initialized_top_slider(e, d, t) {
		$(e.target).addClass("list top-slider-upload");
		setTimeout(function () {
			$(e.target)
				.parents(".main-slider")
				.find(".top-slider-placeholder")
				.css("display", "none");
			$(e.target).removeClass("top-slider-upload");
		}, 500);
	}

	let simple_slider_options = {
		nav: true,
		responsive: {
			0: {
				items: 3,
				margin: 1,
				nav: false,
			},
			768: {
				items: 4,
				margin: 10,
			},
			1024: {
				items: 5,
			},
		},
	};
	let slider_one_img_options = {
		nav: false,
		items: 1,
		loop: true,
		dots: true,
		autoplay: true,
		autoplayHoverPause: true,
		smartSpeed: 1000,
		responsive: {},
	};
	let portfolio_options = {
		responsive: {
			0: {
				items: 2,
			},
			768: {
				items: 3,
			},
			1024: {
				nav: true,
				items: 4,
			},
		},
	};
	let promo_options = {
		responsive: {
			0: {
				items: 2,
			},
			768: {
				items: 3,
			},
			1024: {
				nav: true,
				items: 3,
			},
		},
	};
	let specialists_options = {
		// responsive: {
		// 	0:{
		//            items:1,
		//        },
		//        500:{
		//            items:2,
		//            margin: 80,
		//        },
		//        1024:{
		//            items:5,
		//        },
		//        1920:{
		//            items:6,
		//        }
		// }
	};
	let video_options = {
		margin: 0,
		responsive: {
			0: {
				items: 1,
			},
			1024: {
				nav: true,
				items: 2,
			},
			1280: {
				nav: true,
				items: 1,
			},
		},
	};
	let instagram_options = {
		// responsive: {
		// 	0:{
		//            items:1,
		//        },
		//        500:{
		//            items:2,
		//        },
		//        768:{
		//            items:4,
		//        }
		// }
	};

	initOwl(".top-slider.owl-container", top_slider_options);
	initOwl(".simple_slider", simple_slider_options);
	initOwl(".slider_one_img", slider_one_img_options);
	initOwl(".instagram", instagram_options);
	initOwl(".videos", video_options, 768);
	initOwl(".specialists", specialists_options);
	initOwl(".portfolio", portfolio_options);
	initOwl(".promo", promo_options);
});

// function destroyOwl( css_selector, width ) {

//  	let slider_container = $(css_selector);
//     let slider = slider_container.find('.owl-carousel');

// 	if($(window).width() < width ){
// 	    owlProjects.trigger('destroy.owl.carousel');
// 	}
// }

function initOwl(css_selector, castom_options = false, width_from = 0) {
	if ($(window).width() < width_from) return;

	let slider_container = $(css_selector);
	let slider = slider_container.find(".owl-carousel");
	let options = {
		margin: 10,
		loop: false,
		nav: false,
		navText: ["<div></div>", "<div></div>"],
		dots: false,
		smartSpeed: 1000,
		items: 1,
		responsive: {
			0: {
				items: 2,
			},
			768: {
				items: 3,
			},
			1024: {
				nav: true,
				items: 5,
			},
		},
	};

	if (castom_options) {
		$.extend(options, castom_options);
	}
	// console.log(css_selector);
	//   	console.log( options );

	slider.owlCarousel(options);

	slider_container.find(".owl-next-castom").on("click", function () {
		slider.trigger("next.owl.carousel");
	});
	$(".owl-prev-castom").on("click", function () {
		slider.trigger("prev.owl.carousel");
	});

	/*
	 */
}
