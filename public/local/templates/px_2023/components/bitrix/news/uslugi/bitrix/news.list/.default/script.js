document.addEventListener("DOMContentLoaded", () => {


	let sections = document.querySelectorAll('.uslugi-section__wrapper');

	let firstSection = document.querySelector('.uslugi-section__wrapper');

	let contents = document.querySelectorAll('.uslugi-content');

	let firstContent = document.querySelector('.uslugi-content');

	let arrows = document.querySelectorAll('.sub-section__arrow');

	let uslugiElements = document.querySelectorAll('.uslugi-elements');

	let oldh1 = document.querySelector('.container > h1');

	oldh1.remove()




	firstSection.classList.add('active');

	firstContent.classList.add('active');


	sections.forEach((section) =>{
		section.addEventListener('click', function(){

			sections.forEach((sec) =>{
				sec.classList.remove('active');
			})

			contents.forEach((content) =>{
				content.classList.remove('active');
				if(section.dataset.filter == content.dataset.section){
					content.classList.add('active');
				}

			})

			section.classList.add('active');

		})
	})

	arrows.forEach((arrow) =>{
		arrow.addEventListener('click', function(){

			uslugiElements.forEach((usluga) =>{
				usluga.classList.remove('active');
			})

			arrows.forEach((arrow) =>{
				arrow.classList.remove('active');
			})



			arrow.classList.add('active')
			arrow.parentElement.nextElementSibling.classList.add('active');

		})
	})


});
