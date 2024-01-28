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
?>
<div class="default-list">
	<div class="default-list__pager">
		<?php
		if ($arParams["DISPLAY_TOP_PAGER"]) {
			echo $arResult["NAV_STRING"];
		}
		?>
	</div>
	<div class="default-list__list">
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
				array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
			);
			?>
			<div class="default-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<?php
				if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) {
					if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) { ?>
						<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><img
								class="preview_picture"
								src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
								width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
								height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
								alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
								title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
								style="float:left"
							/></a>
						<?php
					} else { ?>
						<img
							class="preview_picture"
							border="0"
							src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
							width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
							height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
							alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
							title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
							style="float:left"
						/>
						<?php
					}
				}

				if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) { ?>
					<span class="news-date-time"><?php
						echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
					<?php
				}

				if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) {
					if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) { ?>
						<a href="<?php
						echo $arItem["DETAIL_PAGE_URL"] ?>"><b><?php
								echo $arItem["NAME"] ?></b></a><br/>
						<?php
					} else { ?>
						<b><?php
							echo $arItem["NAME"] ?></b><br/>
						<?php
					}
				}

				if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) {
					echo $arItem["PREVIEW_TEXT"];
				}
				if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) { ?>
					<div style="clear:both"></div>
					<?php
				}
				foreach ($arItem["FIELDS"] as $code => $value) { ?>
					<small>
						<?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
					</small><br/>
					<?php
				}
				foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty) { ?>
					<small>
						<?= $arProperty["NAME"] ?>:&nbsp;
						<?php
						if (is_array($arProperty["DISPLAY_VALUE"])) { ?>
							<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
							<?php
						} else { ?>
							<?= $arProperty["DISPLAY_VALUE"]; ?>
							<?php
						} ?>
					</small><br/>
					<?php
				} ?>
			</div>
			<?php
		} ?>
	</div>


	<?php
	if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
		<br/><?= $arResult["NAV_STRING"]; ?>
		<?php
	} ?>
</div>
