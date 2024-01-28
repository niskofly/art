<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>

<div class="seofilter_show_links">
	<?
	foreach ($arResult as $category => $arItem) { ?>
		<?
		if ($arParams['SEPARATE_CATEGORIES'] == 'Y') { ?>
			<p>
		<?
		} ?>
		<b><?= $category ?>:</b>
		<?
		$i = 0;
		foreach ($arItem as $item) {
			$i++; ?>
			<?
			if ($item["ACTIVE"] == "Y") { ?>
				<span><?= $item['NAME'] ?></span><?
				if ($i != count($arItem)) { ?>,<?
				} ?>
			<?
			} else { ?>
			<a href="<?= $item['NEW_URL'] ?>" title="<?= $item['META_TITLE_WINDOW'] ?>">
				<?= $item['NAME'] ?></a><?
				if ($i != count($arItem)) { ?>,<?
				} else {
					if ($arParams['SEPARATE_CATEGORIES'] != 'Y') { ?>.<?
					}
				} ?>
			<?
			} ?>
		<?
		} ?>
		<?
		if ($arParams['SEPARATE_CATEGORIES'] == 'Y') { ?>
			</p>
		<?
		} ?>
	<?
	} ?>
</div>
