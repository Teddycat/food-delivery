<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\web\Session;

$session = new Session;
$session->open();

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

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
                <!--				 include('tpl/breadcrumbs.php')-->
                <div class="row">
                    <div class="col-3">
                        <!-- Класс active на активной ссылке -->
                        <aside class="sidebar">
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link active">Личные данные</a>
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
                                    <a href="/profile/orders" class="sidebar-link">Мои заказы</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                    <script type="text/javascript" src="//cdn.playbuzz.com/widget/feed.js"></script>

                    <div class="col-8">
                        <div id="datas" idero="<?= Html::encode($user_info["registration_unique"]) ?>"
                             class="cabinet-title">Личные данные
                        </div>
                        <div class="row mb20">
                            <div class="col-3">
                                <div class="h3 text-gray light mt10">ФИО:</div>
                            </div>
                            <div class="col-5">
                                <input type="text" id="namer"
                                       value="<?= Html::encode($user_info["registration_name"]) ?>" class="form-input">
                            </div>
                        </div>
                        <div class="row mb20">
                            <div class="col-3">
                                <div class="h3 text-gray light mt10">Email:</div>
                            </div>
                            <div class="col-5">
                                <input type="email" id="mailer" class="form-input"
                                       value="<?= Html::encode($user_info["registration_mail"]) ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="h3 text-gray light">Телефон:</div>
                            </div>
                            <div class="col-5">
                                <div class="mb20">
                                    <?php
                                    echo MaskedInput::widget([
                                        'name' => 'phone',
                                        'mask' => '(999) 999-99-99',
                                        'value' => $user_info["registration_phone"],
                                        'options' => [
                                            'class' => 'form-input',
                                            'id' => 'phoner',
                                        ]
                                    ]);
                                    ?>

                                </div>
                                <div id="phoneTwo" class="mb20" style="display: none;">
                                    <?php
                                    echo MaskedInput::widget([
                                        'name' => 'phone',
                                        'mask' => '(999) 999-99-99',
                                        'value' => $user_info["registration_phone2"],
                                        'options' => [
                                            'class' => 'form-input',
                                            'id' => 'phoner2',
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-2">
                                <a id="phonePlus" href="javascript:void(0)" onclick="showTwo()"
                                   class="btn btn-big btn-red w45">+</a>
                            </div>
                        </div>
                        <div class="row mb20">
                            <div class="col-3">
                                <div class="h3 text-gray light mt10">Дата рождения:</div>

                            </div>
                            <div class="col-5">
                                <div class="row mb20">
                                    <div class="col-4">
                                        <?php
                                        echo DatePicker::widget([
                                            'model' => $model,
                                            'options' => [
                                                'class' => 'form-input datero',
                                                'value' => $user_info["registration_birthday"],
                                                'placeholder' => $user_info["registration_birthday"],
                                                'id' => 'day',
                                                'width' => '400'
                                            ]

                                            //'language' => 'ru',
                                            //'dateFormat' => 'yyyy-MM-dd',
                                        ]);

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb40">
                            <div class="col-3">
                                <div class="h3 text-gray light">Количество бонусов:</div>
                            </div>
                            <div class="col-5">
                                <span
                                    class="text-black medium h3"><?= Html::encode($user_info["registration_bonuses"]) ?></span>
                            </div>
                        </div>
                        <div class="row mb40">
                            <div class="col-3">
                                <div class="h3 text-gray light">Количество заказов:</div>
                            </div>
                            <div class="col-5">
                                <span class="text-black medium h3"><?= Html::encode($user_amounty["count"]) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb30">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-8">
                        <div class="cabinet-title">Пригласить друзей</div>
                        <div class="h4 light mb20">Если вам понравился наш ресторан, поделитесь этим с вашими друзьями.
                            Просто введите электронную почту вашего друга, а мы сделаем все остальное!
                        </div>
                        <div id="wrong" class="text-red profile-invite-error mb10" style="display: none;">Ваше
                            приглашение не было отправлено. Возможно, был введен некорректный email
                        </div>
                        <div id="right" class="text-red profile-invite-success mb10" style="display: none;">Письмо
                            Вашему другу успешно отправлено
                        </div>
                        <div class="row mb30">
                            <div class="col-4">
                                <input type="text" id="mailero" class="form-input">
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0)" onclick="sendero()" class="btn btn-big btn-red wmaxbnmdf">Отправить</a>
                            </div>
                        </div>
                        <div class="h4 light mb10">Или поделитесь ссылкой в вашей социальной сети:</div>
                        <?php
                        $title = 'АНТИСУШИ';
                        $summary = 'БЫСТРО ЕШЬТЕ ВКУСНО';
                        $image = 'http://www.anti-sushi.ru/img/logo-header.png';
                        ?>
                        <ul class="social-list">
                            <li class="social-item"><a
                                    onclick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]=<?= $title ?>&p[url]=<?= $url ?>&p[summary]=<?= $summary ?>&p[images][0]=<?= $image ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"
                                    href="javascript:void(0)" class="social-link"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="social-item"><a
                                    onclick="window.open('http://vk.com/share.php?url=<?= Url::base(true) ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"
                                    href="javascript:void(0)" class="social-link"><i class="fa fa-vk"></i></a></li>
                        </ul>
                    </div>
                </div>
                <hr class="mb30 mt20">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-8">
                        <a href="javascript:void(0)" id="saver" onclick="savero()" class="btn btn-red btn-big w20000">Сохранить</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


</div>
