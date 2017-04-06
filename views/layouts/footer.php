<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;
use app\models\Filial;
use app\models\City;
$session = new Session;
$session->open();


$city = new City;
$fil = new Filial;
$justic = $city->getJustice($session->get('city'));
$phone = $fil->getty($session->get('city'));
?>
<footer>
	<div class="footer-nav">
		<div class="wrapper">
			<div class="row">
				<div class="col-4">
					<div class="footer-nav__title"><strong>Антисуши</strong></div>
					<ul class="footer-nav__list footer-nav__list-double">
						<li class="footer-nav__item"><a href="/delivery" class="footer-nav__link">Доставка и оплата</a></li>
						<li class="footer-nav__item"><a href="/vacancy" class="footer-nav__link">Вакансии</a></li>
						<li class="footer-nav__item"><a href="/actiones" class="footer-nav__link">Акции</a></li>
						<li class="footer-nav__item"><a href="/contacts" class="footer-nav__link">Контакты</a></li>
						<li class="footer-nav__item"><a href="/bonuses" class="footer-nav__link">Бонусы</a></li>
						<li class="footer-nav__item"><a href="/consumer" class="footer-nav__link">Информация для потребителей</a></li>
						<li class="footer-nav__item"><a href="/news" class="footer-nav__link">Новости</a></li>
						<li class="footer-nav__item"><a href="/business" class="footer-nav__link">Партнерская программа</a></li>
						<li class="footer-nav__item"><a href="/map" class="footer-nav__link">Карта сайта</a></li>
					</ul>
				</div>
				<div class="col-1"></div>
				<div class="col-2">
					<div class="footer-nav__title"><strong>Поддержка</strong></div>
					<ul class="footer-nav__list">
						<li class="footer-nav__item"><a href="/comment" class="footer-nav__link">Оставить отзыв</a></li>
						<li class="footer-nav__item"><a href="javascript:void(0)" onclick="showMod()" class="footer-nav__link">Обратный звонок</a></li>
					</ul>
				</div>
				<div class="col-2">
					<div class="footer-nav__title"><strong>Личный кабинет</strong></div>
					<ul class="footer-nav__list">
						<li class="footer-nav__item modal-title"><a data-toggle="modal" href="#signModal" class="footer-nav__link">Вход</a></li>
						<li class="footer-nav__item"><a href="/sign" class="footer-nav__link">Регистрация</a></li>
						<li class="footer-nav__item"><a href="javascript:void(0)" onclick="logout()" class="footer-nav__link">Выход</a></li>
					</ul>
				</div>
				<div class="col-2">
					<div class="footer-phones">
						<div><i class="fa fa-phone mr10"></i><strong>222222</strong></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-main">
		<div class="wrapper">
			<div class="row">
				<div class="col-5">
					<div class="footer-license medium"><?= $justic['city_justic'] ?>
					</div>
				</div>
				<div class="col-2">
					<div class="footer-logo">
						<a href="<?= Url::home(); ?>"><img  class="img-responsive" src="/img/logo-footer.png" alt=""></a>
					</div>
				</div>
				<div class="col-3">
					<div class="footer-payment">
						<span class="medium mr5">Способы оплаты:</span>
						<img src="/img/pay-visa.png" alt="">
						<img src="/img/pay-mastercard.png" alt="">
					</div>
				</div>
				<div class="col-2">
					<ul class="footer-social__list">
						<li class="footer-social__item">
							<a href="javascript:void(0)" class="footer-social__link"><i class="fa fa-facebook"></i></a>
						</li>
						<li class="footer-social__item">
							<a href="javascript:void(0)" class="footer-social__link"><i class="fa fa-vk"></i></a>
						</li>
						<li class="footer-social__item">
							<a href="javascript:void(0)" class="footer-social__link"><i class="fa fa-instagram"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="wrapper">
			<div class="left medium">
				© 2013-2016 Ресторан доставки. Все права защищены.
			</div>
		</div>
	</div>
</footer>