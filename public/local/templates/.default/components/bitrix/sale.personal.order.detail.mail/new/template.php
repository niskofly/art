<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
$tmp = $arParams["CUSTOM_SELECT_PROPS"];
$arParams["CUSTOM_SELECT_PROPS"] = ["IND"];
$arParams["CUSTOM_SELECT_PROPS"] = array_merge($arParams["CUSTOM_SELECT_PROPS"], $tmp);
$arParams["CUSTOM_SELECT_PROPS"][] = "SUMM";
?>
<?php
if (strlen($arResult["ERROR_MESSAGE"])) {
	echo ShowError($arResult["ERROR_MESSAGE"]);
} else {
	if ($arParams["SHOW_ORDER_BASKET"] == 'Y') {
		?>
		<table class="product__table">
			<thead>
			<tr>
				<td style="vertical-align: top; padding-right: 20px;">Артикул / Наименование</td>
				<?
				/** /?>
				 * <td style="padding: 9px">Кол-во</td>
				 * <td style="padding: 9px">Цена, ₽</td>
				 * <?/**/
				?>
				<td style="vertical-align: top; text-align: right;">Сумма, руб</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$cnti = 0;
			$num = 0;
			$all_quantity = 0;
			foreach ($arResult["BASKET"] as $prod) {
				++$num;
				$all_quantity += $prod["QUANTITY"];
				$hasLink = !empty($prod["DETAIL_PAGE_URL"]);
				$actuallyHasProps = is_array($prod["PROPS"]) && !empty($prod["PROPS"]);
				$format_price = number_format($prod["PRICE"], 2, '.', ' ');
				$format_summ = number_format($prod["PRICE"] * $prod["QUANTITY"], 2, '.', ' ');
				?>
				<tr class="<?= ($num % 2) ? "even" : "no-even"; ?> ">
					<td style="vertical-align: top; padding-left: 9px;">
						<b><?= $prod["PROPERTY_CML2_ARTICLE_VALUE"]; ?></b><br>
						<?php
						if ($hasLink) {
							echo '<a href="' . $prod["DETAIL_PAGE_URL"] . '" target="_blank">';
						}
						echo $prod["NAME"];
						if ($hasLink) {
							echo '</a>';
						}
						?>
					</td>
					<td style="text-align: right; vertical-align: top; padding-right: 9px;">
						<span style="font-size: smaller;"><?= $format_price ?></span><br>
						<span
							style="font-size: smaller;"><?= $prod['QUANTITY'] ?> <?= $prod['MEASURE_TEXT'] ?><span><br>
                                <b><?= $format_summ ?></b>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php
	}

	//pre($prod);
	?>

	<div class="product__result result">
		<div class="all-quantity">
			<span class="all-quantity__subtitle">Итого:</span> <span
				class="all-quantity__value"><?= $all_quantity ?></span> <span class="all-quantity__unit"></span>
			позиций
		</div>
		<div class="all-summ">
			<span class="all-summ__subtitle">На сумму:</span> <span
				class="all-summ__value"><?= number_format($arResult["PRICE"], 2, '.', ' ') ?> руб</span>
		</div>
	</div>
	<?php
}


