document.addEventListener("DOMContentLoaded",()=>{

	let prices = document.querySelectorAll('.prices__price');

	let tablePrices = document.querySelector('.table-prices')

	let priceTitle = document.querySelector('.price-title')

	let addPriceText = document.querySelector('.uslugi_additional-text--price')


	if(!prices.length){
		tablePrices.style = 'display: none';
		priceTitle.style = 'display: none';
		addPriceText.style = 'display: none';
	}

	prices.forEach((price)=>{
		if (price.innerText.includes('бесплатно')){
			price.textContent = "бесплатно"
		}
	})

});
