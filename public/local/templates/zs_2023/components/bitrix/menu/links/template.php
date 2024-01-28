<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$this->setFrameMode(true); ?>

<ul class="links">
    <?php
    foreach ($arResult as $arItem) {
        ?>
        <li class="links__item ">
            <a class="links__link <?= !empty($arItem['SELECTED']) ? "links__link--active" : "" ?>"
               href="<?= $arItem['LINK'] ?>"
               title="<?= $arItem['TEXT'] ?>">
                <span><?= $arItem['TEXT'] ?></span>
            </a>
        </li>
        <?php
    }
    ?>
</ul>