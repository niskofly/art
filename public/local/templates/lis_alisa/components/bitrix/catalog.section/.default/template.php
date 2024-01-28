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

//global $is_end_section;
if ($arResult["ITEMS"]) {
	?>

	<div class="catalog-section">
		<div class="catalog-section__list">
			<?php
			foreach ($arResult["ITEMS"] as $cell => $arItem) {
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arItemDeleteParams);
				$strMainID = $this->GetEditAreaId($arItem['ID']);
				$price = $arItem['ITEM_PRICES'][$arItem['ITEM_PRICE_SELECTED']];
				$showDiscount = $price['PERCENT'] > 0;
				$arItemIDs = array(
					'ID' => $strMainID,
					'PICT' => $strMainID . '_pict',
					'SECOND_PICT' => $strMainID . '_secondpict',
					'STICKER_ID' => $strMainID . '_sticker',
					'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
					'QUANTITY' => $strMainID . '_quantity',
					'QUANTITY_DOWN' => $strMainID . '_quant_down',
					'QUANTITY_UP' => $strMainID . '_quant_up',
					'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
					'BUY_LINK' => $strMainID . '_buy_link',
					'BASKET_ACTIONS' => $strMainID . '_basket_actions',
					'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
					'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
					'COMPARE_LINK' => $strMainID . '_compare_link',

					'PRICE' => $strMainID . '_price',
					'DSC_PERC' => $strMainID . '_dsc_perc',
					'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
					'PROP_DIV' => $strMainID . '_sku_tree',
					'PROP' => $strMainID . '_prop_',
					'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
					'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
				);

				$strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
				$productTitle = (
				isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
					? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
					: $arItem['NAME']
				);
				$imgTitle = (
				isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
					? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
					: $arItem['NAME']
				);

				$minPrice = false;
				if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE'])) {
					$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
				}

				$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
					$arItem['ID'],
					$USER->GetUserGroupArray(),
					"N",
					1,
					SITE_ID
				);
				?>

				<div class="catalog-section__item" id="<?
				echo $strMainID; ?>">
					<div class="catalog-card">
						<div class="catalog-card__labels">
							<?php
							if ($showDiscount) {
								?>
								<span
									class="catalog-card__label catalog-card__label--sale">Скидка <?= $price['PERCENT'] ?>%</span>
								<?php
							}
							if (!empty($arItem['PROPERTIES']['LABELS']['VALUE']['0'])) {
								?>
								<span
									class="catalog-card__label catalog-card__label--hit"><?= $arItem['PROPERTIES']['LABELS']['VALUE']['0'] ?></span>
								<?php
							}
							if (!empty($arItem['PROPERTIES']['LABELS']['VALUE']['1'])) {
								?>
								<span
									class="catalog-card__label catalog-card__label--new"><?= $arItem['PROPERTIES']['LABELS']['VALUE']['1'] ?></span>
								<?php
							}
							?>
						</div>

						<?php
						if ($arItem['DISPLAY_PROPERTIES']['LEGEND']['VALUE']) {
							?>
							<div class="catalog-card__legend">
								<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
									<?= $arItem['DISPLAY_PROPERTIES']['LEGEND']['VALUE'] ?>
								</a>
							</div>
							<?php
						}

						$img = CFile::ResizeImageGet(
							$arItem['PREVIEW_PICTURE']['ID'],
							array('width' => 191, 'height' => 200),
							BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
							true
						);
						?>
						<a class="catalog-card__image" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							<img id="<?= $arItemIDs['PICT']; ?>" src="<?= $img['src'] ?>">
						</a>

						<div class="catalog-card__title"><?= $arItem['NAME'] ?></div>

						<div class="catalog-card__price"
							 id="<?= $arItemIDs['SECOND_PICT']; ?>"> <?// ОЧЕНЬ ВАЖНО!!!! $arItemIDs['SECOND_PICT'] критичен для работы заказа, он должен где-то быть
							?>
							<?php
							if ($arItem["PRICES"]['BASE']['VALUE'] == 0) {
								echo "Нет в наличии";
							} else {
								?>
								<input type="hidden" id="<?= $arItemIDs['QUANTITY']; ?>"
									   name="<?= $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
									   value="<?= $arItem['CATALOG_MEASURE_RATIO'] ?>">
								<?php
								foreach ($arItem["PRICES"] as $code => $arPrice) {
									if ($arPrice["CAN_ACCESS"]) {
										?>
										<span class="catalog-card__price-curent"
											  id="<?= $arItemIDs['PRICE'] ?>"><?= $arPrice["PRINT_VALUE"] ?></span>
										<?php
										if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) {
											?>
											<div class="catalog-card__price-discont">
												<?= $arPrice["PRINT_DISCOUNT_VALUE"] ?>
											</div>
											<?php
										}
									}
								}
							}
							?>
						</div>

						<div class="catalog-card__buttons">
							<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="btn btn-gray">Подробнее</a>
							<?php
							if ($arItem["PRICES"]['BASE']['VALUE'] > 0) {
								?>
								<div class="catalog-card__button-bay" id="<?= $arItemIDs['BASKET_ACTIONS'] ?>">
									<a class="btn btn-purple" id="<?= $arItemIDs['BUY_LINK'] ?>"
									   href="javascript:void(0)" rel="nofollow">Купить</a>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
					$arJSParams = array(
						'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
						'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
						'SHOW_ADD_BASKET_BTN' => false,
						'SHOW_BUY_BTN' => true,
						'SHOW_ABSENT' => true,
						'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
						'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
						'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
						'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
						'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
						'PRODUCT' => array(
							'ID' => $arItem['ID'],
							'NAME' => $productTitle,
							'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
							'CAN_BUY' => $arItem["CAN_BUY"],
							'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
							'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
							'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
							'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
							'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
							'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
							'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
						),
						'BASKET' => array(
							'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
							'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
							'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
							'EMPTY_PROPS' => true,
							'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
							'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
						),
						'VISUAL' => array(
							'ID' => $arItemIDs['ID'],
							'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
							'QUANTITY_ID' => $arItemIDs['QUANTITY'],
							'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
							'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
							'PRICE_ID' => $arItemIDs['PRICE'],
							'BUY_ID' => $arItemIDs['BUY_LINK'],
							'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
							'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
							'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
							'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK'],
							'SUBSCRIBE_ID' => $arItemIDs['SUBSCRIBE_LINK'],
						),
						'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
					);
					?>
					<script type="text/javascript">var d = 1;
											var <? echo $strObName; ?> =;
											new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
					</script>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<script type="text/javascript">
			BX.message({
				BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
				BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
				ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
				TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
				TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
				TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
				BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
				BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
				BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
				BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
				COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
				COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
				COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
				BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
				SITE_ID: '<? echo SITE_ID; ?>'
			});
	</script>
	<?php
}

if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
	echo $arResult["NAV_STRING"];
}
