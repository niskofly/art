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

$DISPLAY_DATE = explode(' ', $arResult['DISPLAY_ACTIVE_FROM']);
$DATE = explode('.', $arResult['ACTIVE_FROM']);

?>

<style>

</style>

<?
//pre($arResult['PROPERTIES']['DATE_IMAGE']['VALUE'])?>
<div class="b7">
	<div class="c1">

		<div class="b7_c">
			<table class="b7_t">
				<tr>
					<td class="b7_td">
						<img class="b7_f" src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>"
							 alt="<?= $arResult['NAME'] ?>"/>
					</td>
					<td class="b7_td">
						<time class="b7_c1"
							  datetime="<?= $DB->FormatDate(
								  $arResult['ACTIVE_FROM'],
								  CSite::GetDateFormat("SHORT"),
								  "YYYY-MM-DD"
							  ) ?>">
							<div class="b7_w1"
								 style="background-image:url('<?= SITE_TEMPLATE_PATH ?>/assets/img/seasons/<?= $DATE[1] ?>.jpg')">
								<?= $DISPLAY_DATE[0] ?>
							</div>
							<div class="b7_w2">
								<div class="b7_w2-t">
									<?php
									$month = preg_split('#(?<!^)(?!$)#u', $DISPLAY_DATE[1]);

									foreach ($month as $letter) {
										?>
										<div class="b7_w2-td">
											<?= $letter ?>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="b7_w3">
								<?= $DISPLAY_DATE[2] ?>
							</div>
						</time>
						<?php
						// pre($arResult['PROPERTIES']['SOURCE']);
						if ($arResult['PROPERTIES']['SOURCE']['VALUE']) {
							?>
							<div class="b7_w4">
                                <span class="b7_w4-1">
                                    ИСТОЧНИК:
                                </span>
								<?php
								if ($arResult['PROPERTIES']['SOURCE']['~DESCRIPTION']) {
									?>
									<a class="b8_w3-a" target="_blank" rel="nofollow"
									   href="http://<?= $arResult['PROPERTIES']['SOURCE']['~DESCRIPTION'] ?>">
										<?= $arResult['PROPERTIES']['SOURCE']['VALUE'] ?>
									</a>
									<?php
								} else {
									?>
									<div class="b8_w3">
										<?= $arResult['PROPERTIES']['SOURCE']['VALUE'] ?>
									</div>
									<?php
								} ?>
							</div>
							<?php
						} ?>
					</td>
				</tr>
			</table>
		</div>
		<?= $arResult['DETAIL_TEXT'] ?>
		<br><br><br>
		<a href="/articles/"><?= GetMessage("T_NEWS_DETAIL_BACK") ?></a><br><br>

	</div>
</div>
