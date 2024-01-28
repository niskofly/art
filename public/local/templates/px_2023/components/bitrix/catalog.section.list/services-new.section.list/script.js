document.addEventListener("DOMContentLoaded", () => {

	let sections = document.querySelectorAll('.filter-sections');


	let elements = document.querySelectorAll('.default-list__item')


	let sectionFirst = document.querySelector('.filter-sections')

	sectionFirst.classList.add('active')

	sections.forEach((section) => {
		let activeSection = section.dataset.filter.toString()
		let elements = document.querySelectorAll('.default-list__item')

		if (section.classList.contains('active')){
			elements.forEach((elem) => {
				if(elem.dataset.section.toString().includes(activeSection)){
					elem.classList.add('active');
				}
			});
		}

		section.addEventListener('click', function(){

			elements.forEach((elem) =>{
				elem.classList.remove('active');
				section.classList.remove('active')
			})

			elements.forEach((elem) =>{

				if(elem.dataset.section.toString().includes(activeSection)){
					elem.classList.add('active')
					section.classList.add('active')
				}
			})
		})
	})
});
