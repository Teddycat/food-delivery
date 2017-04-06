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
                <!--				include('tpl/breadcrumbs.php'); -->
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
                                    <a href="/profile/favorite" class="sidebar-link">Избранное</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link active">Мои заказы</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-8">
                        <div class="cabinet-title">Мои заказы</div>
                        <table id="recentOrderTable" class="table table__recent-table mb30">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Номер заказа</th>
                                    <th>Дата</th>
                                    <th>Сумма</th>
                                    <th>Бонусы</th>
                                    <th>Статус</th>
                                    <th>Подробнее</th>
                                    <th></th>
                                </tr>
                            </thead> 
                            <?php $count = 1 ?>
                            <?php foreach ($total as $key): ?>
                                <tr class="recent-table__row">
                                    <td><a href="javascript:void(0)" class="circle-icon remove-row"><i class="fa fa-close"></i></a></td>
                                    <td><?= $count ?></td>
                                    <td><?= Html::encode($key['orders_number']) ?></td>
                                    <td><?= Html::encode($key['orders_timer']) ?> </td>
                                    <td><?= Html::encode($key['orders_total']) ?> руб.</td>
                                    <td>+ <?php echo rand(1, 150) ?></td>
                                    <td>Выполнен</td>
                                    <td><a href="javascript:void(0)" number="<?= Html::encode($key['orders_number']) ?>"  class="recent-order-open btn btn-small btn-red">Раскрыть</a><a href="javascript:void(0)" class="recent-order-close btn btn-small btn-gray">Закрыть</a></td>
                                    <td><a href="javascript:void(0)" ord="<?= Html::encode($key['orders_number']) ?>" class="circle-icon order-row"><i class="fa fa-cart-plus" style="margin-right: 2px"></i></a></td>
                                </tr>
                                <?php $count++ ?>
                            <?php endforeach; ?>
                        </table>
                        <div class="recent-order-box">
                            <div class="recent-order__title mb25 clearfix"><span class="left h1 medium text-black mr10">Заказ # <span id="recentOrderNum"></span></span><a href="javascript:void(0)" class="recent-order__close left "><i class="fa fa-close"></i></a></div>
                            <div class="cart-item">

                                <div class="recent-order__item mb50">

                                </div>

                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-11">
                                        <ul class="cart-summary__list mb50">
                                            <li class="cart-summary__item h3">
                                                <div class="left light">Адрес доставки:</div>
                                                <div class="right medium" id="recentSummaryAddress"></div>
                                            </li>
                                            <li class="cart-summary__item h3">
                                                <div class="left light">Вид оплаты:</div>
                                                <div class="right medium" id="recentSummaryCash">Наличные</div>
                                            </li>
                                            <li class="cart-summary__item h3">
                                                <div class="left light">Бонусы начислено:</div>
                                                <div class="right medium" id="recentSummaryBonusIn">150</div>
                                            </li>
                                            <li class="cart-summary__item h3">
                                                <div class="left light">Бонусы списанные:</div>
                                                <div class="right medium" id="recentSummaryBonusOut">24</div>
                                            </li>
                                            <li class="cart-summary__item h3">
                                                <div class="left light">Количество персон:</div>
                                                <div class="right medium" id="recentSummaryPersons">5</div>
                                            </li>
                                            <!--                                            <li class="cart-summary__item h3">
                                                                                            <div class="left light">Скидка:</div>
                                                                                            <div class="right medium" id="recentSummaryDiscount">1345 руб.</div>
                                                                                        </li>-->
                                            <li class="cart-summary__item h1 mt25">
                                                <div class="left light">Сумма оплаты:</div>
                                                <div class="right bold text-red" id="recentSummaryPrice">1490 руб.</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="javascript:void(0)" class="btn btn-big btn-red wmax">Повторить</a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="javascript:void(0)" class="btn btn-big btn-gray wmax">Отзыв</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

</script>