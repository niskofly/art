document.addEventListener('DOMContentLoaded', () => {

	const tabsVerticalBtn = document.querySelectorAll('.tabs-vertical__nav-item');
	const tabsVerticalItem = document.querySelectorAll('.tabs-vertical__item');

	function clearActive() {
		tabsVerticalBtn.forEach((el) => {
			if (el.classList.contains('active')) {
				el.classList.remove('active');
			}
		});

		tabsVerticalItem.forEach((el) => {
			if (el.classList.contains('active')) {
				el.classList.remove('active');
			}
		});
	}

	function btnEvent() {
		clearActive();
		const btnId = this.dataset.target;
		this.classList.add('active');
		document.querySelector(`#${btnId}`).classList.add('active');
	}

	tabsVerticalBtn.forEach((el) => {
		el.addEventListener('click', btnEvent);
	});

}, false);
