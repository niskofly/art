/*!
 * Gridj v1.0.2 (https://gridj.ru)
 * Copyright 2023 The DjCo.ru Authors
 * Licensed under MIT (https://gitlab.com/Djas420/gridj/-/blob/main/LICENSE)
 */

document.addEventListener('DOMContentLoaded', () => {
	window.initGridJ = (settings) => {
		// Settings localStorage
		let gridjColumn = localStorage.getItem('gridj-column');
		if (!gridjColumn) {
			gridjColumn = 'false';
		}
		let gridjOutline = localStorage.getItem('gridj-outline');
		if (!gridjOutline) {
			gridjOutline = 'false';
		}
		let gridjBackground = localStorage.getItem('gridj-background');
		if (!gridjBackground) {
			gridjBackground = 'false';
		}

		// Generate media query
		let media = '';
		Object.keys(settings.media).forEach((el) => {
			let fix;
			if ('fix' in settings.media[el]) {
				fix = `
					width: ${settings.media[el].fix};
					left: calc((100vw - ${settings.media[el].fix}) / 2);
					`;
			}
			media += `
				@media(min-width: ${el}px) {
					.grid-dj {
						padding: ${settings.media[el].padding};
						gap: ${settings.media[el].gap};
						${!fix ? '' : fix}
					}
				}
			`;
		});

		// Generate style css
		const style = `
			<style class="grid-dj__style">
				.grid-dj {
					box-sizing: border-box;
					position: fixed;
					top: 0;
					bottom: 0;
					left: 0;
					width: 100vw;
					z-index: ${settings.zIndexGrid};
					display: flex;
					pointer-events: none;
					visibility: hidden;
				}
				.grid-dj_visible {
					visibility: visible;
				}
				.grid-dj__col {
					flex: auto;
					background-color: ${settings.bgColorColumns};
				}
				${media}
			</style>
		`;

		// Generate columns
		let vw = document.documentElement.clientWidth;
		const mw = Object.keys(settings.media);
		const col = () => {
			let column;
			for (let i = 0; i < mw.length; i += 1) {
				if (Number(mw[i]) <= Number(vw)) {
					column = settings.media[mw[i]].columns;
				} else {
					break;
				}
			}
			return column;
		};
		const columns = (c) => {
			let gridDjCol = '';
			for (let i = 0; i < c; i += 1) {
				gridDjCol += '<grid-dj__col class="grid-dj__col"></grid-dj__col>';
			}
			return gridDjCol;
		};

		// Generate columns HTML
		const gridColumns = `
			${style}
			<grid-dj class="grid-dj${(gridjColumn === 'true') ? ' grid-dj_visible' : ''}">
				${columns(col())}
			</grid-dj>
		`;
		document.querySelector(settings.insertGrid).insertAdjacentHTML('beforeend', gridColumns);

		// Resize windows
		window.addEventListener('resize', () => {
			vw = document.documentElement.clientWidth;
			document.getElementsByClassName('grid-dj')[0].innerHTML = columns(col());
		});

		// Generate random RGB
		function randomInteger() {
			return Math.floor(Math.random() * (256));
		}
		function randomRgbColor() {
			return [randomInteger(), randomInteger(), randomInteger()];
		}

		// Query elements
		const notElements = settings.notElements.length ? `${settings.notElements.join()}, ` : '';
		function allElement() {
			return document.querySelectorAll(`*:not(${notElements}html, head, head *, meta, link, style, script, .grid-dj, .grid-dj__col)`);
		}

		// show backgroundColor elements
		if (gridjOutline === 'true') {
			allElement().forEach((elem) => {
				const el = elem;
				el.style.outline = `1px solid rgb(${randomRgbColor()})`;
			});
		}
		// show outline elements
		if (gridjBackground === 'true') {
			allElement().forEach((elem) => {
				const el = elem;
				el.style.backgroundColor = `rgba(${randomRgbColor()}, ${settings.bgOpacity})`;
			});
		}

		// Events keydown
		let key = [];
		document.addEventListener('keydown', (event) => {
			if (event.key === 'Alt') {
				key = [];
				key.push('Alt');
			}
			if (event.code === 'KeyG') {
				if (key.includes('Alt')) {
					event.preventDefault();
					document.getElementsByClassName('grid-dj')[0].classList.toggle('grid-dj_visible');
					localStorage.setItem('gridj-column', (gridjColumn === 'true') ? 'false' : 'true');
				}
				key = [];
			}
			if (event.code === 'KeyO') {
				if (key.includes('Alt')) {
					event.preventDefault();
					gridjOutline = (gridjOutline === 'true') ? 'false' : 'true';
					localStorage.setItem('gridj-outline', gridjOutline);

					allElement().forEach((elem) => {
						const el = elem;
						if (gridjOutline === 'true') {
							el.style.outline = `1px solid rgb(${randomRgbColor()})`;
						} else {
							el.style.outline = '';
						}
					});
				}
				key = [];
			}
			if (event.code === 'KeyB') {
				if (key.includes('Alt')) {
					event.preventDefault();
					gridjBackground = (gridjBackground === 'true') ? 'false' : 'true';
					localStorage.setItem('gridj-background', gridjBackground);

					allElement().forEach((elem) => {
						const el = elem;
						if (gridjBackground === 'true') {
							el.style.backgroundColor = `rgba(${randomRgbColor()}, ${settings.bgOpacity})`;
						} else {
							el.style.backgroundColor = '';
						}
					});
				}
				key = [];
			}
		});
	};
}, false);
