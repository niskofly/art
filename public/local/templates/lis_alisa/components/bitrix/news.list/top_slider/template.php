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
$first = current($arResult["ITEMS"]);
$img400 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_SM"]["VALUE"],
	array('width' => 401, 'height' => 601),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
$img768 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_SM"]["VALUE"],
	array('width' => 769, 'height' => 1241),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
$img1024 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_MD"]["VALUE"],
	array('width' => 1025, 'height' => 1025),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_MD"]["FILE_VALUE"]["SRC"];
$img1300 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_LG"]["VALUE"],
	array('width' => 1301, 'height' => 1301),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
$img1600 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_LG"]["VALUE"],
	array('width' => 1601, 'height' => 1601),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
$img2500 = CFile::ResizeImageGet(
	$first["PROPERTIES"]["BANNER_LG"]["VALUE"],
	array('width' => 2501, 'height' => 2501),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
	true,
	"",
	"",
	30
)["src"] ?: $first["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];

?>


	<div class="top-slider owl-container arrow-type-2">
		<div class="top-slider-placeholder">
			<picture id="bx_3218110189_399">
				<source media="(min-width: 1600px )"
						srcset="<?= $img2500 ?: "https://via.placeholder.com/25000x768" ?>">
				<source media="(min-width: 1300px )" srcset="<?= $img1600 ?: "https://via.placeholder.com/1600x768" ?>">
				<source media="(min-width: 1024px )" srcset="<?= $img1300 ?: "https://via.placeholder.com/1300x768" ?>">
				<source media="(min-width: 768px )" srcset="<?= $img1024 ?: "https://via.placeholder.com/1023x465" ?>">
				<source media="(min-width: 400px )" srcset="<?= $img768 ?: "https://via.placeholder.com/768x768" ?>">
				<img src="<?= $img400 ?: "https://via.placeholder.com/400x400" ?>" alt="<?= $first['NAME'] ?>">
			</picture>

		</div>
		<div class="owl-carousel">
			<?php
			foreach ($arResult["ITEMS"] as $arItem) {
				//pre(CFile::ResizeImageGet($arItem["PROPERTIES"]["BANNER_LG"]["VALUE"], array('width'=>1300, 'height'=>1300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true));
				$this->AddEditAction(
					$arItem['ID'],
					$arItem['EDIT_LINK'],
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
				);
				$this->AddDeleteAction(
					$arItem['ID'],
					$arItem['DELETE_LINK'],
					CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
					array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
				);

				//$BANNER_SM = $arItem["PROPERTIES"]["BANNER_SM"]["VALUE"] ? $arItem["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"] : "https://via.placeholder.com/768x768";
				//$BANNER_MD =  $arItem["PROPERTIES"]["BANNER_MD"]["VALUE"] ? $arItem["DISPLAY_PROPERTIES"]["BANNER_MD"]["FILE_VALUE"]["SRC"] : "https://via.placeholder.com/1023x465";
				//$BANNER_LG = $arItem["PROPERTIES"]["BANNER_LG"]["VALUE"] ? $arItem["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"] : "https://via.placeholder.com/1980x768";
				$img400 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_SM"]["VALUE"],
					array('width' => 400, 'height' => 600),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
				$img768 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_SM"]["VALUE"],
					array('width' => 768, 'height' => 1240),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_SM"]["FILE_VALUE"]["SRC"];
				$img1024 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_MD"]["VALUE"],
					array('width' => 1024, 'height' => 1024),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_MD"]["FILE_VALUE"]["SRC"];
				$img1300 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_LG"]["VALUE"],
					array('width' => 1300, 'height' => 1300),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
				$img1600 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_LG"]["VALUE"],
					array('width' => 1600, 'height' => 1600),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
				$img2500 = CFile::ResizeImageGet(
					$arItem["PROPERTIES"]["BANNER_LG"]["VALUE"],
					array('width' => 2500, 'height' => 2500),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true
				)["src"] ?: $arItem["DISPLAY_PROPERTIES"]["BANNER_LG"]["FILE_VALUE"]["SRC"];
				?>

				<a class="item" href="<?= $arItem['PROPERTIES']['LINK']['VALUE'] ?>"
				   id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<picture id="bx_3218110189_399">
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
						<img src="<?= $img400 ?: "https://via.placeholder.com/400x400" ?>" alt="<?= $arItem['NAME'] ?>">
					</picture>
				</a>
				<?php
			}
			?>
		</div>
	</div>

<?
/*stefabum2110
<picture id="bx_3218110189_399">
   <source media="(max-width: 500px)" srcset="/upload/resize_cache/iblock/609/420_350_1/609a8789efeb84130be5b3afa401b51b.jpg 1x,
   /upload/resize_cache/iblock/609/840_700_1/609a8789efeb84130be5b3afa401b51b.jpg 2x">

   <source media="(min-width: 500px)" srcset="/upload/resize_cache/iblock/d42/1200_270_1/d42f854400f2a548a692412d80389e1a.jpg 1x,
   /upload/resize_cache/iblock/d42/2400_540_1/d42f854400f2a548a692412d80389e1a.jpg 2x">

   <img src="/upload/resize_cache/iblock/d42/1200_270_1/d42f854400f2a548a692412d80389e1a.jpg" alt="Календари Домики">
</picture>
*/
