<?php

use Bitrix\Main\Page\Asset;

/** @var Bitrix\Main\ $APPLICATION */
/** @var CUser $USER */

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/main_page.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/components/stories/style.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css");

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js");
$APPLICATION->SetTitle("");

?>

<div class="section-site">

	<div class="stories">
		<div class="stories__modal stories-modal">
			<div class="stories-modal__wrapper">
				<?php
				$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"stories",
						array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "N",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "Y",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array(
										0 => "NAME",
										1 => "PREVIEW_TEXT",
										2 => "PREVIEW_PICTURE",
								),
								"FILTER_NAME" => "",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "38",
								"IBLOCK_TYPE" => "aspro_medc2_content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "50",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array(
										0 => "",
								),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => "SORT",
								"SORT_BY2" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_ORDER2" => "ASC",
								"STRICT_SECTION_CHECK" => "N",
								"COMPONENT_TEMPLATE" => "advantages"
						),
						false
				); ?>
			</div>

			<button class="stories__close">
				<span></span>
			</button>
		</div>


		<div class="container">
			<div class="swiper-container stories-preview">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>

					<div class="swiper-slide">
						<div class="stories-preview__item">
							<div class="stories-preview__images">
								<img src="/local/templates/px_2023/assets/images/index-clinic.png" alt="">
							</div>
							<div class="stories-preview__name">Стоматология</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>


</div>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
