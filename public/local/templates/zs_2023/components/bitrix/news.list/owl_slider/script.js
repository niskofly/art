$(function () {
	let partners_container = $(".partners.owl-container");
	let partners_list = partners_container.find(".owl-carousel");

	partners_list.owlCarousel({
		margin: 0,
		loop: true,
		nav: false,
		dots: false,
		smartSpeed: 1000,
		items: 1,
		responsive: {
			0: {
				items: 1,
				nav: true,
			},
			600: {
				items: 3,
				nav: false,
			},
			1000: {
				items: 5,
				nav: true,
				loop: false,
			},
		},
	});
});
