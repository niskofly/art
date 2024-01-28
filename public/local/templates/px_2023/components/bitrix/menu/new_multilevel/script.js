document.addEventListener("DOMContentLoaded", () => {



let parents = document.querySelectorAll('.multilevel-nav__item--first-parent');
let parents2 = document.querySelectorAll('.multilevel-nav__item--second-parent');

parents.forEach((elem) =>{
	let wrapper = elem.querySelector('.new-multilevel__item__wrapper');
	let arrow = elem.querySelector('.new-multilevel__item__wrapper > .menu-left__arrow');
	arrow.addEventListener('click', function(){
		wrapper.nextElementSibling.classList.toggle('active');
		elem.classList.toggle('active');
	})
})

parents2.forEach((elem) =>{
	let wrapper = elem.querySelector('.new-multilevel__item__wrapper');
	let arrow = elem.querySelector('.new-multilevel__item__wrapper > .menu-left__arrow');
	arrow.addEventListener('click', function(){
		wrapper.nextElementSibling.classList.toggle('active');
		elem.classList.toggle('active');
	})
})




});


