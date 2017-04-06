<?php
namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\HelloWidget;
use yii\widgets\ActiveForm;
use yii\bootstrap\Carousel;
use yii\web\Session;
$session = new Session;
$session->open();
$this->registerMetaTag([
    'title' => $oner['news_title'],
    'decription' => $oner['news_content'],
    'keywords' => $oner['news_keywords'],
]);
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
                <div class="medium-title mb10"><?= $contacts['static_title'] ?> (<?= $session['city'] ?>)</div>
                <div class="news-item">
                    <div class="clearfix">
                        <div class="news-item__date">
                            <span class="news__date-day mr5"></span>

                        </div>
                        <?= $contacts['static_text'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
