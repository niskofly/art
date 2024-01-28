<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<?php
$this->setFrameMode(true); ?>
<?php
$arItemFilter = CMedc2::GetCurrentElementFilter($arResult['VARIABLES'], $arParams);

global $APPLICATION;
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animation/animate.min.css');

$arElement = CCache::CIblockElement_GetList(
	array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')),
	$arItemFilter,
	false,
	false,
	array(
		'ID',
		"IBLOCK_ID",
		'PREVIEW_TEXT',
		'IBLOCK_SECTION_ID',
		'PREVIEW_PICTURE',
		'DETAIL_PICTURE',
		'DETAIL_PAGE_URL',
		'LIST_PAGE_URL',
		'PROPERTY_LINK_PROJECTS',
		'PROPERTY_LINK_GOODS',
		'PROPERTY_LINK_REVIEWS',
		'PROPERTY_LINK_STAFF',
		'PROPERTY_LINK_SERVICES',
		'PROPERTY_LINK_PRICES',
		'PROPERTY_LINK_QUESTIONS',
		'PROPERTY_LINK_SALE',
		'PROPERTY_OUR_WORKS',
		'PROPERTY_BLOCK_1',
		'PROPERTY_BLOCK_1_PRICE',
		'PROPERTY_BLOCK_3',
		'PROPERTY_BLOCK_4',
		'PROPERTY_BLOCK_2',
		'PROPERTY_VK_PIXEL',
	)
);

//global $USER;
//if ($USER->IsAdmin()) {
//	echo "<pre>";
//	print_r($arElement['PROPERTY_VK_PIXEL_VALUE']);
//	echo "</pre>";
//}

if ($arElement['PROPERTY_VK_PIXEL_VALUE'] === 'Y') {
	?>
	<<!-- Pixel -->
	<script type="text/javascript">
		(function(d, w) {
			var n = d.getElementsByTagName('script')[0],
				s = d.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'https://victorycorp.ru/index.php?ref=' + d.referrer + '&page=' + encodeURIComponent(w.location.href);
			n.parentNode.insertBefore(s, n);
		})(document, window);
	</script>
	<!-- /Pixel -->
	<?php
}

global $UF_BLOCK_1, $UF_BLOCK_1_PRICE, $UF_BLOCK_3, $UF_BLOCK_4, $UF_BLOCK_2;
$UF_BLOCK_1 = $arElement["~PROPERTY_BLOCK_1_VALUE"]["TEXT"];
$UF_BLOCK_1_PRICE = $arElement["PROPERTY_BLOCK_1_PRICE_VALUE"];
$UF_BLOCK_3 = $arElement["~PROPERTY_BLOCK_3_VALUE"]["TEXT"];
$UF_BLOCK_4 = CFile::GetPath($arElement["PROPERTY_BLOCK_4_VALUE"]);
$UF_BLOCK_2 = $arElement["~PROPERTY_BLOCK_2_VALUE"]["TEXT"];

if (!$arElement) {
	header("HTTP/1.1 404 Not Found");
}
if ($arParams["SHOW_NEXT_ELEMENT"] == "Y") {
	$arSort = array(
		$arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
		$arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
	);
	$arElementNext = array();

	$arAllElements = CCache::CIblockElement_GetList(
		array(
			$arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
			$arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
			'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y'),
		), array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"SECTION_ID" => $arElement["IBLOCK_SECTION_ID"]
		/*, ">ID" => $arElement["ID"]*/
	),
		false,
		false,
		array('ID', 'DETAIL_PAGE_URL', 'IBLOCK_ID', 'SORT')
	);
	if ($arAllElements) {
		$url_page = $APPLICATION->GetCurPage();
		$key_item = 0;
		foreach ($arAllElements as $key => $arItemElement) {
			if ($arItemElement["DETAIL_PAGE_URL"] == $url_page) {
				$key_item = $key;
				break;
			}
		}
		if (strlen($key_item)) {
			$arElementNext = $arAllElements[$key_item + 1];
		}
		if ($arElementNext) {
			if ($arElementNext["DETAIL_PAGE_URL"] && is_array($arElementNext["DETAIL_PAGE_URL"])) {
				$arElementNext["DETAIL_PAGE_URL"] = current($arElementNext["DETAIL_PAGE_URL"]);
			}
		}
	}
}
?>
<?
global $arTheme ?>
<div class="row">
	<?
	if ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
	<div class="col-md-9 col-sm-12 col-xs-12 content-md">
		<?
		CMedc2::get_banners_position('CONTENT_TOP'); ?>
		<?
		elseif ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
		<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
			<?
			CMedc2::ShowPageType('left_block') ?>
		</div>
		<div class="col-md-9 col-sm-12 col-xs-12 content-md">
			<?
			CMedc2::get_banners_position('CONTENT_TOP'); ?>
			<?
			endif; ?>

			<?
			if (!$arElement && $arParams['SET_STATUS_404'] !== 'Y'): ?>
				<div class="alert alert-warning"><?= GetMessage("ELEMENT_NOTFOUND") ?></div>
			<?
			elseif (!$arElement && $arParams['SET_STATUS_404'] === 'Y'): ?>
				<?
				CMedc2::goto404Page(); ?>
			<?
			else: ?>
				<?
				// rss
				if ($arParams['USE_RSS'] !== 'N') {
					CMedc2::ShowRSSIcon($arResult['FOLDER'] . $arResult['URL_TEMPLATES']['rss']);
				} ?>
				<?
				CMedc2::AddMeta(
					array(
						'og:description' => $arElement['PREVIEW_TEXT'],
						'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(
							($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])
						) : false),
					)
				); ?>
				<div class="detail <?= ($templateName = $component->{'__template'}->{'__name'}) ?>">
					<?
					if ($arParams["USE_SHARE"] == "Y" && $arElement): ?>
						<div class="share top <?= ($arParams['USE_RSS'] !== 'N' ? 'rss-block' : ''); ?>">
							<div class="shares-block">
								<script type="text/javascript" src="//yastatic.net/share2/share.js" async="async"
												charset="utf-8"></script>
								<div class="ya-share2"
										 data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
							</div>
						</div>
						<script type="text/javascript">
							$('h1').addClass('shares');
							$(document).ready(function() {
								if ($('a.rss').length)
									$('a.rss').before($('.share.top'));
								else
									$('h1').before($('.share.top'));
							});
						</script>
					<?
					endif; ?>

					<style>
						.block-btn .hidden-btn {
							display: none;
						}
					</style>

					<ul class="block-btn anchor-list">

						<li class="anchor-list__item">
							<a class="anchor-list__item-link block-btn" href="#desc">Об услуге</a>
						</li>

						<li class="anchor-list__item">
							<a class="anchor-list__item-link block-btn" href="#price-block">Цены</a>
						</li>

						<li class="anchor-list__item">
							<a class="anchor-list__item-link block-btn" href="#specialists">Специалисты</a>
						</li>

						<li class="anchor-list__item block-btn hidden-btn">
							<a class="anchor-list__item-link" href="#questions-and-answers-block">Вопросы и ответы</a>
						</li>

						<li class="anchor-list__item block-btn hidden-btn">
							<a class="anchor-list__item-link" href="#comment-block">Отзывы</a>
						</li>

					</ul>

					<script>
						$(document).ready(function() {
							//////// hide or show tabs by content existence (PRE-OG)
							// questions-and-answers-block
							if ($('#questions-and-answers-block').length > 0) {
								$('.block-btn [href="#questions-and-answers-block"]').parent().css('display', 'inline-block');
							}
							// faq
							if ($('#comment-block').length > 0) {
								$('.block-btn [href="#comment-block"]').parent().css('display', 'inline-block');
							}
						});
					</script>

					<?
					//element ?>
					<?
					@include_once('page_blocks/' . $arParams["ELEMENT_TYPE_VIEW"] . '.php'); ?>


					<?
					if (!empty($arElement["PROPERTY_OUR_WORKS_VALUE"])): ?>

						<?
						if (!is_array($arElement["PROPERTY_OUR_WORKS_VALUE"])) {
							$propOurWorks[] = $arElement["PROPERTY_OUR_WORKS_VALUE"];
						} else {
							$propOurWorks = $arElement["PROPERTY_OUR_WORKS_VALUE"];
						}

						asort($propOurWorks);
						foreach ($propOurWorks as $workId) {
							$rsElementWork = CIBlockElement::GetByID($workId);
							if ($arElementWork = $rsElementWork->GetNext()) {
								if ($arElementWork["ACTIVE"] == "Y") {
									$arWorks = array();
									$res = CIBlockElement::GetProperty(
										26,
										$workId,
										"sort",
										"asc",
										array("CODE" => "PHOTO", "ACTIVE" => "Y")
									);
									while ($ob = $res->GetNext()) {
										if ($ob['VALUE']) {
											$arWorks[] = $ob['VALUE'];
										}
									}

									$arResult['OUR_WORKS'] = [];
									foreach ($arWorks as $i => $fileID) {
										$arResult['OUR_WORKS'][] = array(
											'DETAIL' => ($arPhoto = CFile::GetFileArray($fileID)),
											'PREVIEW' => CFile::ResizeImageGet(
												$fileID,
												array('width' => 1500, 'height' => 1500),
												BX_RESIZE_PROPORTIONAL_ALT,
												true
											),
											'THUMB' => CFile::ResizeImageGet(
												$fileID,
												array('width' => 60, 'height' => 60),
												BX_RESIZE_IMAGE_EXACT,
												true
											),
										);
									}
									?>

									<?
									// works links
									?>
									<div class="wraps works-block fixed">
										<div class="wraps galerys-block fixed">
											<!--<span class="switch_gallery"></span>-->
											<div class="title small-gallery twosmallfont"><?= count(
													$arResult['OUR_WORKS']
												) . '&nbsp;' ?>
												фото
											</div>
											<div class="title big-gallery twosmallfont"><span
													class="slide-number">1</span>
												/ <?= count($arResult['OUR_WORKS']) ?></div>
											<div class="big-gallery-block thmb1 flexslider unstyled row bigs"
													 id="slider"
													 data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, "sync": ".gallery-wrapper .small-gallery", "counts": [1, 1, 1], "smoothHeight": true}'>
												<ul class="slides items">
													<?
													foreach ($arResult['OUR_WORKS'] as $i => $arPhoto): ?>
														<li class="col-md-12 item">
															<?
															// /images/preloader.gif ?>
															<img loading="lazy"
																	 src="<?= $arPhoto['PREVIEW']['src'] ?>"
																	 class="img-responsive inline"
																	 title="<?= $arPhoto['TITLE'] ?>"
																	 alt="<?= $arPhoto['ALT'] ?>"/>
															<div class="title-image"><?= $arPhoto['TITLE'] ?></div>
															<a href="<?= $arPhoto['DETAIL']['SRC'] ?>" class="fancybox"
																 rel="gallery" target="_blank"
																 title="<?= $arPhoto['TITLE'] ?>">
																<span class="zoom"></span>
															</a>
														</li>
													<?
													endforeach; ?>
												</ul>
											</div>
											<div class="small-gallery-block">
												<div class="front bigs">
													<div class="items row">
														<?
														foreach ($arResult['OUR_WORKS'] as $i => $arPhoto): ?>
															<div class="col-md-3 col-sm-4 col-xs-6">
																<div class="item">
																	<div class="wrap">
																		<img loading="lazy"
																				 src="<?= $arPhoto['PREVIEW']['src'] ?>"
																				 class="img-responsive inline lazyload"
																				 title="<?= $arPhoto['TITLE'] ?>"
																				 alt="<?= $arPhoto['ALT'] ?>"/>
																	</div>
																</div>
															</div>
														<?
														endforeach; ?>
													</div>
												</div>
											</div>

											<div style="margin-top:10px;">
												<?
												$res = CIBlockElement::GetByID($workId);
												if ($ar_res = $res->GetNext()) {
													if ($ar_res['PREVIEW_TEXT']) {
														echo $ar_res['PREVIEW_TEXT'];
													}
												}
												?>
											</div>
											<?
											$rsPropDoctor = CIBlockElement::GetProperty(
												26,
												$workId,
												"sort",
												"asc",
												array("CODE" => "DOCTOR", "ACTIVE" => "Y")
											);
											if ($arPropDoctor = $rsPropDoctor->Fetch()) {
												$doctorId = $arPropDoctor["VALUE"];
											}

											if ($doctorId) {
												$rsDoctor = CIBlockElement::GetList([],
													["IBLOCK_ID" => 4, "ID" => $doctorId],
													false,
													false,
													["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_POST"]);

												if ($arDoctor = $rsDoctor->GetNext()) {  // echo "<pre>"; print_r($arDoctor); echo "</pre>";?>
													<div class="property doctor" style="text-align: center;">
														<a href="<?= $arDoctor["DETAIL_PAGE_URL"] ?>"><?= $arDoctor["NAME"] ?></a>
														<b><?= $arDoctor["PROPERTY_POST_VALUE"] ?></b>
													</div>
													<?
												}
											}
											?>
										</div>


									</div>
									<?
								} // если элемент наших работ ACTIVE=Y
							} // if($arElementWork = $rsElementWork->GetNext())
						} // foreach($propOurWorks as $workId)
						?>
					<?
					endif; ?>


				</div>
				<?
				if (is_array($arElement['IBLOCK_SECTION_ID']) && count($arElement['IBLOCK_SECTION_ID']) > 1) {
					CMedc2::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
				}
				?>
			<?
			endif; ?>
			<div style="clear:both"></div>
			<?
			if ($arParams["SHOW_NEXT_ELEMENT"] == "Y"): ?>
				<div class="row links-block">
					<div class="col-md-12 links">
						<a class="back-url url-block dark_link twosmallfont"
							 href="<?= $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['news'] ?>"><i
								class="fa fa-angle-left"></i><span><?= ($arParams["T_PREV_LINK"] ? $arParams["T_PREV_LINK"] : GetMessage(
									'BACK_LINK'
								)); ?></span></a>
						<?
						if ($arElementNext): ?>
							<a class="next-url url-block" href="<?= $arElementNext['DETAIL_PAGE_URL'] ?>"><i
									class="fa fa-angle-right"></i><span><?= ($arParams["T_NEXT_LINK"] ? $arParams["T_NEXT_LINK"] : GetMessage(
										'NEXT_LINK'
									)); ?></span></a>
						<?
						endif; ?>
					</div>
				</div>
			<?
			else: ?>
				<div class="row">
					<div class="col-md-6 share">
						<?
						if ($arParams["USE_SHARE"] == "Y" && $arElement): ?>
							<div class="shares-block">
								<span class="text"><?= GetMessage('SHARE_TEXT') ?></span>
								<script type="text/javascript" src="//yastatic.net/share2/share.js" async="async"
												charset="utf-8"></script>
								<div class="ya-share2"
										 data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
							</div>
						<?
						endif; ?>
					</div>
					<div class="col-md-6">
						<a class="back-url url-block dark_link twosmallfont"
							 href="<?= $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['news'] ?>"><i
								class="fa fa-angle-left"></i><span><?= ($arParams["T_PREV_LINK"] ? $arParams["T_PREV_LINK"] : GetMessage(
									'BACK_LINK'
								)); ?></span></a>
					</div>
				</div>
			<?
			endif; ?>
			<?
			if ($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"): ?>
			<?
			CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
		</div><?
		// class=col-md-9 col-sm-9 col-xs-8 content-md?>
		<?
		elseif ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"): ?>
		<?
		CMedc2::get_banners_position('CONTENT_BOTTOM'); ?>
	</div><?
// class=col-md-9 col-sm-9 col-xs-8 content-md?>
	<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
		<?
		CMedc2::ShowPageType('left_block') ?>
	</div>
<?
endif; ?>
</div>


