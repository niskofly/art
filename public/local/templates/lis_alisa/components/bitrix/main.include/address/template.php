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


if ($arParams['SCHEMA_ORG'] === "Y") {
	?>
	<a href="<?= $arParams['link'] ?>" itemprop="url"></a>
	<meta itemprop="name" content="<?= $arParams['company_name'] ?>"/>
	<?php
}
?>
<div
	class="value" <?= $arParams['SCHEMA_ORG'] === "Y" ? ' itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"' : '' ?>
	class="address">
	<?php
	if ($arParams['SCHEMA_ORG'] === "Y") {
		if (!empty($arParams['postalCode'])) {
			echo '<meta itemprop="postalCode" content="' . $arParams['postalCode'] . '" />';
		}
		if (!empty($arParams['addressCountry'])) {
			echo '<meta itemprop="addressCountry" content="' . $arParams['addressCountry'] . '" />';
		}
		if (!empty($arParams['addressLocality'])) {
			echo '<meta itemprop="addressLocality" content="' . $arParams['addressLocality'] . '" />';
		}
		if (!empty($arParams['streetAddress'])) {
			echo '<meta itemprop="streetAddress" content="' . $arParams['streetAddress'] . '" />';
		}
	}

	?>

	<div class="address-text">
		<?php
		if ($arParams['SHOW_ICON'] === "Y") {
			?>
			<span class="address__icon icon-map"></span>
			<?php
		}
		if (file_get_contents($arResult["FILE"]) && $arParams['FROM_FILE'] === "Y") {
			include($arResult["FILE"]);
		} else {
			$address = [];

			if (!empty($arParams['postalCode'])) {
				$address[] = $arParams['postalCode'];
			}
			if (!empty($arParams['addressCountry'])) {
				$address[] = $arParams['addressCountry'];
			}
			if (!empty($arParams['addressLocality'])) {
				$address[] = $arParams['addressLocality'];
			}
			if (!empty($arParams['streetAddress'])) {
				$address[] = $arParams['streetAddress'];
			}

			if (count($address) > 0) {
				echo implode(", ", $address);
			}
		}
		?>
	</div>
</div>
