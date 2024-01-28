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

use Bitrix\Main\Page\Asset;


$GLOBALS['CUR_ELEMENT_ID'] = $arParams['ELEMENT_ID'];

$GLOBALS['LINKS_FOR_STUFF'] = $arResult['PROPERTIES']['LINK_STAFF']['VALUE'];

$GLOBALS['LINKS_FOR_EQUIP'] = $arResult['PROPERTIES']['LINK_EQUIP']['VALUE'];

$GLOBALS['LINKS_FOR_REVIEWS'] = $arResult['PROPERTIES']['LINK_REVIEWS']['VALUE'];

$GLOBALS['LINK_QUESTIONS'] = $arResult['PROPERTIES']['LINK_QUESTIONS']['VALUE'];

$GLOBALS['TEXT_UPPER_STOCK1'] = $arResult['PROPERTIES']['TEXT_UPPER_STOCK1']['VALUE']['TEXT'];

$GLOBALS['TEXT_UPPER_EQUIP1'] = $arResult['PROPERTIES']['TEXT_UPPER_EQUIP1']['VALUE']['TEXT'];

$GLOBALS['TEXT_UPPER_DOCTORS1'] = $arResult['PROPERTIES']['TEXT_UPPER_DOCTORS1']['VALUE']['TEXT'];

$GLOBALS['TEXT_UPPER_REVIEWS1'] = $arResult['PROPERTIES']['TEXT_UPPER_REVIEWS1']['VALUE']['TEXT'];

$GLOBALS['EQUIPMENT_BLOCK_ELEMENT_TEXT1'] = $arResult['PROPERTIES']['EQUIPMENT_BLOCK_ELEMENT_TEXT1']['~VALUE']['TEXT'];

$GLOBALS['TEXT_UPPER_PRICE1'] = $arResult['PROPERTIES']['TEXT_UPPER_PRICE1']['VALUE']['TEXT'];


Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/services.css");

global $bannerImg;


$arrIMG = $arResult["DETAIL_PICTURE"]['ID'];

$this->SetViewTarget('bannerImage');

if ($arrIMG) {
	$image_src = CFile::GetPath($arrIMG);
	?>

	<img src="<?= $image_src ?>" alt="banner">

	<?php
} else {
	?>
	<img src="/upload/medialibrary/217/e1f01dgvjdaaw18v2avmbcsw2mach04g/izobrazhenie.png" alt="">
	<?php
}
$this->EndViewTarget('bannerImage');


global $arADV;

$arADV = $arResult['PROPERTIES']['ADVANTAGES_ELEMENT1']['~VALUE']['TEXT'];

$this->SetViewTarget('advantages');


if($arADV){
	echo $arADV
	?>

	<?php
} else{
	?>
	<ul class="advantages__list">
		<li class="advantages__item" id="bx_651765591_253267">
			<div class="advantages__icon">

				<img src="/upload/iblock/77e/1ewpev9hwxdmxiyqx1nx5vx0rn4m4ejr/Innovatsionnyy-podkhod.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Инновационный подход</span>
			<span class="advantages__description">Современное оборудование</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253269">
			<div class="advantages__icon">

				<img src="/upload/iblock/3b7/wyy6hd2195b5mn87nd2aab6hgx25pno2/Proverennye-metodiki.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Проверенные методики</span>
			<span class="advantages__description">Фокус на лучший результат</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253266">
			<div class="advantages__icon">

				<img src="/upload/iblock/6ef/s3voo01vod1zh0fkmn18k5gx6gpc5c9k/Vysokaya-kvalifikatsiya.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Высокая квалификация</span>
			<span class="advantages__description">Врачи с отличной репутацией</span>
		</li>
		<li class="advantages__item" id="bx_651765591_253268">
			<div class="advantages__icon">

				<img src="/upload/iblock/6ae/5tz42homkzse7vljftv6r2ne63225cqz/Priyatnyy-servis.svg" alt="">
				<!--					<svg class="icon">-->
				<!--						<use xlink:href="/local/templates/px_2023/assets/icons/svg-sprite.svg#--><!--"></use>-->
				<!--					</svg>-->
			</div>
			<span class="advantages__name">Приятный сервис</span>
			<span class="advantages__description">Доброжелательность и комфорт</span>
		</li>
	</ul>
	<?php

}
$this->EndViewTarget('advantages');



?>
<div class="news-detail">
	<?= $arResult['DETAIL_TEXT'] ?>
</div>
