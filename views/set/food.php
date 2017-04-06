<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;
use yii\bootstrap\Carousel;

$session = new Session;
$session->open();
$url = Url::to('', true);;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $servire['product_metadesc']
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $servire['product_keywords']
]);
$this->registerMetaTag([
    'name' => 'title',
    'content' => $servire['product_pagetitle']
]);
$this->registerMetaTag([
    'name' => 'og:url',
    'content' => $url
]);
$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'http://antisushi/img/product/Ds7K_IyF.jpg'
]);

?>

<!-- You may need to put some content here -->

<?php if (!$servire) {
    return Yii::$app->response->redirect(Url::to([Url::home()]));
} ?>
<div class="super-wrapper">

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
                    <div class="breadcrumbs">
                        <ul class="breadcrumbs-list clearfix">
                            <li class="breadcrumbs-item">
                                <a href="<?= Url::home(); ?>" class="breadcrumbs-link link">Главная</a>
                            </li>
                            <li class="breadcrumbs-item">
                                <a href="/../set/<?= Html::encode($category['category_alias']) ?>"
                                   class="breadcrumbs-link link"><?= $category['category_name'] ?></a>
                            </li>
                            <li class="breadcrumbs-item"><?= Html::encode($servire['product_name']) ?></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="good-img">
                                <img id="im" class="img-responsive"
                                     src="/../img<?= Html::encode($servire['product_img']) ?>" alt="">
                                <?php if ($servire['product_choice'] == 1) { ?>
                                    <?php $startprice = $servire['product_price1'] * $servire['product_percent'];
                                    $midprice = round(($startprice / 100));
                                    $endoprice = $servire['product_price1'] - $midprice;
                                    ?>
                                    <div class="sale-percent medium">
                                        <?= Html::encode($servire['product_percent']) ?>%
                                    </div>
                                <?php } else if ($$servire['product_choice'] == 2) { ?>
                                    <div class="sale-percent medium">
                                        <?php $midprice = $servire['product_price1'] - $servire['product_fixprice'];
                                        $endprice = round(($midprice * 100) / $servire['product_price1']);
                                        ?>
                                        <?= Html::encode($endprice) ?>%
                                    </div>
                                <?php } ?>
                                <!-- <div class="sale-percent medium">
                                    32 %
                                </div> -->
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="product-info">
                                <div class="product-title">
                                    <?= Html::encode($servire['product_name']) ?><br>
                                    <?php if ($servire['product_price2'] != 0) { ?>
                                        <center><a href="javascript:void(0)"
                                                   onclick="showforOne()"><?= Html::encode($servire['product_weight']) ?>
                                                гр.</a> <a>/</a>
                                            <a href="javascript:void(0)"
                                               onclick="showforTwo()"><?= Html::encode($servire['product_weight_2']) ?>
                                                гр.</a></center>
                                    <?php } ?>
                                </div>
                                <div class="row mb20">
                                    <div class="col-5">

                                        <?php if ($getty) { ?>
                                            <div class="btn btn-favourite wmax">
                                                <i class="fa fa-star one"></i>
                                                В избранном
                                            </div>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" onclick="addchoos(this)" viser="lot"
                                               ider="<?= Html::encode($servire['product_id']) ?>"
                                               namer="<?= Html::encode($servire['product_name']) ?>"
                                               descro="<?= Html::encode($servire['product_description']) ?>"
                                               class="btn btn-favourite wmax">
                                                <i class="fa fa-star-o mr5 one"></i>
                                                Добавить в избранное
                                            </a>
                                        <?php } ?>

                                    </div>
                                    <div class="product-social">
                                        <?php
                                        $title = urlencode($servire['product_full_description']);

                                        $summary = urlencode($servire['product_full_description']);
                                        $home = Url::home(true);
                                        $img = Html::encode($servire['product_img']);
                                        $image = $home . 'img' . $img;
                                        ?>

                                        <span class="mr10">Поделиться:</span>
                                        <ul class="social-list">
                                            <li class="social-item"><a
                                                    onclick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]=<?= $title ?>&p[url]=<?= $url ?>&p[summary]=<?= $summary ?>&p[images][0]=<?= $image ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"
                                                    href="javascript:void(0)" class="social-link"><i
                                                        class="fa fa-facebook"></i></a></li>
                                            <li class="social-item"><a
                                                    onclick="window.open('http://vk.com/share.php?url=<?= Url::base(true) ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"
                                                    href="javascript:void(0)" target="_blank" class="social-link"><i
                                                        class="fa fa-vk"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-ingredients">
                                    <?= $servire['product_description'] ?>
                                </div>
                                <div class="product-attributes" id="first">
                                    <?php if ($servire['product_weight'] != 0) { ?>
                                        <div class="product-attributes__item">
                                            <span class="left">Вес:</span>
                                            <span id="wi" class="right"><?= Html::encode($servire['product_weight']) ?>
                                                гр.</span>
                                        </div>
                                    <?php }
                                    if ($servire['product_length'] != 0) { ?>
                                        <div class="product-attributes__item">
                                            <span class="left">Размер:</span>
                                            <span id="li" class="right"><?= Html::encode($servire['product_length']) ?>
                                                см</span>
                                        </div>
                                    <?php }
                                    if ($servire['product_kkal'] != 0) { ?>
                                        <div class="product-attributes__item">
                                            <span class="left">Калорийность:</span>
                                            <span id="ki" class="right"><?= Html::encode($servire['product_kkal']) ?>
                                                ккал</span>
                                        </div>
                                    <?php } ?>
                                    <div class="product-attributes__item">
                                        <span class="left">Баллы:</span>

                                        <?php $pricball = round((intval($servire['product_price1']) * $session['tokens']) / 100) ?>

                                        <span id="bi" class="right">
                                            <?php if ($servire['product_isbonus'] == 1) { ?>
                                                <?= $pricball ?>
                                            <?php } else { ?>
                                                0
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row" id="firstRow">
                                    <?php if ($servire['product_choice'] == 1) { ?>
                                        <?php $startprice = $servire['product_price1'] * $servire['product_percent'];
                                        $midprice = round(($startprice / 100));
                                        $endoprice = $servire['product_price1'] - $midprice;
                                        ?>
                                        <div class="col-5"><span id="pi" class="product-price"><?= $endoprice ?>
                                                руб.</span></div>
                                    <?php } else if ($servire['product_choice'] == 2) { ?>
                                        <?php $midprice = $servire['product_price1'] - $servire['product_fixprice'];
                                        $endprice = round(($midprice * 100) / $servire['product_price1']);
                                        ?>
                                        <div class="col-5"><span id="pi"
                                                                 class="product-price"><?= $servire['product_fixprice'] ?>
                                                руб.</span></div>
                                    <?php } else { ?>
                                        <div class="col-5"><span id="pi"
                                                                 class="product-price"><?= Html::encode($servire['product_price1']) ?>
                                                руб.</span></div>
                                    <?php } ?>

                                    <div class="col-5"><a href="javascript:void(0)"
                                                          class="categories__btn-order right mt10"
                                                          ider="<?= Html::encode($servire['product_id']) ?>"
                                                          price="product_price1" weight="product_weight"
                                                          kkal="product_kkal" tokens="product_balls">ХОЧУ!</a></div>
                                </div>
                                <?php if ($servire['product_price2'] != 0) { ?>
                                    <div class="product-attributes" id="second">
                                        <?php if ($servire['product_weight_2'] != 0) { ?>
                                            <div class="product-attributes__item">
                                                <span class="left">Вес:</span>
                                                <span id="wi2"
                                                      class="right"><?= Html::encode($servire['product_weight_2']) ?>
                                                    гр.</span>
                                            </div>
                                        <?php }
                                        if ($servire['product_length2'] != 0) { ?>
                                            <div class="product-attributes__item">
                                                <span class="left">Размер:</span>
                                                <span id="li2"
                                                      class="right"><?= Html::encode($servire['product_length2']) ?>
                                                    см</span>
                                            </div>
                                        <?php }
                                        if ($servire['product_kkal2'] != 0) { ?>
                                            <div class="product-attributes__item">
                                                <span class="left">Калорийность:</span>
                                                <span id="ki2"
                                                      class="right"><?= Html::encode($servire['product_kkal2']) ?>
                                                    ккал</span>
                                            </div>
                                        <?php } ?>
                                        <div class="product-attributes__item">
                                            <span class="left">Баллы:</span>
                                            <?php $priceball = round((intval($servire['product_price2']) * $session['tokens']) / 100) ?>
                                            <span id="bi2" class="right">
                                                <?php if ($servire['product_isbonus'] == 1) { ?>
                                                    <?= $pricball ?>
                                                <?php } else { ?>
                                                    0
                                                <?php } ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row" id="secondRow">
                                        <?php if ($servire['product_choice'] == 1) { ?>
                                            <?php $startprice = $servire['product_price2'] * $servire['product_percent'];
                                            $midprice = round(($startprice / 100));
                                            $endoprice = $servire['product_price2'] - $midprice;
                                            ?>
                                            <div class="col-5"><span id="pi2" class="product-price"><?= $endoprice ?>
                                                    руб.</span></div>
                                        <?php } else if ($servire['product_choice'] == 2) { ?>

                                            <div class="col-5"><span id="pi2"
                                                                     class="product-price"><?= Html::encode($servire['product_fixprice'] / 2) ?>
                                                    руб.</span></div>

                                        <?php } else { ?>
                                            <div class="col-5"><span id="pi2"
                                                                     class="product-price"><?= Html::encode($servire['product_price2']) ?>
                                                    руб.</span></div>
                                        <?php } ?>

                                        <div class="col-5"><a href="javascript:void(0)"
                                                              class="categories__btn-order right mt10"
                                                              ider="<?= Html::encode($servire['product_id']) ?>"
                                                              price="product_price2" weight="product_weight_2"
                                                              kkal="product_kkal2" tokens="product_balls2">ХОЧУ!</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="product-describe">
                        <div class="product-describe__title">Описание</div>
                        <?= $servire['product_full_description'] ?>
                    </div>
                    <?php if (count($likes) > 0) { ?>
                        <div class="product-describe__title">Вам также понравится</div>
                    <?php } ?>
                    <div class="categories-row row">
                        <?php $count = 0 ?>
                        <?php if (count($likes) > 0) { ?>
                            <?php foreach ($likes as $key => $value): ?>
                                <?php $count++; ?>
                                <?php if ($count < 4) { ?>
                                    <?php if ($servire['product_id'] != $value['product_id']) { ?>
                                        <div class="categories-col col-4">
                                            <div class="categories-item">
                                                <a href="javascript:void(0)" class="categories-title">
                                                    <strong><?= Html::encode($value['product_name']) ?> </strong></a>
                                                <a href="javascript:void(0)" class="categories-img">
                                                    <img src="/img<?= Html::encode($value['product_img']) ?> " alt="">
                                                </a>
                                                <div class="categories-info">
                                                    <div class="clearfix">
                                                        <div class="left">
                                                            <div class="categories-price">
                                                                <strong><?= Html::encode($value['product_price1']) ?> </strong>
                                                            </div>
                                                            <div class="categories-size">
                                                                <div><?= Html::encode($value['product_length']) ?>
                                                                    см, <?= Html::encode($value['product_weight']) ?>гр.
                                                                </div>
                                                                <div><?= Html::encode($value['product_kkal']) ?>
                                                                    ккал/100гр.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="javascript:void(0)"
                                                           class="categories__btn-order right mt10"
                                                           ider="<?= Html::encode($value['product_id']) ?>"
                                                           price="product_price1" weight="product_weight"
                                                           kkal="product_kkal" tokens="product_balls">
                                                            Хочу!
                                                        </a>
                                                    </div>
                                                    <?php if ($value['product_price2'] != 0) { ?>

                                                        <div class="clearfix">
                                                            <div class="left">
                                                                <div class="categories-price">
                                                                    <strong><?= Html::encode($value['product_price2']) ?> </strong>
                                                                </div>

                                                                <div class="categories-size">
                                                                    <div><?= Html::encode($value['product_length2']) ?> </div>
                                                                    <div><?= Html::encode($value['product_kkal2']) ?> </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:void(0)"
                                                               class="categories__btn-order right mt10"
                                                               ider="<?= Html::encode($value['product_id']) ?>"
                                                               price="product_price2" weight="product_weight_2"
                                                               kkal="product_kkal2" tokens="product_balls2">
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
                                    <?php } else { ?>
                                        <?php $count--; ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php endforeach; ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
    </div>


</div>