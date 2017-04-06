<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use  yii\web\Session;
$session = new Session;
$session->open();
?>

    <!-- You may need to put some content here -->
<?php //if(!$product) {
//    return Yii::$app->response->redirect(Url::to([Url::home()]));
//} ?>

    <div class="super-wrapper">
        <section class="main-firstscreen">
            <div class="main-firstscreen__bg"></div>
            <div class="wrapper">
                <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
            </div>
        </section>
        <section class="categories main-content">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>
            <div class="wrapper">
                <div class="categories-wrapper">
                    <!--                    <div class="breadcrumbs">-->
                    <!--                        <ul class="breadcrumbs-list clearfix">-->
                    <!--                            <li class="breadcrumbs-item">-->
                    <!--                                <a href="--><?//= Url::home(); ?><!--" class="breadcrumbs-link link">Главная</a>-->
                    <!--                            </li>-->
                    <!--                            <li class="breadcrumbs-item">--><?//= $category['category_name'] ?><!--</li>-->
                    <!--                        </ul>-->
                    <!--                    </div>-->
                
                    <div class="categories-row row">
                        <?php $count = 0?>
                        <?php foreach ($product as $key => $value): ?>
                            <div class="categories-col col-4">
                                <div class="categories-item">
                                    <a href="/set/<?= Html::encode($smak)?>/<?= Html::encode($value['product_alias']) ?> " class="categories-title">
                                        <strong><?= Html::encode($value['product_name']) ?> </strong></a>
                                    <a href="/set/<?= Html::encode($smak)?>/<?= Html::encode($value['product_alias']) ?> " class="categories-img">
                                        <img src="/../img<?= Html::encode($value['product_img']) ?> " alt="">

                                        <?php if($value['product_choice']== 1) {?>
                                            <?php $startprice = $value['product_price1']*$value['product_percent'];
                                            $midprice = round(($startprice/100));
                                            $endoprice = $value['product_price1']-$midprice;
                                            ?>
                                            <div class="sale-percent medium">
                                                <?= Html::encode($value['product_percent']) ?>%
                                            </div>
                                        <?php } else if($value['product_choice']== 2) {?>
                                            <div class="sale-percent medium">
                                                <?php $midprice = $value['product_price1']-$value['product_fixprice'];
                                                $endprice = round(($midprice*100)/$value['product_price1']);
                                                ?>
                                                <?= Html::encode($endprice) ?>%
                                            </div>
                                        <?php } ?>
                                    </a>
                                    <div class="categories-info">
                                        <div class="clearfix">
                                            <div class="left">
                                                <?php if($value['product_choice']== 1) {?>
                                                    <div class="categories-price">
                                                        <strong> <?= Html::encode($endoprice) ?></strong>
                                                        <sup class="h6 text-gray">
                                                            <?= Html::encode($value['product_price1']) ?>
                                                        </sup>
                                                    </div>
                                                <?php } else if($value['product_choice']== 2) {?>
                                                    <div class="categories-price">
                                                        <strong> <?= Html::encode($value['product_fixprice']) ?></strong>
                                                        <sup class="h6 text-gray">
                                                            <?= Html::encode($value['product_price1']) ?>
                                                        </sup>
                                                    </div>
                                                <?php } else {?>
                                                    <div class="categories-price">
                                                        <strong><?= Html::encode($value['product_price1']) ?> </strong>
                                                    </div>
                                                <?php } ?>

                                                <div class="categories-size">
                                                    <div><?= Html::encode($value['product_length']) ?>см,  <?= Html::encode($value['product_weight']) ?>гр.</div>
                                                    <div><?= Html::encode($value['product_kkal'])?>ккал/100гр. </div>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0)" class="categories__btn-order right mt10" ider="<?= Html::encode($value['product_id'])?>" price="product_price1" weight="product_weight" kkal="product_kkal" tokens="product_balls">
                                                Хочу!
                                            </a>
                                        </div>
                                        <?php if($value['product_price2'] != 0) {?>

                                            <div class="clearfix">
                                                <div class="left">
                                                    <div class="categories-price">
                                                        <strong><?= Html::encode($value['product_price2']) ?> </strong>
                                                    </div>

                                                    <div class="categories-size">
                                                        <div><?= Html::encode($value['product_length2']) ?>см,  <?= Html::encode($value['product_weight_2']) ?>гр.</div>
                                                        <div><?= Html::encode($value['product_kkal2'])?>ккал/100гр. </div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="categories__btn-order right mt10" ider="<?= Html::encode($value['product_id'])?>" price="product_price2" weight="product_weight_2" kkal="product_kkal2" tokens="product_balls2">
                                                    Хочу!
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="categories-descr">
                                        <?= $value['product_description'] ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
    </div>
    </section>

    </div>
<?php $session->close(); ?>