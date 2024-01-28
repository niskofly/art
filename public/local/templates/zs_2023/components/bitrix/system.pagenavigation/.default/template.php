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
<nav class="pagination" aria-label="Page navigation">
	<ul class="pagination__list">
		<?php
		foreach ($arResult['MOD']['PAGES'] as $page) {
			?>
			<li class="pagination__item <?= implode(' ', $page['class']); ?>">
				<?php
				if (!isset($page['url']) || $page['url'] == '') {
					?>
					<span><?= $page['label'] ?></span>
					<?php
				} else {
					?>
					<a class="pagination__link" href="<?= $page['url'] ?>"
					   title="<?= $page['name'] ?>"><?= $page['label'] ?></a>
					<?php
				}
				?>
			</li>
			<?php
		} ?>
	</ul>
</nav>
