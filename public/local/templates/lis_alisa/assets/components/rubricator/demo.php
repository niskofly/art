<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Услуги и Направления");

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services_page.css");

if ($_GET['SECTION_CODE'] === 'all') {
	unset($_GET['SECTION_CODE']);
}
$section_code = $_GET['SECTION_CODE'] ?: "";

//Todo Хорошо бы допилить подсветку фрагментов найденного
//Todo Не работает при переключении Punto Switcher
//Todo Добавить крестик для очистки фильтра
?>
Хорошо бы допилить подсветку фрагментов найденного
Не работает при переключении Punto Switcher
Добавить крестик для очистки фильтра
<div class="services-page">

	<div class="rubricator__search search-form" id="filter">
		<div class="form-group">
			<label for="rubricator_search">Фильтр по рубрикам</label>
			<input id="rubricator_search" class="search-form_input" type="text" placeholder="Начните вводить буквы"
				   autocomplete=""/>
		</div>
		<input class="search-form__button header__search-icon icon-search" name="s" type="submit" value=""/>
	</div>

	<div class="services-page__services" id="filter-content">
		Здесь начальный контент, а позже результат фильтра
	</div>
</div>

<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
