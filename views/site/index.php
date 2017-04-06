<?php
namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\Carousel;
use yii\web\Session;

$session = new Session;
$session->open();

$this->title = 'Суши на дом в ' . $session->get('city') . '"';
$this->registerMetaTag(['name' => 'description', 'content' => 'ресторан японской кухни в Воронеже: суши, роллы, лапша по лучшей цене. Самая быстрая доставка суши на дом! Где быстро заказать суши с доставкой в г. Воронеж?']);
$this->registerMetaTag(['name' => 'keywords', 'content' => 'доставка суши воронеж, заказ суши воронеж, суши роллы воронеж']);


?>
<?php if (isset($reg))
    echo '<script>alert("Поздравляем! Вы успешно зарегистрированы")</script>'
?>

<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg">


        </div>
        <div class="wrapper">
            <div class="main-firstscreen__ninja">
                <img src="../img/home/ninja.png" alt="">
                <div class="main-firstscreen__ninja-popup">
                    <div class="ninja-popup__close">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="mb10">
                        <strong class="h3">Терпение,<br>только терпение<br>...</strong>
                    </div>
                    <strong class="text-red h4">Уже скоро мы сможем<br>Вас порадовать<br>чудесными блюдами…</strong>
                </div>
            </div>
            <?php echo \Yii::$app->view->renderFile('@app/views/entry/index.php'); ?>
        </div>

    </section>

    <section class="main-content">

        <div class="wrapper">
            <div class="row main-content__row">
                <div class="col-5 main-content__col">
                    <div class="main-content__title-big medium text-white mb20">
                        Доставка суши в г. <?= $session->get('city') ?>
                    </div>
                    <div class="text-white medium mb40 h3">
                        <?= $text[0]['content_mainblock_lead'] ?>
                    </div>
                    <div class="medium text-brown"><?= $text[0]['content_mainblock_text'] ?></div>
                </div>
                <div class="col-7 main-content__col">
                    <div class="mb50">
                        <div class="main-content__img">
                            <img src="/img/home/advantages-1.png" alt="">
                        </div>
                        <div class="main-content__descr">
                            <div class="h1 text-white mb15">
                                Как заказать суши на дом в г. <?= $session->get('city') ?>?
                            </div>
                            <div class="text-brown">
                                Заказать суши на дом в г. <?= $session->get('city') ?> вы можете с помощью нашего сайта,
                                либо позвонив по телефону. Наши операторы с удовольствием проконсультируют Вас по нашему
                                меню, текущим акциям и условиям доставки и оплаты.
                            </div>
                        </div>
                    </div>
                    <div class="mb50">
                        <div class="main-content__img">
                            <img src="/img/home/advantages-2.png" alt="">
                        </div>
                        <div class="main-content__descr">
                            <div class="h1 text-white mb15">
                                <?= $text[0]['content-block2'] ?>
                            </div>
                            <div class="text-brown">
                                Все блюда в нашем ресторане начинают готовить исключительно после оформления Вашего
                                заказа, что гарантирует неизменно высокое качество каждого заказа. Для приготовления
                                суши г. <?= $session->get('city') ?> мы используем только качественные ингредиенты от
                                проверенных поставщиков и производителей.
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="main-content__img">
                            <img src="/img/home/advantages-3.png" alt="">
                        </div>
                        <div class="main-content__descr">
                            <div class="h1 text-white mb15">
                                <?= $text[0]['content-block3'] ?>
                            </div>
                            <div class="text-brown">
                                Все блюда в нашем ресторане начинают готовить исключительно после оформления Вашего
                                заказа, что гарантирует неизменно высокое качество каждого заказа. Для приготовления
                                суши г. <?= $session->get('city') ?> мы используем только качественные ингредиенты от
                                проверенных поставщиков и производителей.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
