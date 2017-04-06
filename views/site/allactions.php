<?php
namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\HelloWidget;
use yii\widgets\ActiveForm;
use yii\bootstrap\Carousel;
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
                <?php
                $day = date('d', $actes['actions_date']);
                $month = date('m', $actes['actions_date']);
                $year = date('Y', $actes['actions_date']);
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
                <!--                     include('tpl/breadcrumbs.php'); -->
                <div class="medium-title mb10"><?= $actes['actions_title'] ?></div>
                <div class="news-item">
                    <div class="clearfix">
                        <div class="news-item__date">
                            <span class="news__date-day mr5"><?= $day ?></span>
							<span class="news__date-month mr5">
								<?= $month ?>
							</span>
							<span class="news__date-year mr5">
								<?= $year?>
							</span>
                        </div>
                        <div class="h3 medium text-black mb20">
                            <?= $actes['actions_content'] ?>
                        </div>
                        <img src="../img<?= Html::encode($actes['actions_img']) ?>" width="400" alt="" class="left mr20 mb20">
                        <?= $actes['actions_full'] ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
