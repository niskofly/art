document.addEventListener("DOMContentLoaded", () => {

	let voprosTitle = document.querySelectorAll('.vopros__title');

	let voprosOtvet = document.querySelectorAll('.otvet__wrapper');

	voprosTitle.forEach((title) =>{
		title.addEventListener('click', function(){
			if(title.classList.contains('active')){
				title.classList.remove('active');
				title.nextElementSibling.classList.remove('active');
			} else{
				title.classList.add('active');
				title.nextElementSibling.classList.add('active');
			}
		})
	})

});

