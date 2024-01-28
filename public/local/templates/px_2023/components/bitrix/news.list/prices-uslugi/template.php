<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<table class="table-prices">


	<tbody class="news-prices">
	<tr>
		<th>Код услуги/Наименование</th>
		<th>Стоимость</th>
	</tr>
	<?

	foreach ($arResult["ITEMS"] as $arItem): ?>
		<?

		if ($arItem['NAME']): ?>

			<tr class="prices__row">
				<td class="prices__name"><?= $arItem['NAME'] ?></td>
				<?
				if ($arItem['CODE']): ?>
					<td class="prices__price"><?= $arItem['CODE'] ?>₽</td>
				<?
				endif; ?>
			</tr>
		<?
		endif; ?>

	<?
	endforeach; ?>

	</tbody>

</table>

