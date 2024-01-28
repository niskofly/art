$(function(){

    let messageElement = $('.cookie-notification');
    let ya_code = messageElement.attr('data-ya');
    if (!ya_metrika_deferred) initCounter(ya_code);
    // Если нет cookies, то показываем плашку
    if (BX.getCookie('agreement') === undefined) {
        setTimeout(showMessage(), 10000);
    }
    else if (BX.getCookie('agreement') === 'Y') {
        if (ya_metrika_deferred) initCounter(ya_code);
    }

    // Нажатие кнопки "Я согласен"
    $('#apply').on('click', function() {
        if (ya_metrika_deferred) initCounter(ya_code);
        saveAnswer('Y');
        hideMessage();
    });
});

// Загружаем сам код счетчика сразу
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
(window, document,'script','//mc.yandex.ru/metrika/tag.js', 'ym');


// Функция, которая показывает предупреждение
function showMessage () {
    let messageElement = $('.cookie-notification');
    //let ya_code = messageElement.attr('data-ya');
    messageElement.addClass('cookie-notification--show');
}
// Функция, которая прячет предупреждение
function hideMessage () {
    let messageElement = $('.cookie-notification');
    messageElement.removeClass('cookie-notification--show');

}

function saveAnswer ( ageement ) {
    let messageElement = $('.cookie-notification');
    // Прячем предупреждение
    hideMessage();
    // Ставим cookies
    BX.setCookie('agreement', ageement, {expires: 28800, paht: '/'});
}
function initCounter (ya_code) {
    ym(ya_code, 'init', ya_metrika_param);
    (function(w, d, u) {
        var s = d.createElement('script');
        s.defer = false;
        s.async = false;
        s.id = 'b242ya-script';
        s.src = u + '?' + (Date.now() / 60000 | 0);
        var h = d.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s, h);
    })(window, document, 'https://67p.b242ya.ru/static/js/b242ya.js');
    var b242yaScript = document.querySelector('#b242ya-script');
    b242yaScript.addEventListener('load', function() {
        if (typeof B242YAInit != 'undefined') {
            B242YAInit({
                portal: 'https://portal.rustech.ru/',
                pid: 'a26ce0e92dddd288d39d143ef7075b09',
                presets: {}
            });
        }
    });
}
