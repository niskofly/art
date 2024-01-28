<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

global $APPLICATION, $arrFilter;


//	lazy load and big data json answers
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'ajaxfilter')) {
	$content = ob_get_contents();
	ob_end_clean();

	[, $itemsContainer] = explode('<!-- items-container -->', $content);
	[, $paginationContainer] = explode('<!-- pagination-container -->', $content);
	[, $epilogue] = explode('<!-- component-end -->', $content);

	\Bitrix\Iblock\Component\Base::sendJsonAnswer([
		'items' => $itemsContainer,
		'pagination' => $paginationContainer,
		'epilogue' => $epilogue,
		'filter' => $GLOBALS['arrFilter'],
	]);
}
