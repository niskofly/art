<?php
/** @var \Bitrix\Main\ $APPLICATION */

include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ошибка: 404 - Страница не найдена");
?>
<style>
.page-top, .left-menu-md, .right-menu-md{display:none!important;}
.content-md{width:100%;}
</style>

<div class="page404">
	<div class="wrap">
		<div class="col-md-12">
			<div class="image"><img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/404_t2.gif" alt="Ошибка 404" title="Ошибка 404"></div>
			<div class="body404">
				<div class="title">Страница не найдена</div>
				<div class="description">Неправильно набран адрес или такой страницы не существует</div>
				<div class="button"><a class="btn btn-default btn-lg" href="<?=SITE_DIR?>">Перейти на главную</a></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(window).resize(function(){ //  BX.addCustomEvent('onWindowResize', function(eventdata) {
	try{
		/*var windowHeight = $(window).outerHeight();
		var panelHeight = $('#panel').outerHeight();
		var headerHeight = $('header').outerHeight();
		var footerHeight = $('footer').outerHeight();
		var mainPaddingTop = parseInt($('.main').css('padding-top'));
		var mainPaddingBottom = parseInt($('.main').css('padding-bottom'));
		var bodyMarginTop = parseInt($('.body').css('margin-top'));
		var bodyMarginBottom = parseInt($('.body').css('margin-bottom'));
		var page404Height = $('.page404').outerHeight();
		var part = Math.floor((windowHeight - panelHeight - headerHeight - footerHeight - page404Height) / 2);
		console.log(part);
		if(part < (mainPaddingTop + bodyMarginTop)){
			part = mainPaddingTop + bodyMarginTop;
		}
		if(part < (mainPaddingBottom + bodyMarginBottom)){
			part = mainPaddingBottom + bodyMarginBottom;
		}
		console.log(part);
		var top = (part - mainPaddingTop - bodyMarginTop);
		if(top < 0){
			top = 0;
		}
		var bottom = (part - mainPaddingBottom - bodyMarginBottom);
		if(bottom < 0){
			bottom = 0;
		}*/

		ignoreResize.push(true);
		$('.page404').css({'opacity': '1'});
		// $('.page404').css({'opacity': '1', 'margin-top': top + 'px', 'margin-bottom': bottom + 'px'});
		setTimeout(function() {
			$('.page404').css({'transition': 'none', '-moz-transition': 'none', '-ms-transition': 'none', '-o-transition': 'none', '-webkit-transition': 'none'});
		}, 400);
		ignoreResize.pop();
	}
	catch(e){}
});
</script>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
