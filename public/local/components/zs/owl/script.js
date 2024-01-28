const owl_param = [];

function initOwl(css_selector, custom_options = false) {
	const slider_container = $(css_selector);
	const slider_projects = slider_container.find('.owl-carousel');
	const par = slider_projects.data('owl_id');
	if (typeof par !== 'undefined' && typeof owl_param[par] !== 'undefined') {
		custom_options = owl_param[par];
	}
	const options = {
		items: 1
	};

	if (custom_options) {
		$.extend(options, custom_options);
	}

	slider_projects.owlCarousel(options);

	function initialized_slider(e, d, t) {
		$(e.target).addClass('owl-slider-upload');
		setTimeout(() => {
			$(e.target).
					parents('.main-slider').
					find('.owl-slider-placeholder').
					css('display', 'none');
			$(e.target).removeClass('owl-slider-upload');
		}, 5000);
	}

	/*
	slider_portfolio_projects.on('translate.owl.carousel', function(e) {
			active_old_id = $(this).find('.active [data-image]').attr('data-image');
	});
	slider_portfolio_projects.on('translated.owl.carousel', function(e) {
			active_new_id = $(this).find('.active [data-image]').attr('data-image');
			change_img();
	});
	$('.owl-next-2').on('click', function() {
			slider_portfolio_projects.trigger('next.owl.carousel');
	})
	$('.owl-prev-2').on('click', function() {
			slider_portfolio_projects.trigger('prev.owl.carousel');
	})

	function change_img(){
			$(active_old_id).removeClass('active');
			$(active_new_id).addClass('active');
	}
	*/
}

$(() => {
	$('.owl_container').each(function() {
		initOwl(this);
	});
});


