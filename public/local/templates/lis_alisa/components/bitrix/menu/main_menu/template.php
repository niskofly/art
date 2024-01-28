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
$this->addExternalCss(SITE_TEMPLATE_PATH . '/assets/components/buttons/close.css');
?>

<ul class="full-menu__one-menu">
	<?
	foreach ($arResult as $arItem) { ?>
		<li class="<?= !empty($arItem['SELECTED']) ? "selected" : "" ?>"><a href="<?= $arItem['LINK'] ?>"
																			title="<?= $arItem['TEXT'] ?>"><?= $arItem['TEXT'] ?></a>
		</li>
		<?
	} ?>
</ul>

<?
/*
<li>Разработка веб-проектов</li>
<li>Техническая поддержка</li>
<li>Реклама и SEO</li>
<li>Дизайн</li>
<li>Портфолио</li>
*/ ?>
