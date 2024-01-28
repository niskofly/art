<?php

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
if ($arParams['ajax_custom'] !== "Y") {
	CJSCore::Init(["fx"]);
	$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tables/default.css');
	$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tables/wide.css');
	$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tables/zebra.css');
}
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/fonts/fontello/css/fontello.css');


if (!empty($arResult['NAV_RESULT'])) {
	$navParams = [
			'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
			'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
			'NavNum' => $arResult['NAV_RESULT']->NavNum
	];
} else {
	$navParams = [
			'NavPageCount' => 1,
			'NavPageNomer' => 1,
			'NavNum' => $this->randString()
	];
}
$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$showTopPager = false;
$showBottomPager = false;
if ($arParams['NEWS_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
}

?>
<div class="registry-members ajax-filter">
	<?php
	if ($arParams['ajax_custom'] !== "Y") {
		?>
		<form class="registry-members__properties table table__list ajax-filter__options">
			<?php
			if ($arResult["FILTER"]) {
				$sort_props = [
						'GROUP1_REGISTRATION_NUMBER',
						'GROUP1_FULL_NAME',
					//                'GROUP1_INN',
						'GROUP1_SRO_MEMBER_STATUS',
						'GROUP2_LEGAL_STATUS'
				];
				$sort = false;
				?>
				<div class="block_filter table__row">
					<?php
					$f_name = 'GROUP1_FULL_NAME';
					$filter = $arResult["FILTER"][$f_name];
					?>
					<div class="table__col filter__item registry-members__fullname table__col--<?= strtolower(
							$f_name
					) ?> block_filter__item ">
						<div class="switcher">
							<input class="rad_1" checked type="radio" name="<?= $f_name ?>__sort" value="ASC">
							<input class="rad_2" type="radio" name="<?= $f_name ?>__sort" value="DESC">
						</div>
						<label class="block_filter__name" for="<?= $f_name ?>"><?= $filter["NAME"] ?></label>
						<div class="block_filter__select">
							<input type="text" name="%PROPERTY_<?= $f_name ?>" id="<?= $f_name ?>">
						</div>
					</div>

					<?php
					$f_name = 'GROUP1_REGISTRATION_NUMBER';
					$filter = $arResult["FILTER"][$f_name];
					?>
					<div class="table__col filter__item registry-members__regnumber table__col--<?= strtolower(
							$f_name
					) ?> block_filter__item ">
						<label class="block_filter__name" for="<?= $f_name ?>"><?= $filter["NAME"] ?></label>
						<div class="block_filter__select">
							<input type="text" name="%PROPERTY_<?= $f_name ?>" id="<?= $f_name ?>">
						</div>
					</div>

					<div class="registry-members__props">
						<?php
						$f_name = 'GROUP1_INN';
						$filter = $arResult["FILTER"][$f_name];
						?>
						<div class="table__col filter__item registry-members__inn block_filter__item ">
							<label class="block_filter__name" for="<?= $f_name ?>"><?= $filter["NAME"] ?></label>
							<div class="block_filter__select">
								<input type="text" name="%PROPERTY_<?= $f_name ?>" id="<?= $f_name ?>">
							</div>
						</div>

						<?php
						$f_name = 'GROUP1_SRO_MEMBER_STATUS';
						$filter = $arResult["FILTER"][$f_name];
						?>
						<div class="table__col filter__item registry-members__status block_filter__item ">
							<label class="block_filter__name" for="<?= $f_name ?>"><?= $filter["NAME"] ?></label>
							<div class="block_filter__select">
								<select name="PROPERTY_<?= $f_name ?>" id="<?= $f_name ?>">
									<option value="0">Выбрать</option>
									<?
									foreach ($filter["ITEMS"] as $item) {
										?>
										<option value="<?= $item["ID"] ?>"><?= $item["VALUE"] ?></option>
										<?
									} ?>
								</select>
							</div>
						</div>

						<?php
						$f_name = 'GROUP2_LEGAL_STATUS';
						$filter = $arResult["FILTER"][$f_name];
						?>
						<div class="table__col filter__item registry-members__legalstatus block_filter__item ">


							<label class="block_filter__name" for="<?= $f_name ?>"><?= $filter["NAME"] ?></label>
							<div class="block_filter__select">
								<select name="PROPERTY_<?= $f_name ?>" id="<?= $f_name ?>">
									<option value="0">Выбрать</option>
									<?php
									foreach ($filter["ITEMS"] as $item) {
										?>
										<option value="<?= $item["ID"] ?>"><?= $item["VALUE"] ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>

				</div>
				<?php
			}
			?>
		</form>
		<?php
	}
	?>


	<div class="registry-members__list table__list ajax-filter__results" id="filter-result">
		<!-- items-container -->
		<?php
		foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction(
					$arItem['ID'],
					$arItem['EDIT_LINK'],
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
			);
			$this->AddDeleteAction(
					$arItem['ID'],
					$arItem['DELETE_LINK'],
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
					["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

			?>
			<div class="registry-members__item zebra__item table__row" id="<?= $this->GetEditAreaId($arItem['ID']) ?>"
				 data-entity="items-row">
				<div class="registry-members__fullname table__col">
					<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="registry-members__value">
						<?= $arItem['PROPERTIES']['GROUP1_FULL_NAME']['VALUE'] ?: "-----" ?>
					</a>
				</div>
				<div class="registry-members__regnumber table__col">
					<a class="registry-members__value <?= $arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'] ? "registry-members__value--title" : "" ?>"
					   href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
						<?= $arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'] ?: "-----"; ?>
					</a>
				</div>
				<div class="registry-members__props">
					<div class="registry-members__inn table__col">
						<a class="registry-members__value <?= $arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'] ? "registry-members__value--title" : "" ?>"
						   href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							<?= $arItem['PROPERTIES']['GROUP1_INN']['VALUE'] ?: "-----"; ?>
						</a>
					</div>
					<div class="registry-members__status table__col">
						<a class="registry-members__value <?= $arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'] ? "registry-members__value--title" : "" ?>"
						   href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							<?= $arItem['PROPERTIES']['GROUP1_SRO_MEMBER_STATUS']['VALUE'] ?: "-----"; ?>
						</a>
					</div>
					<div class="registry-members__legalstatus table__col">
						<a class="registry-members__value <?= $arItem['PROPERTIES']['GROUP1_REGISTRATION_NUMBER']['VALUE'] ? "registry-members__value--title" : "" ?>"
						   href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
							<?= $arItem['PROPERTIES']['GROUP2_LEGAL_STATUS']['VALUE'] ?: "-----"; ?>
						</a>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<!-- items-container -->
	</div>

	<div data-pagination-num="<?= $navParams['NavNum'] ?>">
		<!-- pagination-container -->
		<?= $arResult['NAV_STRING'] ?>
		<!-- pagination-container -->
	</div>
</div>
<!-- component-end -->
<?php
/*
$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign( $templateName, 'news.list' );
$signedParams = $signer->sign( base64_encode( serialize( $arParams ) ), 'news.list' );

$paramString = $signer->unsign( $signedParams, 'news.list' );
$parameters = unserialize( base64_decode( $paramString ), [ 'allowed_classes' => false ] );
?>
<script>
    var <?=$obName?> = new JCNewsListFilter({
        siteId: '<?=CUtil::JSEscape( $component->getSiteId() )?>',
        templateFolder: '<?=CUtil::JSEscape( $templateFolder )?>',
        template: '<?=CUtil::JSEscape( $signedTemplate )?>',
        parameters: '<?=CUtil::JSEscape( $signedParams )?>',
        navParams: <?=CUtil::PhpToJSObject( $navParams )?>,
    });
</script>
<!-- component-end -->

*/ ?>
