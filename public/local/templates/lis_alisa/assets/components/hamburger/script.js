$(function() {
	$('.js-button').click(function() {
		$(this).toggleClass('active');
	});

	/* TODO реализовать пошаговую анивмацию
			$('.js-button').click(function(){
					let button = $(this);
					if ( $(this).hasClass('active') )
					{
							button.toggleClass('active process-close');
							setTimeout(function () {
									button.removeClass('process-close')
							}, 2000);
					}
					else {
							button.addClass('process-active');
							setTimeout(() => {
									button.toggleClass('process-active active')
							}, 2000);
					}

					$(this).toggleClass('active');
			});
			*/
});
