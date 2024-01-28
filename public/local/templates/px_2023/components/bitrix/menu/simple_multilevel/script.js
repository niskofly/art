document.addEventListener("DOMContentLoaded", () => {
	function multiMenu() {
		const muliItems = document.querySelectorAll(
			".multilevel-nav__item--parrent",
		);

		muliItems.forEach((muliItem) => {
			let multuUse = muliItem.querySelector(".multilevel-nav__use");

			if (window.innerWidth > 1000) {
				muliItem.addEventListener("mouseover", (event) => {
					muliItem.classList.add("open");
				});

				muliItem.addEventListener("mouseout", (event) => {
					muliItem.classList.remove("open");
				});
			}

			multuUse.addEventListener("click", (e) => {
				e.preventDefault(multuUse);

				let thisItemParent = multuUse.closest(".multilevel-nav__item--parrent");

				if (thisItemParent.classList.contains("open")) {
					thisItemParent.classList.remove("open");
					return;
				}

				muliItems.forEach((muliItem) => {
					muliItem.classList.remove("open");
				});

				thisItemParent.classList.add("open");
			});
		});
	}

	multiMenu();
});
