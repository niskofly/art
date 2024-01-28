<?php
use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Application;
use \Bitrix\Main\Web\Uri;
use Bitrix\Main\Type\DateTime;

/** @var array $arParams */

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);

$olderDate = ElementTable::getList([
	'order' => ['ACTIVE_FROM' => 'ASC'],
	'filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID']],
	'select' => ['ACTIVE_FROM'],
	'limit' => 1,
])->Fetch()['ACTIVE_FROM'];

$olderYear = (int)$olderDate->format('Y');
$currentYear = (int)date('Y');
$activeYear = $request->get('year') ?? $currentYear;


$dateBegin = new DateTime($activeYear, 'Y');
$dateEnd = clone $dateBegin;
$dateEnd = $dateEnd->add('1 year')->add('-1 day');
$filter['>=DATE_ACTIVE_FROM'] = $dateBegin->toString();
$filter['<=DATE_ACTIVE_FROM'] = $dateEnd->toString();
?>

<div class='news__filter'>
	<?php
	for ($i = $currentYear; $i >= $olderYear; $i--) {
		$uri->addParams(['year' => $i]);

		if($activeYear == $i) {
			$active = $activeYear == $i ? 'news__filter-year--active': '' ;
		}
		else {
			$uri->deleteParams(['PAGEN_1']);
		}
		?>
		<a href="<?= $uri->getUri() ?>" class="news__filter-year <?=$active?>" data-filter-year="<?= $i ?>"><?= $i ?></a>
		<?php
	}
	?>
</div>
