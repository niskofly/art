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

$curent_page = $APPLICATION->GetCurPage();
?>
<div class="zs-modal">
	<?php
	foreach ($arResult["ITEMS"] as $key => $arItem) {
		$page_ar = $arItem['PROPERTIES']['PAGE_SHOW']["VALUE"];
		$rec = $arItem['PROPERTIES']['RECURSIVE']["VALUE"] == "Y";
		$test = $arItem['PROPERTIES']["SHOW_FOR_ADMIN"]["VALUE"] == "Y";
		/*if ($test && !$USER->IsAdmin()) {
			continue;
		}*/
		$show = false;
		if ($page_ar) {
			foreach ($page_ar as $page) {
				if ($rec) {
					$pos = strpos($curent_page, $page);
					if ($pos === 0) {
						$show = true;
					}
				} elseif ($page == $curent_page) {
					$show = true;
				}
				if ($show) {
					break;
				}
			}
		} else {
			$show = true;
		}
		if (!$show) {
			continue;
		}
		$name_id = "popupid_" . $arItem['ID'];

		if ($arItem["DETAIL_PICTURE"]["SRC"]) {
			$banner = CFile::ResizeImageGet(
				$arElement["DETAIL_PICTURE"]["ID"],
				array(
					'width' => $arItem["DISPLAY_PROPERTIES"]["WIDTH"]['VALUE'] ?: "600",
					'height' => $arItem["DISPLAY_PROPERTIES"]["HEIGHT"]['VALUE'] ?: "500"
				),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				false,
				["name" => "sharpen", "precision" => 0],
				false,
				85
			);

			if (!isset($banner['src'])) {
				$banner['src'] = $arItem["DETAIL_PICTURE"]["SRC"];
			}
		}
		if ($arItem["PREVIEW_PICTURE"]["SRC"]) {
			$bg_image = CFile::ResizeImageGet(
				$arElement["PREVIEW_PICTURE"]["ID"],
				array(
					'width' => $arItem["DISPLAY_PROPERTIES"]["WIDTH"]['VALUE'] ?: "600",
					'height' => $arItem["DISPLAY_PROPERTIES"]["HEIGHT"]['VALUE'] ?: "500"
				),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				false,
				["name" => "sharpen", "precision" => 0],
				false,
				85
			);

			if (!isset($bg_image['src'])) {
				$bg_image['src'] = $arItem["PREVIEW_PICTURE"]["SRC"];
			}
		}

		$style_item = "";
		if ($arItem["DISPLAY_PROPERTIES"]["HEIGHT"]['VALUE']) {
			$style_item .= ' height: ' . $arItem["DISPLAY_PROPERTIES"]["HEIGHT"]['VALUE'] . 'px;';
		}
		if ($arItem["DISPLAY_PROPERTIES"]["WIDTH"]['VALUE']) {
			$style_item .= ' width: ' . $arItem["DISPLAY_PROPERTIES"]["WIDTH"]['VALUE'] . 'px;';
		}
		if ($arItem["DISPLAY_PROPERTIES"]["BG_COLOR"]['VALUE']) {
			$style_item .= ' background-color: ' . $arItem["DISPLAY_PROPERTIES"]["BG_COLOR"]['VALUE'] . ';';
		}

		$style_content = "";
		if ($arItem["PREVIEW_PICTURE"]) {
			$style_content .= 'background-image: url(' . $bg_image['src'] . ');';
		}
		if ($arItem["DISPLAY_PROPERTIES"]["COLOR"]['VALUE']) {
			$style_content .= ' color: ' . $arItem["DISPLAY_PROPERTIES"]["COLOR"]['VALUE'] . ';';
		}

		$close_color = '';
		if ($arItem["DISPLAY_PROPERTIES"]["CLOSE_COLOR"]['VALUE']) {
			$close_color = 'style="border-color: ' . $arItem["DISPLAY_PROPERTIES"]["CLOSE_COLOR"]['VALUE'] . '"';
		}

		?>
		<noindex>
			<div id="<?= $name_id ?>" class="zs-modal__item"
				 data-order="<?= ++$key ?>"
				 data-timeout="<?= $arItem["DISPLAY_PROPERTIES"]["JS_TIMEOUT_START"]['VALUE'] ?: "60"; ?>"
				<?php
				if ($arItem["DISPLAY_PROPERTIES"]["JS_TIMEOUT_REPEAT"]['VALUE'] !== "") {
					?>
					data-repeat="<?= $arItem["DISPLAY_PROPERTIES"]["JS_TIMEOUT_REPEAT"]['VALUE']; ?>"
					<?php
				}
				?>
                 data-ignore="<?=($test?1:'' )?>"
				 data-fade="<?= $arItem["DISPLAY_PROPERTIES"]["JS_TIME_FADEOUT"]['VALUE'] ?: "500"; ?>"
				 data-close="1000"
				 style="<?= $style_item ?>"
			>
				<div class="zs-modal__content" style="<?= $style_content ?>">
					<div class="zs-modal__close" <?= $close_color ?>></div>
					<?php
					if ($arItem["DETAIL_PICTURE"]["SRC"]) {
						if ($arItem["DISPLAY_PROPERTIES"]["LINK"]['VALUE']) {
							?>
							<a <?= $arItem["DISPLAY_PROPERTIES"]["TARGET_BLANK"]['VALUE'] ? 'target="_blank"' : ''; ?>
								href="<?= $arItem["DISPLAY_PROPERTIES"]["LINK"]['VALUE'] ?>" class="zs-modal__image"
								style="<?= $style_content ?>">
								<img src="<?= $banner['src'] ?>" alt="<?= $arItem["NAME"] ?>">
							</a>
							<?php
						} else {
							?>
							<span class="zs-modal__image" style="<?= $style_content ?>">
                                <img src="<?= $banner['src'] ?>" alt="<?= $arItem["NAME"] ?>">
                            </span>
							<?php
						}
					} else {
						?>
						<div class="zs-modal__text" style="<?= $style_content ?>">
							<?= $arItem["PREVIEW_TEXT"]; ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</noindex>
		<?php
	}
	?>
</div>
