<?php
namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\HelloWidget;
use yii\widgets\ActiveForm;
use yii\bootstrap\Carousel;
?>

<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>

    <section class="news-list main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>
        <div class="wrapper">
            <div class="content-wrapper">
<!--                ('tpl/breadcrumbs.php');-->
                <div class="big-title mb10">Новости</div>
                <?php $count = 0;?>
                <?php foreach ($news as $key):?>
                    <?php if($key['news_main'] == 1) {?>
                    <?php
                    $day = date('d', $key['news_date']);
                    $month = date('m', $key['news_date']);
                    $year = date('Y', $key['news_date']);
                    switch($month) {
                        case '01':
                            $month = 'января';
                            break;
                        case '02':
                            $month = 'февраля';
                            break;
                        case '03':
                            $month = 'марта';
                            break;
                        case '04':
                            $month = 'апреля';
                            break;
                        case '05':
                            $month = 'мая';
                            break;
                        case '06':
                            $month = 'июня';
                            break;
                        case '07':
                            $month = 'июля';
                            break;
                        case '08':
                            $month = 'августа';
                            break;
                        case '09':
                            $month = 'сентября';
                            break;
                        case '10':
                            $month = 'октября';
                            break;
                        case '11':
                            $month = 'ноября';
                            break;
                        case '12':
                            $month = 'декабря';
                            break;
                    }
                    ?>
                    <div class="news-list__item">
                        <div class="clearfix">
                            <div class="news-list__date">
                                <div class="news__date-day"><?= $day ?></div>
                                <div class="news__date-month">
                                    <?= $month?>
                                </div>
                                <div class="news__date-year">
                                    <?= $year ?>
                                </div>
                            </div>
                            <a href="/news/<?= Html::encode($key['news_id']) ?>" class="news-list__img">
                                <img src="img<?= Html::encode($key['news_img']) ?>" alt="" class="img-responsive">
                            </a>
                            <div class="news-list__descr">
                                <a href="javascript:void(0)" class="news-list__item-title"><?= Html::encode($key['news_title']) ?></a>
                                <div class="div news-list__item-text">
                                    <?= Html::encode($key['news_content']) ?>
                                </div>
                                <a href="/news/<?= Html::encode($key['news_id']) ?>" class="btn btn-small btn-red">Подробнее</a>
                            </div>
                        </div>

                    </div>
                <?php
                       unset($news[$count]);

                        break;
                    }?>
                    <?php $count++; ?>
                <?php endforeach; ?>
                <?php foreach ($news as $key):?>
                    <?php
                    $day = date('d', $key['news_date']);
                    $month = date('m', $key['news_date']);
                    $year = date('Y', $key['news_date']);
                    switch($month) {
                        case '01':
                            $month = 'января';
                            break;
                        case '02':
                            $month = 'февраля';
                            break;
                        case '03':
                            $month = 'марта';
                            break;
                        case '04':
                            $month = 'апреля';
                            break;
                        case '05':
                            $month = 'мая';
                            break;
                        case '06':
                            $month = 'июня';
                            break;
                        case '07':
                            $month = 'июля';
                            break;
                        case '08':
                            $month = 'августа';
                            break;
                        case '09':
                            $month = 'сентября';
                            break;
                        case '10':
                            $month = 'октября';
                            break;
                        case '11':
                            $month = 'ноября';
                            break;
                        case '12':
                            $month = 'декабря';
                            break;
                    }
                    ?>
                <div class="news-list__item">
                    <div class="clearfix">
                        <div class="news-list__date">
                            <div class="news__date-day"><?= $day ?></div>
                            <div class="news__date-month">
                                <?= $month?>
                            </div>
                            <div class="news__date-year">
                                <?= $year ?>
                            </div>
                        </div>
                        <a href="/news/<?= Html::encode($key['news_id']) ?>" class="news-list__img">
                            <img src="img<?= Html::encode($key['news_img']) ?>" alt="" class="img-responsive">
                        </a>
                        <div class="news-list__descr">
                            <a href="javascript:void(0)" class="news-list__item-title"><?= Html::encode($key['news_title']) ?></a>
                            <div class="div news-list__item-text">
                                <?= Html::encode($key['news_content']) ?>
                            </div>
                            <a href="/news/<?= Html::encode($key['news_id']) ?>" class="btn btn-small btn-red">Подробнее</a>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
                <div class="text-center mt40">
<!--                    include('tpl/pagination.php');-->
                </div>
            </div>
        </div>
    </section>
</div>