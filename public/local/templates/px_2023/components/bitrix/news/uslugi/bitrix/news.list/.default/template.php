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


$block1 = $arResult['SERVICES'][0]['BLOCK1'];
$block2 = $arResult['SERVICES'][0]['BLOCK2'];
$block3 = $arResult['SERVICES'][0]['BLOCK3'];
$description = $arResult['SERVICES'][0]['DESCRIPTION'];
$morePhoto = $arResult['SERVICES'][0]['MORE_PHOTO'];
$staffList = $arResult['SERVICES'][0]['STAFF'];
$questionList = $arResult['SERVICES'][0]['QUESTIONS'];
?>


<?php
if (!empty($block1)): ?>
	<div><?= $block1['TEXT'] ?></div>
	<div><?= $block1['PRICE'] ?></div>
<?php
endif ?>

<div class="uslugi-row">
	<div class="uslugi-contents">


		<?php
		$dataSection = 0;
		foreach ($arResult['SERVICES'] as $services): ?>
			<div data-section="<?=$dataSection++?>" class="uslugi-content">
				<?php
				if (!empty($services['SECTIONS'])): ?>
					<ul class="uslugi-sub-sections">
						<?php
						foreach ($services['SECTIONS'] as $section): ?>
							<li class="uslugi-sub-section">
								<div class="sub-section-row">
									<div class="sub-section__icon">
										<img src="https://new.artistom.ru/upload/medialibrary/4a9/vthjo398vvx5rbtyym6880s2nmkt41tt/Frame-1976.png" alt="icon">
									</div>
									<a class="sub-section__link" href="<?= $section['SECTION_PAGE_URL'] ?>"><?= $section['NAME'] ?></a>
									<div class="sub-section__price"><?= $section['PRICE'] ?></div>
									<div class="sub-section__arrow">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
											<path d="M1 2.5L6 7.5L11 2.5" stroke="#0AB6B6" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
								</div>
								<?php
								if (!empty($section['ITEMS'])): ?>
									<ul class="uslugi-elements">
										<?php
										foreach ($section['ITEMS'] as $item): ?>
											<li class="uslugi-element">
												<a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
												<?= $item['PRICE'] ?>
											</li>
										<?php
										endforeach ?>
									</ul>
								<?php
								endif ?>
							</li>
						<?php
						endforeach ?>
					</ul>
				<?php
				endif ?>

				<?php
				if (!empty($services['ITEMS'])): ?>
					<ul class="section-elements">
						<?php
						foreach ($services['ITEMS'] as $item): ?>
							<li class="section-element">
								<a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
								<?= $item['PRICE'] ?>
							</li>
						<?php
						endforeach ?>
					</ul>
				<?php
				endif ?>
			</div>
		<?php
		endforeach ?>
	</div>
	<div class="uslugi-sections">
		<?php
		$dataFilter = 0;
		foreach ($arResult['SERVICES'] as $services): ?>
			<div data-filter="<?= $dataFilter++ ?>" class="uslugi-section__wrapper">
				<div class="menu-left__arrow">
					<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
						<g clip-path="url(#clip0_1273_17126)">
							<path d="M0.937178 9.06267L0.937179 0.937673C0.937148 0.883532 0.951186 0.830311 0.977914 0.783227C1.00464 0.736143 1.04314 0.696811 1.08965 0.669085C1.13615 0.641359 1.18906 0.626191 1.24319 0.625067C1.29732 0.623943 1.35081 0.636902 1.39843 0.662673L8.89843 4.72517C8.94804 4.75195 8.98948 4.79165 9.01837 4.84006C9.04725 4.88847 9.0625 4.9438 9.0625 5.00017C9.0625 5.05655 9.04725 5.11187 9.01837 5.16029C8.98948 5.2087 8.94804 5.2484 8.89843 5.27517L1.39843 9.33767C1.35081 9.36344 1.29732 9.3764 1.24319 9.37528C1.18906 9.37415 1.13615 9.35899 1.08965 9.33126C1.04314 9.30354 1.00464 9.2642 0.977913 9.21712C0.951186 9.17004 0.937148 9.11681 0.937178 9.06267Z"
								  fill="#5A5A5A"></path>
						</g>
						<defs>
							<clipPath id="clip0_1273_17126">
								<rect width="10" height="10" fill="white"></rect>
							</clipPath>
						</defs>
					</svg>
				</div>
				<a href="<?= $services['SECTION_PAGE_URL'] ?>"><?= $services['NAME'] ?></a>
				<div class="section-price"><?= $services['PRICE'] ?></div>
			</div>
		<?php
		endforeach ?>
	</div>
</div>
<?php
//if (!empty($block2)): ?>
<!--    --><?php
//if (!empty($block2['PICTURE'])): ?>
<!--      <div><img src="--><?php
//=$block2['PICTURE']?><!--" alt="" /></div>-->
<!--    --><?php
//endif ?>
<!--  <div>--><?php
//=$block2['TEXT']?><!--</div>-->
<?php
//endif ?>
<!---->
<!---->
<?php
//if (!empty($block3)): ?>
<!--  <div>--><?php
//=$block3['TEXT']?><!--</div>-->
<?php
//endif ?>
<!---->
<!---->
<!---->
<?php
//if (!empty($description)): ?>
<!--  <div>--><?php
//=$description?><!--</div>-->
<?php
//endif ?>
<!---->
<!---->
<?php
//if (!empty($morePhoto)): ?>
<!--    --><?php
//foreach ($morePhoto as $photo): ?>
<!--      <div><img src="--><?php
//=$photo?><!--" alt="" /></div>-->
<!--    --><?php
//endforeach ?>
<?php
//endif ?>
<!---->
<!---->
<!---->
<?php
//if (!empty($staffList)): ?>
<!--    --><?php
//foreach ($staffList as $staff): ?>
<!--    <div>-->
<!--      <h3><a href="--><?php
//=$staff['DETAIL_PAGE_URL']?><!--">--><?php
//=$staff['NAME']?><!--</a></h3>-->
<!--        --><?php
//if (!empty($staff['PREVIEW_PICTURE'])): ?>
<!--          <div><img src="--><?php
//=$staff['PREVIEW_PICTURE']?><!--" alt="" /></div>-->
<!--        --><?php
//endif ?>
<!--        --><?php
//if (!empty($staff['PROPERTY_POST_VALUE'])): ?>
<!--          <div>--><?php
//=$staff['PROPERTY_POST_VALUE']?><!--</div>-->
<!--        --><?php
//endif ?>
<!--    </div>-->
<!--    --><?php
//endforeach ?>
<?php
//endif ?>
<!---->
<!---->
<!---->
<?php
//if (!empty($questionList)): ?>
<!--    --><?php
//foreach ($questionList as $question): ?>
<!--    <div>-->
<!--        --><?php
//if (!empty($question['~PROPERTY_VOPROS_VALUE']['TEXT'])): ?>
<!--          <div><h3>--><?php
//=$question['~PROPERTY_VOPROS_VALUE']['TEXT']?><!--</h3></div>-->
<!--        --><?php
//endif ?>
<!--        --><?php
//if (!empty($question['~PROPERTY_OTVET_VALUE']['TEXT'])): ?>
<!--          <div>--><?php
//=$question['~PROPERTY_OTVET_VALUE']['TEXT']?><!--</div>-->
<!--        --><?php
//endif ?>
<!--    </div>-->
<!--    --><?php
//endforeach ?>
<?php
//endif ?>
