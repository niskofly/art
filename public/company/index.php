<?php
/** @var Bitrix\Main\ $APPLICATION */

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty(
		"description",
		"Платная стоматология в Одинцово. Запишитесь на приём к нашим специалистам прямо сейчас. Стоматологи со стажем более 15 лет и самое современное оборудование."
);
$APPLICATION->SetPageProperty("title", "Стоматология АРТ в Одинцово - о клинике");
$APPLICATION->SetTitle("О клинике");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/with-sidebar.css");
?>

<div class="page-company">
	<div class="container">
		<div class="with-sidebar">
			<div class="with-sidebar__sidebar-menu">
				<?
				$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"company",
						array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "left_sub",
								"COMPONENT_TEMPLATE" => "simple",
								"DELAY" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => "",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "left",
								"USE_EXT" => "Y"
						)
				); ?>
			</div>
			<div class="with-sidebar__main-content">
				<h2>Клиника стоматологии в Одинцово АРТ</h2>
				<!--div class="row items">
					  <div class=" col-md-3 col-sm-3 col-xs-4">
						  <div class="item shadow1">
							  <div class="image">
								  <div class="wrap">
									  <a href="/upload/img/about/o_kompanii_1.jpg" class="img-inside fancybox">
										  <img src="/images/preloader.gif" data-src="/upload/img/about/o_kompanii_1.jpg"
											   alt="Стоматология в Одинцово" width="200" class="img-responsive lazyload">
										  <span class="zoom"></span>
									  </a>
								  </div>
							  </div>
						  </div>
					  </div>
					  <div class=" col-md-3 col-sm-3 col-xs-4">
						  <div class="item shadow1">
							  <div class="image">
								  <div class="wrap">
									  <a href="/upload/img/about/o_kompanii_2.jpg" class="img-inside fancybox">
										  <img src="/images/preloader.gif" data-src="/upload/img/about/o_kompanii_2.jpg"
											   alt="Стоматология в Одинцово" width="200" class="img-responsive lazyload">
										  <span class="zoom"></span>
									  </a>
								  </div>
							  </div>
						  </div>
					  </div>
					  <div class=" col-md-3 col-sm-3 col-xs-4">
						  <div class="item shadow1">
							  <div class="image">
								  <div class="wrap">
									  <a href="/upload/img/about/o_kompanii_3.jpg" class="img-inside fancybox">
										  <img src="/images/preloader.gif" data-src="/upload/img/about/o_kompanii_3.jpg"
											   alt="Стоматология в Одинцово" width="200" class="img-responsive lazyload">
										  <span class="zoom"></span>
									  </a>
								  </div>
							  </div>
						  </div>
					  </div>
					  <div class=" col-md-3 col-sm-3 col-xs-4">
						  <div class="item shadow1">
							  <div class="image">
								  <div class="wrap">
									  <a href="/upload/img/about/o_kompanii_4.jpg" class="img-inside fancybox">
										  <img src="/images/preloader.gif" data-src="/upload/img/about/o_kompanii_04.jpg"
											   alt="Стоматология в Одинцово" width="200" class="img-responsive lazyload">
										  <span class="zoom"></span>
									  </a>
								  </div>
							  </div>
						  </div>
					  </div>
				  </div-->
				<ul class="spisok">
					<li><a href="#stoma">Платная стоматология в Одинцово</a></li>
					<li><a href="#doctors">Наши стоматологи</a></li>
					<li><a href="#how">Как проходит прием у стоматолога клиники АРТ </a></li>
					<li><a href="#appointment">Как попасть на прием к стоматологу клиники АРТ</a></li>
				</ul>
				<!-- img src="/upload/img/about/o_kompanii_1.jpg" style="max-width:100%" -->
				<h2 id="stoma">Платная стоматология в Одинцово</h2>
				<p>
					Мы лечим зубы, устанавливаем <a href="/uslugi/protezirovanie-zubov/">коронки</a>, <a
							href="https://artistom.ru/uslugi/implantaciya-zubov/">импланты</a> и <a
							href="https://artistom.ru/uslugi/ispravlenie-prikusa/breket-sistemy/">брекет-системы</a>
					недорого и качественно. Особенную гордость представляют работы стоматологов клиники АРТ по <a
							href="/uslugi/esteticheskaya-stomatologiya/viniry/">эстетической реставрации</a> передних зубов.
					Наши работы можно посмотреть в <a href="/pacientam/nashi-raboty/">портфолио</a> на сайте. Мы оказываем
					помощь в диагностике, лечении и <a href="/uslugi/profilaktika-i-gigiena-zubov/">профилактике</a>
					заболеваний зубов у взрослых и детей. Также доступны процедуры отбеливания и установки виниров из
					различных материалов.
				</p>
				<img src="/upload/img/about/o_kompanii_2.jpg" style="max-width:100%">
				<h2 id="doctors">Наши стоматологи</h2>
				<p>
					Зубная клиника в Одинцово предлагает услуги лучших стоматологов и ортодонтов различных категорий с
					опытом работы от 5 лет. Доктора регулярно улучшают качество своих знаний и навыков с помощью
					мастер-классов и семинаров. Все процедуры, включая диагностику, проводятся с применением качественных
					материалов и высокоточного оборудования. Врачи стоматологии в Одинцово индивидуально подходят к проблеме
					каждого клиента.
				</p>
				<p>
					Чтобы составить план лечения, доктор осмотрит ротовую полость, назначит необходимые исследования.
					Рентген зубов в Одинцово и другие инструментальные обследования выполняются на новейших аппаратах,
					позволяющих верно поставить диагноз в кратчайшие сроки.
				</p>
				<img src="/upload/img/about/o_kompanii_3.jpg" style="max-width:100%">
				<h2 id="how">Как проходит прием</h2>
				<p>
					Специалисты стоматологии в Одинцово на первом приеме расскажут обо всех этапах диагностики и лечения,
					помогут сориентироваться в плане и сроках необходимой терапии. Иногда пациенты избегают посещения врача
					из-за страха сильной боли. Напрасно: в современной зубной клинике в Одинцово применяют хорошую
					анестезию, которая убережет от неприятных ощущений как взрослых, так и детей. А вот отсутствие
					специализированной помощи может причинить серьезный вред здоровью.
				</p>
				<img src="/upload/img/about/o_kompanii_4.jpg" style="max-width:100%">
				<h2 id="appointment">Стоматология в Одинцово: как попасть на прием</h2>
				<p>
					Благодаря многочисленным положительным отзывам клиентов о нашей стоматологической клинике, мы находимся
					на высших позициях в рейтинге стоматологий в Одинцово. Поэтому нас легко найти в поиске по стоматологиям
					Одинцово. Чтобы попасть на прием, запишитесь прямо на сайте к нужному врачу!
				</p>
			</div>
		</div>
	</div>
</div>

<br><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
