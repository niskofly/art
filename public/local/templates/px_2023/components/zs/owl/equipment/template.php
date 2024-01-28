<?php

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

$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/owl.theme.custom.css');
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/tails/tail-equipment.css');

$id_comp = uniqid("owl_") . "_" . $arParams["IBLOCK_ID"];
if ($arResult['ITEMS']) {
	?>
	<div class="equipment owl_container" >
		<?php
		if ($arParams["SHOW_PLACEHOLDER"] == "Y") {
			$first = current($arResult["ITEMS"]);
			$img400 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 401, 'height' => 601],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
			$img768 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 769, 'height' => 1241],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
			$img1024 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 1025, 'height' => 1025],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_MD"]["FILE_VALUE"]["SRC"];
			$img1300 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 1301, 'height' => 1301],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
			$img1600 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 1601, 'height' => 1601],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
			$img2500 = CFile::ResizeImageGet(
					$first["PREVIEW_PICTURE"]["ID"],
					['width' => 2501, 'height' => 2501],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true,
					"",
					"",
					30
			)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];

			?>
			<div class="owl-slider-placeholder">
				<picture id="">
					<source media="(min-width: 1600px )"
							srcset="<?= $img2500 ?: "https://via.placeholder.com/25000x768" ?>">
					<source media="(min-width: 1300px )"
							srcset="<?= $img1600 ?: "https://via.placeholder.com/1600x768" ?>">
					<source media="(min-width: 1024px )"
							srcset="<?= $img1300 ?: "https://via.placeholder.com/1300x768" ?>">
					<source media="(min-width: 768px )"
							srcset="<?= $img1024 ?: "https://via.placeholder.com/1023x465" ?>">
					<source media="(min-width: 400px )"
							srcset="<?= $img768 ?: "https://via.placeholder.com/768x768" ?>">
					<img src="<?= $img400 ?: "https://via.placeholder.com/400x400" ?>" alt="<?= $first['NAME'] ?>">
				</picture>

			</div>
			<?php
		}
		?>
		<div class="equipment__list owl-carousel" data-owl_id="<?= $id_comp ?>">
			<?php
			foreach ($arResult['ITEMS'] as $arItem) {
				?>
				<div style="background-image: url(<?= CFile::GetPath($arItem['PREVIEW_PICTURE']) ?>);" class="owl_element">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="tail-equipment"
						   >
							<div class="tail-equipment__title">
								<?= $arItem['NAME'] ?>
							</div>
						</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<script>
			owl_param['<?=$id_comp?>'] = <?=CUtil::PhpToJSObject($arResult["jsParams"])?>;
	</script>
	<div class="button__container">
		<a href="/oborudovanie/" class="button button--def equipment__button">cмотреть все оборудование</a>
	</div>

	<?php
}
