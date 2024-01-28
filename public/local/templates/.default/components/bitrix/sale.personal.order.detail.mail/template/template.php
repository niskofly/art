<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
$tmp = $arParams["CUSTOM_SELECT_PROPS"];
$arParams["CUSTOM_SELECT_PROPS"] = ["IND"];
$arParams["CUSTOM_SELECT_PROPS"] = array_merge($arParams["CUSTOM_SELECT_PROPS"], $tmp);
$arParams["CUSTOM_SELECT_PROPS"][] = "SUMM";
?>
<p class="bx_order_list">
	<?
	if (strlen($arResult["ERROR_MESSAGE"])): ?>
		<?= ShowError($arResult["ERROR_MESSAGE"]); ?>
	<?
	else: ?>
	<?
	if ($arParams["SHOW_ORDER_BASE"] == 'Y' || $arParams["SHOW_ORDER_USER"] == 'Y' || $arParams["SHOW_ORDER_PARAMS"] == 'Y' || $arParams["SHOW_ORDER_BUYER"] == 'Y' || $arParams["SHOW_ORDER_DELIVERY"] == 'Y' || $arParams["SHOW_ORDER_PAYMENT"] == 'Y'): ?>

	<?
	if ($arParams["SHOW_ORDER_BASKET"] == 'Y'): ?>
	<p><?= GetMessage('SPOD_ORDER_BASKET') ?></p>
<?
endif ?>
<?
endif ?>



<?
if ($arParams["SHOW_ORDER_BASKET"] == 'Y'): ?>
	<table class="table_product" style="border-right: 1px solid #2a2a2a;border-top:  1px solid #2a2a2a;font-size: 13px;"
		   cellspacing="0" cellpadding="0">
		<thead>
		<tr>
			<?
			foreach ($arParams["CUSTOM_SELECT_PROPS"] as $headerId):
				if ($headerId == 'PICTURE' && in_array('NAME', $arParams["CUSTOM_SELECT_PROPS"])) {
					continue;
				}

				$colspan = "";
				if ($headerId == 'NAME' && in_array('PICTURE', $arParams["CUSTOM_SELECT_PROPS"])) {
					$colspan = 'colspan="2"';
				}

				$headerName = GetMessage('SPOD_' . $headerId);
				if (strlen($headerName) <= 0) {
					foreach (array_values($arResult['PROPERTY_DESCRIPTION']) as $prop_head_desc):
						if (array_key_exists($headerId, $prop_head_desc)) {
							$headerName = $prop_head_desc[$headerId]['NAME'];
						}
					endforeach;
				}
				?>
				<td
				style="padding: 5px 7px;border-left: 1px solid #2a2a2a;border-bottom:  1px solid #2a2a2a;" <?= $colspan ?>><?= $headerName ?></td><?
			endforeach;
			?>
		</tr>
		</thead>
		<tbody>
		<?
		//echo "<pre>".print_r($arParams['CUSTOM_SELECT_PROPS'], true).print_R($arResult["BASKET"], true)."</pre>"?>
		<?
		$cnti = 0;
		foreach ($arResult["BASKET"] as $prod):
			?>
			<tr><?

			$hasLink = !empty($prod["DETAIL_PAGE_URL"]);
			$actuallyHasProps = is_array($prod["PROPS"]) && !empty($prod["PROPS"]);
			$prod["SUMM"] = $prod["PRICE"] * $prod["QUANTITY"];

			foreach ($arParams["CUSTOM_SELECT_PROPS"] as $headerId):
				?>
				<td
				style="text-align:<?= $headerId == "NAME" ? "left" : "center" ?>;padding: 5px 7px;border-left: 1px solid #2a2a2a;border-bottom:  1px solid #2a2a2a;font-size: 13px;"
				class="custom"><?
				if ($headerId == "IND"):
					echo (++$cnti) . ".";

				elseif ($headerId == "NAME"):

					if ($hasLink):
						?><a href="<?= $prod["DETAIL_PAGE_URL"] ?>" target="_blank"><?
					endif;
					?><?= $prod["NAME"] ?><?
					if ($hasLink):
						?></a><?
					endif;

				elseif ($headerId == "PICTURE"):

					if ($hasLink):
						?><a href="<?= $prod["DETAIL_PAGE_URL"] ?>" target="_blank"><?
					endif;
					if ($prod['PICTURE']['SRC']):
						?><img src="<?= $prod['PICTURE']['SRC'] ?>" width="<?= $prod['PICTURE']['WIDTH'] ?>"
							   height="<?= $prod['PICTURE']['HEIGHT'] ?>" alt="<?= $prod['NAME'] ?>" /><?
					endif;
					if ($hasLink):
						?></a><?
					endif;

				elseif ($headerId == "PROPS" && $arResult['HAS_PROPS'] && $actuallyHasProps):

					?>
					<table cellspacing="0" class="bx_ol_sku_prop">
						<?
						foreach ($prod["PROPS"] as $prop):?>
							<tr>
								<td>
									<nobr><?= htmlspecialcharsbx($prop["NAME"]) ?>:</nobr>
								</td>
								<td style="padding-left: 10px !important">
									<b><?= htmlspecialcharsbx($prop["VALUE"]) ?></b></td>
							</tr>
						<?
						endforeach ?>
					</table>
				<?

				elseif ($headerId == "QUANTITY"):

					?>
					<?= $prod["QUANTITY"] ?>
					<?
					if (strlen($prod['MEASURE_TEXT'])):?>
						<?= $prod['MEASURE_TEXT'] ?>
					<?
					else: ?>
						<?= GetMessage('SPOD_DEFAULT_MEASURE') ?>
					<?
					endif ?>
				<?
				elseif ($headerId == "SUMM"):?>
					<?= CurrencyFormat($prod["SUMM"], "RUB"); ?>
				<?
				else:
					$headerId = strtoupper($headerId);
					echo $prod[(strpos($headerId, 'PROPERTY_') === 0 ? $headerId . "_VALUE" : $headerId)];
				endif;

				?></td><?

			endforeach;

			?></tr><?

		endforeach;
		?>
		</tbody>
	</table>
	<br>
<?
endif ?>

<?
if ($arParams["SHOW_ORDER_SUM"] == 'Y'): ?>
	<table class="bx_ordercart_order_sum" style="font-size: 13px;">
		<tbody>

		<?
		///// WEIGHT ?>
		<?
		if (floatval($arResult["ORDER_WEIGHT"])): ?>
			<tr>
				<td class="custom_t1"><?= GetMessage('SPOD_TOTAL_WEIGHT') ?>:</td>
				<td class="custom_t2"><?= $arResult['ORDER_WEIGHT_FORMATED'] ?></td>
			</tr>
		<?
		endif ?>

		<?
		///// PRICE SUM ?>
		<tr>
			<td class="custom_t1"><?= GetMessage('SPOD_PRODUCT_SUM') ?>:</td>
			<td class="custom_t2"><?= $arResult['PRODUCT_SUM_FORMATED'] ?></td>
		</tr>

		<?
		///// TAXES DETAIL ?>
		<?
		foreach ($arResult["TAX_LIST"] as $tax): ?>
			<tr>
				<td class="custom_t1"><?= $tax["TAX_NAME"] ?>:</td>
				<td class="custom_t2"><?= $tax["VALUE_MONEY_FORMATED"] ?></td>
			</tr>
		<?
		endforeach ?>

		<?
		///// TAX SUM ?>
		<?
		/*if(floatval($arResult["TAX_VALUE"])):?>
						   <tr>
							   <td class="custom_t1"><?=GetMessage('SPOD_TAX')?>:</td>
							   <td class="custom_t2"><?=$arResult["TAX_VALUE_FORMATED"]?></td>
						   </tr>
					   <?endi*/
		f ?>

		<?
		///// DISCOUNT ?>
		<?
		if (floatval($arResult["DISCOUNT_VALUE"])): ?>
			<tr>
				<td class="custom_t1"><?= GetMessage('SPOD_DISCOUNT') ?>:</td>
				<td class="custom_t2"><?= $arResult["DISCOUNT_VALUE_FORMATED"] ?></td>
			</tr>
		<?
		endif ?>

		<tr>
			<td class="custom_t1 fwb"><?= GetMessage('SPOD_SUMMARY') ?>:</td>
			<td class="custom_t2 fwb"><?= $arResult["PRICE_FORMATED"] ?></td>
		</tr>
		</tbody>
	</table>
<?
endif ?>
<?
endif ?>
</p>
