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

$pattern = "/[-a-z0-9!#$%&'*_`{|}~]+[-a-z0-9!#$%&'*_`{|}~\.=?]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/i";

$mail_src = file_get_contents($arResult["FILE"]);
$mail_clear = strip_tags($mail_src);

preg_match_all($pattern, $mail_clear, $result);
$r = array_unique(
	array_map(function ($i) {
		return $i[0];
	}, $result)
);
$mail_clear = $r[0];
if (filter_var($mail_clear, FILTER_VALIDATE_EMAIL)) {
	?>
	<a class="mail__link"
	   href="mailto:<?= $mail_clear ?>" <?= $arParams['SCHEMA_ORG'] === "Y" ? 'itemprop="email"' : ''; ?>>
		<?php
		if ($arParams['SHOW_ICON'] === "Y") {
			?>
			<span class="icon-mail"></span>
			<?php
		} ?>
		<?= $mail_src ?>
	</a>
	<?php
} else {
	echo $mail_src;
}
