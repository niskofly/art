$(function () {
	$(".js_submenu__button").on("click", function () {
		let menu_container = $(this)
			.closest(".js_submenu")
			.find(".js_submenu__menu");

		let height = menu_container.height();
		let real_height = menu_container.find(":first-child").height();

		if (height === 0) {
			submenuToggle(menu_container, real_height);
		} else {
			submenuToggle(menu_container);
		}

		return false;
	});
});

function submenuToggle(menu_container, height = 0) {
	if (height === 0) {
		menu_container.css("height", "");
	} else {
		menu_container.height(height);
	}
}

/*

function accordion_toggle(context, init = false) {

    let container = context;
    let open = container.hasClass('accordion--open');
    let wrapper = container.find('.accordion-wrapp-hide');
    let content_container = wrapper.find('.accordion-content');
    let show_items_num = container.attr('data-show-items');
    let real_content_height = content_container.innerHeight();
    let start_heigth = 0;
    let accordion_off = false;

    if (show_items_num !== undefined) {
        let all_items_num = content_container.find('.accordion__count-here').length;
        let items_container = content_container;

        if (all_items_num > 0) {
            items_container = content_container.find('.accordion__count-here');
        }

        let items = items_container.children();


        if (items_container.children().length <= show_items_num) {
            accordion_off = true;
        } else {
            $.each(items, function (index, element) {
                if (index >= show_items_num) return false;
                start_heigth += $(element).innerHeight();
            });
            container.find('.accordion-buttons').show();
        }


    } else if (real_content_height > 0) {
        container.find('.accordion-buttons').show();
    }

    let height = start_heigth;
    if (!init) {
        if (!container.hasClass('accordion--open')) {
            height = real_content_height;
        }
        container.toggleClass('accordion--open');
    }
    else if(init && open) {
        height = real_content_height;
    }



    if (accordion_off) {
        wrapper.addClass('accordion_off');
    } else {
        wrapper.animate({height: height}, 500);
    }


}
*/
