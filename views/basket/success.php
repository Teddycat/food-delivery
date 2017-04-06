<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use  yii\web\Session;
$session = new Session;
$session->open(); 
?>
<div class="super-wrapper">
	<section class="main-firstscreen">
		<div class="main-firstscreen__bg"></div>
		<div class="wrapper">
			<?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
		</div>
	</section>
	<section class="checkout main-content">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
		<div class="wrapper"> 
			<div class="content-wrapper">
				 <ul class="breadcrumbs-list clearfix">
                            <li class="breadcrumbs-item">
                                <a href="<?= Url::home(); ?>" class="breadcrumbs-link link">Главная</a>
                            </li>
                            <li class="breadcrumbs-item">Подтверждение заказа</li>
                        </ul>
                            
				<div class="cart-title medium text-black mb20">Заказ оформлен!</div>
				<div class="text-black h1 mb20">
					<span class="light">Номер заказа: </span>
					<span class="medium"><?= Html::encode($ordero['orders_number']) ?>. </span>
					<span class="light">Пользователь: </span>
					<span class="medium"><?= Html::encode($ordero['orders_user']) ?></span>
				</div>
				<div class="h3 light mb30">С вами свяжется менеджер для подтверждения заказа. Время доставки будет указано только после подтверждения заказа.</div>
				<div class="checkout-title h1 medium mb30">Ваш заказ:</div>

				<section class="cart-item">

					<?php if($value["orders_product_price1_num"] !== '0') {?>
                                   <?php foreach ($orderProd as $key => $value): ?> 
					<div class="row">
						<div class="col-3">
							<img src="/../img<?= Html::encode($value["orders_product_img"]) ?>" alt="" class="img-responsive">
						</div>
						<div class="col-7">
							<div class="cart-item__title">
								<?= Html::encode($value["orders_product_name"]) ?>
							</div>
							<div class="cart-item__descr">
								<?= Html::encode($value["orders_product_descript"]) ?>
							</div>
							<ul class="cart-item__prop-list clearfix">
								<li class="cart-item__prop-item cart-item__prop-item--weight">
									<?= Html::encode($value["orders_product_weight"]) ?> грамм
								</li>
								<li class="cart-item__prop-item cart-item__prop-item--ccal">
									<?= Html::encode($value["orders_product_kkal"]) ?> ккал
								</li>
								<li class="cart-item__prop-item cart-item__prop-item--price">
									<?= Html::encode($value["orders_product_price"]) ?> руб.
								</li>
								<li class="cart-item__prop-item cart-item__prop-item--bonus">
									<?= Html::encode($value["orders_product_token"]) ?>
								</li>
							</ul>
						</div>
						<div class="col-2">
							<div class="mt65 text-center">
								<div class="h1 medium text-black"><?= Html::encode($value["orders_product_price1_num"]) ?> шт.</div>
								<div class="cart-item__price light mt15"><?= Html::encode($value["orders_product_price"]) ?> руб.</div>
							</div>
						</div>
					</div>
                                      <?php endforeach; ?>
					<?php } if($value["orders_product_price2_num"] !== '0') {?>
					<?php foreach ($orderProd as $key => $value): ?>
						<div class="row">
							<div class="col-3">
								<img src="/../img<?= Html::encode($value["orders_product_img"]) ?>" alt="" class="img-responsive">
							</div>
							<div class="col-7">
								<div class="cart-item__title">
									<?= Html::encode($value["orders_product_name"]) ?>
								</div>
								<div class="cart-item__descr">
									<?= Html::encode($value["orders_product_descript"]) ?>
								</div>
								<ul class="cart-item__prop-list clearfix">
									<li class="cart-item__prop-item cart-item__prop-item--weight">
										<?= Html::encode($value["orders_product_weight"]) ?> грамм
									</li>
									<li class="cart-item__prop-item cart-item__prop-item--ccal">
										<?= Html::encode($value["orders_product_kkal"]) ?> ккал
									</li>
									<li class="cart-item__prop-item cart-item__prop-item--price">
										<?= Html::encode($value["orders_product_price"]) ?> руб.
									</li>
									<li class="cart-item__prop-item cart-item__prop-item--bonus">
										<?= Html::encode($value["orders_product_token"]) ?>
									</li>
								</ul>
							</div>
							<div class="col-2">
								<div class="mt65 text-center">
									<div class="h1 medium text-black"><?= Html::encode($value["orders_product_price2_num"]) ?> шт.</div>
									<div class="cart-item__price light mt15"><?= Html::encode($value["orders_product_price"]) ?> руб.</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<?php } ?>
				</section>
				<section class="cart-spices slide-toggle-item">
					<div class="slide-toggle-header">
						<div class="slide-toggle-title">Приправы и соусы</div>
						<a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
					</div>
					<div class="slide-toggle-body">
							<div class="row">
                                                            <?php foreach ($orderSauce as $key => $value): ?> 
									<div class="col-3">
										<div class="cart-spices__img">
											<img src="/../img/cart/spice-1.jpg" alt="">
										</div>
										<div class="cart-spices__name"><?= Html::encode($value["orders_sauce_name"]) ?></div>
										<div class="cart-spices__price"><?= Html::encode($value["orders_sauce_price"]) ?> руб. </div>
										<div class="cart-spices__ammount">
											<div class="medium text-black"><?= Html::encode($value["orders_sauce_amount"]) ?> шт.</div>
										</div>
									</div>
                                                            <?php endforeach; ?>
								</div>
						</div>
					</section>
					<section class="cart-summary slide-toggle-item">
						<div class="slide-toggle-header">
							<div class="slide-toggle-title">Итоговые данные</div>
							<a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
						</div>
						<div class="slide-toggle-body">
							<div class="row">
								<div class="col-7">
									<ul class="cart-summary__list">
                                                                            <li class="cart-summary__item h3">
											<div class="left light">Количество персон:</div>
											<div class="right medium" id="summaryDeliveryTime"><?= Html::encode($ordero["orders_persons"]) ?></div>
										</li>
										<li class="cart-summary__item h3">
											<div class="left light">Сумма заказа:</div>
											<div class="right medium" id="summaryPrice"><?= Html::encode($ordero["orders_sum"]) ?></div>
										</li>
										<li class="cart-summary__item h3">
											<div class="left light">Стоимость доставки:</div>
											<div class="right medium" id="summaryDeliveryPrice"><?= Html::encode($ordero["orders_price"]) ?> руб.</div>
										</li>
										<li class="cart-summary__item h3">
											<div class="left light">Оплачено бонусами:</div>
											<div class="right medium" id="summaryBonusesOut"><?= Html::encode($ordero["orders_bonus_minus"]) ?> руб.</div>
										</li>
<!--										<li class="cart-summary__item h3">
											<div class="left light">Промо-код:</div>
											<div class="right medium" id="summaryPromo"><?= Html::encode($ordero["orders_promo"]) ?></div>
										</li>-->
										<li class="cart-summary__item h3">
											<div class="left light">Начислено бонусов:</div>
											<div class="right medium" id="summaryBonusesIn"><?= Html::encode($ordero["orders_bonus_plus"]) ?></div>
										</li>
										<li class="cart-summary__item h3">
											<div class="left light">Ориентировочное время доставки:</div>
											<div class="right medium" id="summaryDeliveryTime"><?= Html::encode($ordero["orders_timer"]) ?></div>
										</li>
                                                                                
										<li class="cart-summary__item h1 mt25">
											<div class="left light">Сумма оплаты:</div>
											<div class="right bold text-red" id="summaryPriceFinal"><?= Html::encode($ordero["orders_total"]) ?></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</section>
	</div>

	<script>
		$('.cart-payment__label').click(function() {
			$('.cart-payment__label').removeClass('focus');
			$(this).addClass('focus');
		});

		$('.cart-item__close').click(function() {
			$(this).closest('.cart-item').fadeOut('300').delay('300').remove();
		});
	</script>