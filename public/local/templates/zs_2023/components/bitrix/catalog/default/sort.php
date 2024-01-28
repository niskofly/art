<?php


/** @var array $arParams */

/** @var Bitrix\Main\ $APPLICATION */

/** @var array $arSection */

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $regionStockID;


$instance = Application::getInstance();

$context = $instance->getContext();
$session = $instance->getSession();
$request = $context->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);


$arAvailableSort = [];
$arSorts = $arParams['SORT_BUTTONS'];

$sortButtonsAvailable = [
		'POPULARITY' => [
				'CODE' => 'POPULARITY',
				'NAME' => 'По популярности',
				'ORDER' => 'desc',
		],
		'PRICE' => [
				'CODE' => 'SCALED_PRICE_1',
				'NAME' => 'По цене',
				'ORDER' => 'desc',
		],
		'AVAILABLE' => [
				'CODE' => 'AVAILABLE',
				'NAME' => 'По наличию',
				'ORDER' => 'desc',
		],
];


foreach ($arSorts as $sortButton) {
	if (!isset($sortButtonsAvailable[$sortButton])) {
		continue;
	}
	$button = $sortButtonsAvailable[$sortButton];

	$arAvailableSort[$button['CODE']] = $button;
}

$sort = 'AVAILABLE';
if (isset($arParams['ELEMENT_SORT_FIELD']) && isset($sortButtonsAvailable[$arParams['ELEMENT_SORT_FIELD']])) {
	$sort = $arParams['ELEMENT_SORT_FIELD'];
}


$sortTmp = '';
if ($request->get('sort')) {
	$sortTmp = $request->get('sort');
} elseif ($session->has('sort')) {
	$sortTmp = $session->get('sort');
}
$sortTmp = mb_strtoupper($sortTmp);
if (array_key_exists($sortTmp, $arAvailableSort)) {
	$sort = $sortTmp;
	$session->set('sort', $sort);
}


$orderTmp = '';
if ($request->get('order')) {
	$orderTmp = $request->get('order');
} elseif ($session->has('order')) {
	$orderTmp = $session->get('order');
}
$orderTmp = mb_strtolower($orderTmp);

if (in_array($orderTmp, ['asc', 'desc'])) {
	$arAvailableSort[$sort]['ORDER'] = $orderTmp;
	$session->set('order', $arAvailableSort[$sort]['ORDER']);
}

// особые преобразования для сортировке по цене
if ($sort == 'PRICE') {
	$sort = $arAvailableSort['PRICE'][0];
}

// Собираем параметры сортировки для передачи в компонент

$arSort = [
		'ELEMENT_SORT_FIELD' => $arAvailableSort[$sort]['CODE'],
		'ELEMENT_SORT_ORDER' => $arAvailableSort[$sort]['ORDER'],
		'HIDE_NOT_AVAILABLE' => 'N',
];
?>

<!--noindex-->
<div class="sort-filter">
	<?php
	foreach ($arAvailableSort as $name => $arItem) {
		$uri->addParams([
				'sort' => $arItem['CODE'],
				'order' => ($arItem['ORDER'] == 'desc') ? 'asc' : 'desc'
		]);
		$arClass = [
				'sort-btn',
				'sort-btn--order-' . $arItem['ORDER'],
		];
		if ($sort == $arItem['CODE']) {
			$arClass[] = 'sort-btn--active';
		}
		?>
		<a href="<?= $uri->getUri() ?>" class="<?= implode(' ', $arClass) ?>"
		   title="<?= $arItem['NAME'] ?>" rel="nofollow">
			<span><?= $arItem['NAME'] ?></span>
			<svg>
				<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/assets/icons/sprite.svg#sort"></use>
			</svg>
		</a>
		<?php
	}
	?>
</div>
<!--/noindex-->

