<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;

$this->setFrameMode(true);

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);

// if(!$arResult["NavShowAlways"])
// {
// if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
// return;
// }

$show_pages = 5; // Отобразить n страниц
$arRages = array();

$current_page_num = $arResult["NavPageNomer"];

$first_page_num = 1;
$last_page_num = $arResult['NavPageCount'];
$start_cnt = $current_page_num - floor($show_pages / 2);
if ($start_cnt < 0) {
	$start_cnt = $first_page_num;
} elseif (($start_cnt + $show_pages) > $last_page_num) {
	$start_cnt = $last_page_num - $show_pages + 1;
}

$arRages['first'] = array(
	'name' => 'Первая страница',
	'label' => '<<',
	'num' => $first_page_num,
	'url' => $uri->addParams(array('PAGEN_' . $arResult["NavNum"] => $first_page_num))->getUri(),
	'class' => $current_page_num <= $first_page_num ? "disabled" : "",
);
$arRages['previous'] = array(
	'name' => 'Предыдущая страница',
	'label' => '<',
	'num' => $current_page_num - 1,
	'url' => $uri->addParams(array('PAGEN_' . $arResult["NavNum"] => $current_page_num - 1))->getUri(),
	'class' => $current_page_num <= $first_page_num ? "disabled" : "",
);


for ($i = 1; $i <= $show_pages; $i++) {
	$page = $start_cnt++;
	$arRages[$page] = array(
		'name' => 'Cтраница ' . $page,
		'label' => $page,
		'num' => $page,
		'url' => $uri->addParams(array('PAGEN_' . $arResult["NavNum"] => $page))->getUri(),
		'class' => '',
	);

	if ($page == $current_page_num) {
		$arRages[$page]['class'] = 'active';
	}
}

$arRages['next'] = array(
	'name' => 'Следующая страница',
	'label' => '>',
	'num' => $current_page_num - 1,
	'url' => $uri->addParams(array('PAGEN_' . $arResult["NavNum"] => $current_page_num + 1))->getUri(),
	'class' => $current_page_num >= $last_page_num ? "disabled" : "",
);
$arRages['last'] = array(
	'name' => 'Последняя страница',
	'label' => '>>',
	'num' => $first_page_num,
	'url' => $uri->addParams(array('PAGEN_' . $arResult["NavNum"] => $last_page_num))->getUri(),
	'class' => $current_page_num >= $last_page_num ? "disabled" : "",
);
?>

<?
/*<span class="pager__title"><?=GetMessage("pages")?></span>*/ ?>
<nav aria-label="Page navigation example" class="pager">
	<ul class="pagination">
		<?
		foreach ($arRages as $page) {
			?>
			<li class="page-item <?= $page['class']; ?>">
				<a class="page-link" href="<?= $page['url'] ?>" title="<?= $page['name'] ?>"><?= $page['label'] ?></a>
			</li>
			<?
		} ?>

	</ul>
</nav>
