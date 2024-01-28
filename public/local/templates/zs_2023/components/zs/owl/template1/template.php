<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

/** @var CBitrixComponent $this */

/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if ($arResult['ITEMS']) {
	$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/css/owl.theme.custom.css');
	$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/buttons/style.css');

	$id_comp = uniqid("owl_", true) . "_" . $arParams["IBLOCK_ID"];
	//pre($arResult['ITEMS']);
	?>

	<div class="template1 owl_container" style="<?= $arParams["PROP_WIDTH"] ? 'width:' . $arParams["PROP_WIDTH"] . ';' : '' ?>">
		<div class="owl-carousel" data-owl_id="<?= $id_comp ?>">
			<?php
			foreach ($arResult['ITEMS'] as $arItem) {
				$styleBgColor = !$arItem['PROPERTIES']['BG_COLOR']['VALUE'] ? '' : 'background--color:' . $arItem['PROPERTIES']['BG_COLOR']['VALUE'];

				$link = $arItem['PROPERTIES']['LINK']['VALUE'] ?: '';
				$linkTarget = $arItem['PROPERTIES']['TARGET_BLANK']['VALUE'] ? 'target="_blank"' : '';

				$imageDefaultId = $arItem['PROPERTIES']['IMAGE_BIG']['VALUE'];
				$imageSmallId = $arItem['PROPERTIES']['IMAGE_SMALL']['VALUE'];

				$buttonText = $arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'] ?: '';

				$text = $arItem['PROPERTIES']['TEXT']['~VALUE']['TEXT'] ?: '';



				if ($text && $arItem['PROPERTIES']['TEXT']['VALUE']['TYPE'] === 'TEXT') {
					$text = '<p>' . $text . '</p>';
				}
				$imageDefaultArray = [];
				$imageSmallArray = [];
				if ($imageDefaultId) {
					$imageDefaultArray = CFile::ResizeImageGet(
						$imageDefaultId,
						array(
							'width' => 1920,
							'height' => 1920
						),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						false,
						array(
							"name" => "sharpen",
							"precision" => 0
						),
						false,
						85
					);
					if (!isset($imageDefaultArray['src'])) {
						$imageDefaultArray['src'] = CFile::GetPath($imageDefaultId);
					}
				}

				if ($imageSmallId) {
					$imageSmallArray = CFile::ResizeImageGet(
						$imageSmallId,
						array(
							'width' => 500,
							'height' => 500
						),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						false,
						array(
							"name" => "sharpen",
							"precision" => 0
						),
						false,
						85
					);
					if (!isset($imageSmallArray['src'])) {
						$imageSmallArray['src'] = CFile::GetPath($imageSmallId);
					}
				}

				$pictures = [
					'DEFAULT' => [
						'SRC' => $imageDefaultArray['src'],
					],
				];
				if ($imageSmallArray['src']) {
					$pictures['ITEMS'][] = [
						'max-width' => '768',
						'SRC' => $imageSmallArray['src']
					];
				}
				?>

				<div class="owl_element">
					<?php
					//if ($link && !$buttonText) {
					if ($link) {
						echo '<a href="' . $link . '" ' . $linkTarget . ' class="owl_element-link">';
					}
					?>
					<div class="top-banner" style="<?= $styleBgColor ?>">
						<picture>
							<?php
							foreach ($pictures['ITEMS'] as $picture) {
								?>
								<source media="(max-width: <?= $picture['max-width'] ?>px)"
										srcset="<?= $picture['SRC'] ?>">
								<?php
							}
							?>
							<img class="top-background" src="<?= $pictures['DEFAULT']['SRC'] ?>"
								 alt="<?= $arItem['NAME'] ?>">
						</picture>

						<?php
						if (($link && $buttonText) || $text) {
							?>
							<div class="container top-banner__content">
								<div class="top-banner__text-block">
									<?php
									if ($text) {
										?>
										<div class="top-banner__text"><?= $text ?></div>
										<?php
									}
									if ($link && $buttonText) {
										?>
										<div class="top-banner__button">
											<a class="btn btn--danger" href="<?= $link ?>"><?= $buttonText ?></a>
										</div>
										<?php
									}
									?>


								</div>
							</div>

							<?php
						}
						?>
					</div>

					<?php
					//if ($link && !$buttonText) {
					if ($link) {
						echo '</a>';
					}
					?>

				</div>
				<?php
			}
			?>
		</div>
	</div>

	<script>
			owl_param['<?=$id_comp?>'] = <?=CUtil::PhpToJSObject($arResult["jsParams"])?>;
	</script>
	<?php
}
