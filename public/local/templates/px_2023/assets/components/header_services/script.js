document.addEventListener("DOMContentLoaded", () => {
	function ajaxTabMenu() {
		//инициализация скролл бара
		function activeBar() {
			$(".tab-menu-scroll").mCustomScrollbar({
				scrollButtons: {
					enable: true,
					scrollType: "continuous",
					scrollSpeed: 10,
					scrollAmount: 40,
				},
			});
		}

		const servicesBtns = document.querySelectorAll(".tab-menu__arrow");

		servicesBtns.forEach((servicesBtn) => {
			servicesBtn.addEventListener("click", (e) => {
				e.preventDefault();

				let parentTarget = e.target.closest(".tab-menu__btn");
				let menuContainer = document.getElementById("services-content");
				let block_id = +servicesBtn.getAttribute("data-id");
				let section_id;

				const path =
					"/local/templates/px_2023/assets/components/header_services/ajax.php";

				if (block_id === 33) {
					section_id = 120;
				} else {
					section_id = 74;
				}

				let stuff = {
					block_id: block_id,
					section_id: section_id,
				};

				const params = new URLSearchParams(stuff).toString();

				fetch(path, {
					method: "POST",
					headers: {
						"Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
					},
					body: params,
				})
					.then((response) => response.text())
					.then((result) => {
						if (parentTarget.classList.contains("active")) {
							parentTarget.classList.remove("active");
							menuContainer.classList.remove("show");
						} else {
							servicesBtns.forEach((servicesBtn) => {
								if (
									servicesBtn
										.closest(".tab-menu__btn")
										.classList.contains("active")
								) {
									servicesBtn
										.closest(".tab-menu__btn")
										.classList.remove("active");
								}
							});
							parentTarget.classList.add("active");
							menuContainer.innerHTML = result;
							menuContainer.classList.add("show");
						}

						function reloadTabMenu() {
							const tabItems = document.querySelectorAll(".tab-menu__item");
							let menuContainer = document.querySelector(".tab-menu__wrapper");

							tabItems.forEach((tabItem) => {
								tabItem.addEventListener("click", (e) => {
									section_id = +e.target.getAttribute("data-section-id");
									block_id = +e.target.getAttribute("data-iblock-id");

									const path =
										"/local/templates/px_2023/assets/components/header_services/submenu.php";

									let stuff = {
										block_id: block_id,
										section_id: section_id,
									};

									let params = new URLSearchParams(stuff).toString();

									if (window.innerWidth > 1000) {

									}


									function insertAfter(newNode, existingNode) {
										existingNode.parentNode.insertBefore(
											newNode,
											existingNode.nextSibling,
										);
									}

									fetch(path, {
										method: "POST",
										headers: {
											"Content-type":
												"application/x-www-form-urlencoded; charset=UTF-8",
										},
										body: params,
									})
										.then((response) => response.text())
										.then((result) => {
											menuContainer.innerHTML = result;

										if (window.innerWidth < 1000) {
											e.target.nextElementSibling.insertBefore(
													menuContainer,
													e.target.nextElementSibling.children[0],
											);
										}


											if (e.target.classList.contains("active")) {
												e.target.classList.remove("active");
											} else {
												tabItems.forEach((tabItem) => {
													if (tabItem.classList.contains("active")) {
														tabItem.classList.remove("active");
													}
												});
												e.target.classList.add("active");
											}

											const closeTabMenu = document.querySelector(
												".tab-menu__section-close",
											);
											closeTabMenu.addEventListener("click", () => {
												closeServ();
											});
										});
								});
							});
						}

						reloadTabMenu();

						//функция закрытия Меню услуг

						function closeServ() {
							menuContainer.classList.remove("show");
							servicesBtns.forEach((servicesBtn) => {
								servicesBtn
									.closest(".tab-menu__btn")
									.classList.remove("active");
							});
						}

						//Закрываем меню по клавише и кнопке

						const closeTabMenu = document.querySelector(
							".tab-menu__section-close",
						);

						closeTabMenu.addEventListener("click", () => {
							closeServ();
						});

						window.onkeydown = function (event) {
							if (event.keyCode == 27) {
								closeServ();
							}
						};

						if (window.innerWidth > 1000) {
							activeBar();
						}
					});
			});
		});
	}

	ajaxTabMenu();
});
