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
    <section class="news-item main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>
        <div class="wrapper">
            <div class="content-wrapper">

                <!--                     include('tpl/breadcrumbs.php'); -->
                <div class="medium-title mb10"><?= $deal['static_title'] ?></div>
                <div class="news-item">
                    <div class="clearfix">
                        <div class="news-item__date">
                            <span class="news__date-day mr5"></span>
							<span class="news__date-month mr5">

							</span>
							<span class="news__date-year mr5">

							</span>
                        </div>
                        <div class="h3 medium text-black mb20">
                            <?= $deal['static_preview'] ?>
                        </div>
                        <img src="../<?= $deal['static_img'] ?>" alt="" class="left mr20 mb20">
                        <?= $deal['static_text'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
