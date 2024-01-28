//import data from "../../../../../../vendors/Inputmask-5.x_2/lib/dependencyLibs/data";

$(function () {
    let block_filter = $('.block_filter');

    block_filter.on('keyup', 'input', function () {
        let filter = $(this).closest('form').serializeArray();
        getRubricator(filter);
    })
    block_filter.on('change', 'select', getFilterDate)
    $(".block_filter__name").on("click",function(){
        let cont = $(this).parent();
        let order = cont.attr("data_order");
        $(".block_filter .filter__item").removeClass("sort").attr("data_order","");
        if(order == "ASC"){
            order = "DESC"
        }
        else {
            order = "ASC";
        }
        cont.addClass("sort").attr("data_order",order);
        getFilterDate();
    })
    $('.switcher').on('click', function(){

        let inputs = $(this).find('input');
        let first = true;
        inputs.toggleClass('checked');

        if ( $(this).find('input:checked').length > 0 ){
            $(this).find('input:checked').prop('checked', false);
            console.log($(this).find('input:checked'));
        }
        // {
        //     $('input[type="checkbox"]').attr('checked', 'checked');
        // }
        // else
        // {
        //     $('input[type="checkbox"]').removeAttr('checked');
        // }
        console.log($(this).find('input:checked'));

    });
    initPagination($(".bx-pagination-container"))
});
function initPagination(cont){
    cont.find("a").on("click",function(){
        let el = $(this);
        let li = el.closest('li');
        let num = li.data("num")
        let ul = el.closest("ul");
        //ul.find(".bx-active").removeClass('bx-active');
        //li.addClass('bx-active');
        let h = el.attr("href");
        let url = new URL(h,window.location);
        let page = url.searchParams.get('PAGEN_1');
        let filter = $('.ajax-filter form').serializeArray();
        getRubricator(filter,'PAGEN_1='+page);

        return false;
    })

}
function getFilterDate(){

    let filter = $(this).closest('form').serializeArray();
    getRubricator(filter);
}
function resetPage() {
    let page = $(".bx-pagination-container")
}
function getSortSelect(){
    let sort = {};
    let sort_cont = $(".filter__item.sort");
    if(sort_cont.length){
        sort.name = sort_cont.find(" .block_filter__select input,select").attr("name");
        sort.value = sort_cont.attr("data_order");
        return sort;
    }
    else {
        return false;
    }
}

function getRubricator(filter = '',page = '') {

    let container = $("[data-ajax-content=rubricator]");
    let sort = getSortSelect();
    //let data = {filter: filter, marker: 'ajax'};
    let data = {filter: filter, action: 'ajaxfilter'};
    if(sort){
        data.sort = sort;
    }
    let url = '/registry/'+(page?"?"+page:"")
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'json',
        data: data,
        context: container,
        success: function (data) {
            //var data = $(data);
            //data = data.find('#filter-result');
            let container = $('#filter-result');
            container.empty();
            container.append( data.items );
            processPagination(data.pagination);
            initPagination($(".bx-pagination-container"))
        },
        error: function (response) {
            console.log(response);
        }
    })
}
function processPagination(paginationHtml)
{
    if (!paginationHtml)
        return;

    var pagination = document.querySelectorAll('[data-pagination-num="1"]');
    for (var k in pagination)
    {
        if (pagination.hasOwnProperty(k))
        {
            pagination[k].innerHTML = paginationHtml;
        }
    }
}
