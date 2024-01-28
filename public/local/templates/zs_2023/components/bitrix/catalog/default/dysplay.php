<?php

// TODO оставить только то что касается переключения вида товаров в списке

/** @var array $arParams */
/** @var Bitrix\Main\ $APPLICATION */

/** @var array $arSection */

use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $regionStockID;

$validDisplays = ['block', "list", 'table'];

$instance = Application::getInstance();

$context = $instance->getContext();
$session = $instance->getSession();
$request = $context->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);

$display = $arParams['DEFAULT_LIST_TEMPLATE'] ?? 'block';

$displayTmp = '';
if ($request->get('display')) {
	$displayTmp = $request->get('display');
} elseif ($session->has('display')) {
	$displayTmp = $session->get('display');
} elseif (isset($arSection['DISPLAY'])) {
	$displayTmp = $arSection['DISPLAY'];
}

if (in_array($displayTmp, $validDisplays)) {
	$display = mb_strtolower($displayTmp);
	$session->set('display', $display);
}

$template = 'catalog_' . $display;
?>

<div class="sort_header view_<?= $display ?>">
    <!--noindex-->
    <div class="sort_filter">
		<?php
		$arAvailableSort = [];
		$arSorts = $arParams['SORT_BUTTONS'];

		if (in_array("QUANTITY", $arSorts)) {
			$arAvailableSort['CATALOG_AVAILABLE'] = ['QUANTITY', 'desc'];
		}
		if (in_array("POPULARITY", $arSorts)) {
			$arAvailableSort['SHOWS'] = ['SHOWS', 'desc'];
		}
		if (in_array("NAME", $arSorts)) {
			$arAvailableSort['NAME'] = ['NAME', 'asc'];
		}
		if (in_array("PRICE", $arSorts)) {
			$arSortPrices = $arParams['SORT_PRICES'];
			if ($arSortPrices == "MINIMUM_PRICE" || $arSortPrices == "MAXIMUM_PRICE") {
				$arAvailableSort['PRICE'] = ['PROPERTY_' . $arSortPrices, 'desc'];
			} else {
				if ($arSortPrices == "REGION_PRICE") {
					global $arRegion;
					if ($arRegion) {
						if (!$arRegion['PROPERTY_SORT_REGION_PRICE_VALUE'] || $arRegion['PROPERTY_SORT_REGION_PRICE_VALUE'] == "component") {
							$price = CCatalogGroup::GetList([],
								['NAME' => $arParams['SORT_REGION_PRICE']],
								false,
								false,
								['ID', 'NAME'])->GetNext();
							$arAvailableSort['PRICE'] = ['CATALOG_PRICE_' . $price['ID'], 'desc'];
						} else {
							$arAvailableSort['PRICE'] = [
								"CATALOG_PRICE_" . $arRegion['PROPERTY_SORT_REGION_PRICE_VALUE'],
								"desc"
							];
						}
					} else {
						$price_name = ($arParams['SORT_REGION_PRICE'] ? $arParams['SORT_REGION_PRICE'] : "BASE");
						$price = CCatalogGroup::GetList([], ['NAME' => $price_name], false, false, ['ID', 'NAME']
						)->GetNext();
						$arAvailableSort['PRICE'] = ['CATALOG_PRICE_' . $price['ID'], 'desc'];
					}
				} else {
					$price = CCatalogGroup::GetList([],
						['NAME' => $arParams['SORT_PRICES']],
						false,
						false,
						['ID', 'NAME'])->GetNext();
					$arAvailableSort['PRICE'] = ['CATALOG_PRICE_' . $price['ID'], 'desc'];
				}
			}
		}

		$sort = $arParams['ELEMENT_SORT_FIELD'] ?? 'SHOWS';
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

		$order = $arParams['ELEMENT_SORT_ORDER'] ?? $arAvailableSort[$sort][1];
		$orderTmp = '';
		if ($request->get('order')) {
			$orderTmp = $request->get('order');
		} elseif ($session->has('order')) {
			$orderTmp = $session->get('order');
		}
		$orderTmp = mb_strtolower($orderTmp);

		if (in_array($orderTmp, ['asc', 'desc'])) {
			$order = $orderTmp;
			$session->set('order', $order);
		}


		foreach ($arAvailableSort as $sortPropertyName => $null) {
			$uri->addParams([
				'sort' => $sortPropertyName,
				'order' => ($order == 'desc') ? 'asc' : 'desc'
			]);
			$arClass = ['sort_btn', $order, $sortPropertyName];
			if ($sort == $sortPropertyName) {
				$arClass[] = 'current';
			}
			?>

            <a href="<?= $uri->getUri() ?>"
               class="<?= implode(' ', $arClass) ?>"
               title="<?= Loc::GetMessage('SECT_SORT_' . $sortPropertyName) ?>"
               rel="nofollow">
                <i class="icon"></i><span><?= Loc::GetMessage('SECT_SORT_' . $sortPropertyName) ?></span><i
                        class="arr icons_fa"></i>
            </a>
			<?php
		}

		if ($sort == 'PRICE') {
			$sort = $arAvailableSort['PRICE'][0];
		}

		$arSort = [
			'ELEMENT_SORT_FIELD' => $sort,
			'ELEMENT_SORT_ORDER' => $order,
			'HIDE_NOT_AVAILABLE' => 'N',
		];
		if ($sort == 'CATALOG_AVAILABLE') {
			$arSort['ELEMENT_SORT_FIELD'] = $regionStockID ?? 'PROPERTY_UF_REGION_MSK_STOCK';
		}


		?>
    </div>


    <div class="sort_display">
		<?
		foreach ($validDisplays as $displayType): ?>
			<?
			$current_url = '';
			$current_url = $APPLICATION->GetCurPageParam('display=' . $displayType, ['display']);
			$url = str_replace('+', '%2B', $current_url);
			?>
            <a rel="nofollow" href="<?= $url; ?>"
               class="sort_btn <?= $displayType ?> <?= ($display == $displayType ? 'current' : '') ?>"><i
                        title="<?= GetMessage("SECT_DISPLAY_" . strtoupper($displayType)) ?>"></i></a>
		<?
		endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <!--/noindex-->
</div>

