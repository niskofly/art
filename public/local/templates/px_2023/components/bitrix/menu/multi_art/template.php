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

$this->setFrameMode(true); ?>

<style>

	.multilevel-nav__item--third-parent {
		display: none;
	}

	.multilevel-nav__item--third {
		display: none;
	}

	.menu-left__item {
		width: 285px;
		padding: 20px;
	}

	.menu-left__link {
		color: #5A5A5A;
		font-weight: 700;
		transition: 0.3s;
	}

	.menu-left__link:hover{
		color: #0AB6B6;
	}

	.menu-left__arrow path{
		transition: 0.3s;
	}

	.menu-left__item:hover .menu-left__arrow path{
		fill: #0AB6B6;
	}


	.menu-left__arrow path:hover{
		color: #0AB6B6;
	}

	.menu-left__item--active{
		color: #0AB6B6;
	}

	.menu-left__item {
		display: flex;
		justify-content: space-between;
		cursor: pointer;
	}

	.menu-left__arrow {
		margin-left: 20px;
	}

	.menu-left > .menu-left__item:first-of-type{
		display: none;
	}

	.multilevel-nav__item--second-parent .menu-left__link, .multilevel-nav__item--second .menu-left__link{
		font-weight: 400;
	}

	.multilevel-nav__item--third-parent .menu-left__link, .multilevel-nav__item--third .menu-left__link{
		font-weight: 300;
	}

	.multilevel-nav__item--second .menu-left__arrow, .multilevel-nav__item--third .menu-left__arrow{
		display: none;
	}












</style>
<ul class="menu-left">
	<?php
	foreach ($arResult as $arItem) {
		$class = '';

		if ($arItem["IS_PARENT"]) {
			if ($arItem['DEPTH_LEVEL'] == 2) {
				$class .= ' multilevel-nav__item--first-parent';
			}

			if ($arItem['DEPTH_LEVEL'] == 3) {
				$class .= ' multilevel-nav__item--second-parent';
			}

			if ($arItem['DEPTH_LEVEL'] == 4) {
			$class .= ' multilevel-nav__item--third-parent';
			}
		}

		if (!$arItem["IS_PARENT"]) {
			if ($arItem['DEPTH_LEVEL'] == 2) {
				$class .= ' multilevel-nav__item--first';
		}

		if ($arItem['DEPTH_LEVEL'] == 3) {
				$class .= ' multilevel-nav__item--second';
		}

		if ($arItem['DEPTH_LEVEL'] == 4) {
				$class .= ' multilevel-nav__item--third';
			}

	}

		?>
		<li class="menu-left__item <?= !empty($arItem['SELECTED']) ? "menu-left__item--active" : "" ?><?= trim(
				$class
		) ?>">
			<a class="menu-left__link" href="<?= $arItem['LINK'] ?>"
			   title="<?= $arItem['TEXT'] ?>"><?= $arItem['TEXT'] ?></a>
			<div class="menu-left__arrow">
				<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
					<g clip-path="url(#clip0_1273_17126)">
						<path d="M0.937178 9.06267L0.937179 0.937673C0.937148 0.883532 0.951186 0.830311 0.977914 0.783227C1.00464 0.736143 1.04314 0.696811 1.08965 0.669085C1.13615 0.641359 1.18906 0.626191 1.24319 0.625067C1.29732 0.623943 1.35081 0.636902 1.39843 0.662673L8.89843 4.72517C8.94804 4.75195 8.98948 4.79165 9.01837 4.84006C9.04725 4.88847 9.0625 4.9438 9.0625 5.00017C9.0625 5.05655 9.04725 5.11187 9.01837 5.16029C8.98948 5.2087 8.94804 5.2484 8.89843 5.27517L1.39843 9.33767C1.35081 9.36344 1.29732 9.3764 1.24319 9.37528C1.18906 9.37415 1.13615 9.35899 1.08965 9.33126C1.04314 9.30354 1.00464 9.2642 0.977913 9.21712C0.951186 9.17004 0.937148 9.11681 0.937178 9.06267Z"
							  fill="#5A5A5A"/>
					</g>
					<defs>
						<clipPath id="clip0_1273_17126">
							<rect width="10" height="10" fill="white"/>
						</clipPath>
					</defs>
				</svg>
			</div>
		</li>
		<?php
	}

	?>
</ul>
