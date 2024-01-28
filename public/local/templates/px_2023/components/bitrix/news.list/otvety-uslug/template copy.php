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
?>
<div class="tile-1">
	<?php
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction(
			$arItem['ID'],
			$arItem['EDIT_LINK'],
			CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
		);
		$this->AddDeleteAction(
			$arItem['ID'],
			$arItem['DELETE_LINK'],
			CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
			array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
		);
		?>

		<div class="item">
			<div
				class="b6_c1 js-portfolio-gallery"
				id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
				style="background-image:url('<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>')"
				data-src="<?= CFile::GetPath($arItem["PROPERTIES"]['MORE_PHOTO']['VALUE'][0]) ?>"
				data-fancybox="gallery_<?= $arItem['ID'] ?>"
				data-caption="<?= $arItem['PREVIEW_TEXT'] ?>"
			>
				<div class="b6_c2">
					<h3 class="b6_h1">
						<?= $arItem["NAME"] ?>
					</h3>
					<div class="b6_w">
						<?= $arItem["PREVIEW_TEXT"] ?>
					</div>
				</div>
			</div>
		</div>

		<div class="more-photo">
			<?php
			foreach ($arItem["PROPERTIES"]['MORE_PHOTO']['VALUE'] as $key => $photo) {
				if ($key == 0) {
					continue;
				}
				?>
				<div class="js-portfolio-gallery" data-src="<?= CFile::GetPath($photo) ?>"
					 data-fancybox="gallery_<?= $arItem['ID'] ?>" data-caption="<?= $arItem['PREVIEW_TEXT'] ?>"></div>

				<?php
			} ?>

		</div>


		<?/*
                <script>
                    $(function(){
                        var images = [];
                        <?foreach ($sliderPhotos as $arImg){?>
                            images.push({
                                src: '<?=$arImg['SRC']?>',
                                opts: {
                                    caption : '<?=$arImg['DESCRIPTION']?>',
                                    thumb   : '<?=$arImg['SRC_THUMB']?>'
                                }
                            });
                        <?};?>

                        $('.js-product-image-gallery .present-image').on('click', function(){
                            var photo_num = $(this).find('img').attr('data-photo-num');
                            showFansyGallery(images, photo_num);
                        })

                    }) //document.ready END
                </script>
                */
		?>

		<?php
	}
	?>
</div>
