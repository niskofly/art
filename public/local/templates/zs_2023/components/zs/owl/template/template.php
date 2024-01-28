<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<?php
/** @var CBitrixComponent $this */

/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

pre($arResult['ITEMS'][0]['ID']['test']?:"");
if ($arResult['ITEMS']) {
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/owl.theme.custom.css');

$id_comp = uniqid("owl_") . "_" . $arParams["IBLOCK_ID"];
?>

<div class="owl_container" style="<?= $arParams["PROP_WIDTH"] ? 'width:' . $arParams["PROP_WIDTH"] . ';' : ''; ?>">
	<div class="owl-carousel" data-owl_id="<?= $id_comp ?>">
		<?php
		foreach ($arResult['ITEMS'] as $arItem) {
			$pictures = [
				'DEFAULT' => [
					'SRC' => 'https://via.placeholder.com/500x500'
				],
				'ITEMS' => [

					'0' => [
						'min-width' => '1150',
						'SRC' => 'https://via.placeholder.com/2500x600'
					],
					'1' => [
						'min-width' => '650',
						'SRC' => 'https://via.placeholder.com/1500x500'
					],
				],

			];

			?>
			<div class="owl_element"
				 style="<?= $arParams["PROP_HEIGHT"] ? 'height:' . $arParams["PROP_HEIGHT"] . ';' : ''; ?>">
				<picture>
					<?php
					foreach ($pictures['ITEMS'] as $picture) {
						?>
						<source media="(min-width: <?= $picture['min-width'] ?>px )" srcset="<?= $picture['SRC'] ?>">
						<?php
					}
					?>
					<img src="<?= $pictures['DEFAULT']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>">
				</picture>
			</div>
			<?php
		}
		?>
	</div>
</div>
<script>
	owl_param['<?=$id_comp?>'] = <?=CUtil::PhpToJSObject($arResult["jsParams"])?>;
</script>
