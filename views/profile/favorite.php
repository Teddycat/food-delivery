<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;
use yii\bootstrap\Carousel;


$session = new Session;
$session->open();
//unset($session['order']);
?>

<!-- You may need to put some content here -->
<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>
    <section class="cabinet main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
        <div class="wrapper">
            <div class="content-wrapper">
                <!--				 include('tpl/breadcrumbs.php'); -->
                <div class="row">
                    <div class="col-3">
                        <aside class="sidebar">
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <a href="/profile" class="sidebar-link">Личные данные</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/password" class="sidebar-link">Изменить пароль</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/addresses" class="sidebar-link">Адрес доставки</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link active">Избранное</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/orders" class="sidebar-link">Мои заказы</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-8"> 
                        <div class="cabinet-title medium text-black mb20">Избранное</div> 
                       <?php foreach ($choosero as $key): ?>
                        <section thing="<?= Html::encode($key['choosen_thing']) ?>" pricer="<?= Html::encode($key['choosen_price']) ?>" idro="<?= Html::encode($key['choosen_id']) ?>" class="cart-item">
                            
                            <a href="javascript:void(0)" class="cart-item__close"><i class="fa fa-close"></i></a>
                            <div class="row">
                                
                                <div class="col-3">
                                    <img src="<?= Html::encode($key['choosen_img']) ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-9">
                                    <div class="cart-item__title">
                                        <?= Html::encode($key['choosen_name']) ?>
                                    </div>
                                    <div class="cart-item__descr">
                                        <?= Html::encode($key['choosen_desc']) ?>
                                    </div>
                                    <ul class="cart-item__prop-list clearfix">
                                        <li class="cart-item__prop-item cart-item__prop-item--weight">
                                            <?= Html::encode($key['choosen_weight']) ?> гр.
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--ccal">
                                            <?= Html::encode($key['choosen_kkal']) ?> ккал
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--price">
                                           <?= Html::encode($key['choosen_price']) ?> руб.
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--bonus">
                                            <?= Html::encode($key['choosen_balls']) ?> баллов
                                        </li>
                                    </ul>
                                    <div class="mt20">
                                        <a href="javascript:void(0)" class="btn btn-big btn-red w200">Хочу!</a>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </section>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
