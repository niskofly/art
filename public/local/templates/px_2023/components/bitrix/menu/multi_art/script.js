document.addEventListener("DOMContentLoaded", () => {
	function multiMenu() {
		const firstParents = document.querySelectorAll(
			".multilevel-nav__item--first-parent"
		);


		firstParents.forEach((firstItem) => {
			let firstTrigger = firstItem.querySelector(".menu-left__arrow");

			firstTrigger.addEventListener('click', () =>{
				let secondParents = firstItem.querySelectorAll('.multilevel-nav__item--second-parent');
				console.log(firstItem)
			})


			firstTrigger.addEventListener("click", (e) => {
				e.preventDefault(firstTrigger);

				let thisItemParent = multuUse.closest(".multilevel-nav__item--second-parent");

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
