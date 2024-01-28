function modalClose(cont) {

	cont.addClass('zs-modal-popup--hide');

	setTimeout(() => {
		cont.remove();
	}, 1000);
}

function modalCreate(content, callback) {
	const text = $('<div>', { class: 'zs-modal-popup__text' }).append(content);
	const modal = $('<div>', {
		class: 'zs-modal-popup zs-modal-popup--hide',
	}).append(
		$('<div>', {
			class: 'zs-modal-popup__item',
		}).append(
			$('<div>', {
				class: 'zs-modal-popup__modalent',
				// css: { width: param.width || '' },
			})
				// .append($('<div>', { class: 'zs-modal-popup__close' }))
				.append(
					'<svg class="zs-modal-popup__close" className="icon header-content_menu-phone__popup-close">' +
					'<use xlink:href="'+SITE_TEMPLATE_PATH+'/assets/icons/sprite.svg#close"></use>' +
					'</svg>'
				)
				.append(text)
		)
	);

	$('body .site').append(modal);

	modal.find('.zs-modal-popup__close').click(() => {
		modalClose(modal);
	});
	if (typeof callback === 'function') {
		callback(text);
	}
	modal.removeClass('zs-modal-popup--hide');
	return modal;
}

function modalGet(e) {
	e.preventDefault();

	const type = this.dataset.type;
	const path = '/local/ajax/ajax_core.php';
	const params = new URLSearchParams(this.dataset).toString();

	fetch(path, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
		},
		body: params,
	})
		.then((response) => response.text())
		.then((result) => {
			modalCreate(result);

			if(type === 'form') {
				const container = $('.form-container');
				initForm(container);
			}

		});

	return false;
}

$(function () {

	$('.modal-button').on('click', modalGet);
	const cont = '.zs-modal-popup';
	const pop = '.zs-modal-popup__modalent';

	$(document).on('click', (event) => {
		if ($(event.target).closest(pop).length) return;
		modalClose($(cont));
		event.stopPropagation();
	});
});
