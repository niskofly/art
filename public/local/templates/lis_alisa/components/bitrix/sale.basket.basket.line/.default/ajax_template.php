<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)) . '/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY']))) {
	?>
	<div data-role="basket-item-list" class="bx-basket-item-list">

		<?
		if ($arParams["POSITION_FIXED"] == "Y"): ?>
			<div id="<?= $cartId ?>status" class="bx-basket-item-list-action"
				 onclick="<?= $cartId ?>.toggleOpenCloseCart()"><?= GetMessage("TSB1_COLLAPSE") ?></div>
		<?
		endif ?>

		<?
		if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]): ?>
			<div class="bx-basket-item-list-button-container">
				<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="btn btn-primary"><?= GetMessage("TSB1_CART") ?></a>
				<a href="<?= $arParams["PATH_TO_ORDER"] ?>" class="btn btn-primary"><?= GetMessage("TSB1_2ORDER") ?></a>
			</div>
		<?
		endif ?>
		<?
		?>
		<div id="<?= $cartId ?>products" class="bx-basket-item-list-container">
			<?php
			foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items)) {
					continue;
				}
				?>

				<div class="bx-basket-item-list-item-status">Корзина</div>
				<div class="scroll_item-list">
					<?php
					foreach ($items as $v):
						$picture = "";
						if ($v['DETAIL_PICTURE']) {
							$file = CFile::ResizeImageGet(
								$v['DETAIL_PICTURE'],
								array('width' => 80, 'height' => 160),
								BX_RESIZE_IMAGE_PROPORTIONAL,
								true
							);
							$picture_src = $file['src'];
						}
						?>
						<div class="bx-basket-item-list-item d-flex flex-wrap-del">
							<div class="bx-basket-item-list-item-remove"
								 onclick="<?= $cartId ?>.removeItemFromCart(<?= $v['ID'] ?>)"
								 title="<?= GetMessage("TSB1_DELETE") ?>"></div>
							<div class="bx-basket-item-list-item-img"
								 style="background-image: url(<?= $picture_src ?>)"></div>
							<div class="d-flex flex-wrap bx-basket-item-list-item-content_info align-content-between">
								<div class="bx-basket-item-list-item-name w-100">
									<div class="w-100"><?= $v["NAME"] ?></div>
									<div class="article">Арт: <?= $v['PROPERTIES']['ARTICLE']['VALUE'] ?> </div>
									<?
									if ($arParams["SHOW_PRICE"] == "Y"): ?>
										<div class="w-100">
											<div class="bx-basket-item-list-item-price d-inline">
												<strong><?= $v["PRICE_FMT"] ?></strong></div>
											<?
											if ($v["FULL_PRICE"] != $v["PRICE_FMT"]): ?>
												<div
													class="bx-basket-item-list-item-price-old d-inline"><?= $v["FULL_PRICE"] ?></div>
											<?
											endif ?>
										</div>
									<?
									endif ?>
								</div>
								<div class="bx-basket-item-list-item-price-summ_all w-100">
									<div class="bx-basket-item-list-item-price-block w-100">
										<?
										if ($arParams["SHOW_SUMMARY"] == "Y"): ?>
											<div class="bx-basket-item-list-item-price-summ">
												<strong><?= $v["QUANTITY"] ?></strong> <?= $v["MEASURE_NAME"] ?> <?= GetMessage(
													"TSB1_SUM"
												) ?>

											</div>
										<?
										endif ?>
									</div>
									<?= $v["SUM"] ?>
								</div>
							</div>
						</div>
					<?
					endforeach ?>
				</div>
			<?
			endforeach ?>
		</div>
	</div>

	<script>
			BX.ready(function() {
		  <?=$cartId?>.
							fixCart();
			});
	</script>
	<?
}
