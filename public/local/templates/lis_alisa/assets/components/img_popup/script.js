document.addEventListener('DOMContentLoaded', function() {
	// let elements = document.getElementsByClassName('lightgallery');
	//
	// for (let i = 0; i < elements.length; i += 1) {
	//     console.log(elements[i]);
	//     elements[i].lightGallery();
	// }
	//
	//
	//
	$(function() {
		$('.img-popup').click(function(event) {
			var i_path = $(this).attr('src');
			$('body').append(
					'<div id="overlay"></div><div class="magnify" id="magnify"><div class="magnify__content"><img src="' +
					i_path +
					'"></div><div id="close-popup"><i></i></div></div>'
			);
			$('#magnify').css({
				left: ($(document).width() - $('#magnify').outerWidth()) / 2,
				// top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
				top: ($(window).height() - $('#magnify').outerHeight()) / 2
			});
			$('#overlay, #magnify').fadeIn('fast');
		});

		$('body').on('click', '#close-popup, #overlay', function(event) {
			event.preventDefault();

			$('#overlay, #magnify').fadeOut('fast', function() {
				$('#close-popup, #magnify, #overlay').remove();
			});
		});
	});
});
