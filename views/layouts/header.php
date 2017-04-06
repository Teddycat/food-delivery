<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Session;
use yii\widgets\MaskedInput;
use app\models\City;
use app\models\Category;
use app\models\Menu;
use app\models\Schedule;
use app\models\Filial;
use app\models\Choosen;
use app\models\EntryForm;
use app\models\Registration;
use yii\widgets\ActiveForm;

$session = new Session;
$session->open();

$sche = new Schedule;
$fil = new Filial;
$times = $sche->getty($session->get('city'));
$session->set('times', $times);
$phone = $fil->getty($session->get('city'));
$session->set('phone', $phone);

$city = new City;
$category = new Category;
$menu = new Menu;
$chos = new Choosen;
$regis = new Registration;
$result['cities'] = $city->getty();
$getId = $city->getid($session->get('city'));
$name = $category->getShow($getId);
$menu = $menu->getty();
$log = $session['login'];
$user_info = $regis->getty($log);
$ordering = $chos->counter($user_info[0]['registration_unique']);
$identity = Yii::$app->getUser()->getIdentity();
?>
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '559083297609477',
                xfbml: true,
                version: 'v2.7'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <header>
        <div class="header-topline">
            <div class="wrapper">
                <div class="text-center">
                    <strong>САЙТ НАХОДИТСЯ В РАЗРАБОТКЕ.</strong>
                    <span>ПРИНОСИМ ИЗВИНЕНИЯ ЗА ВРЕМЕННЫЕ НЕУДОБСТВА</span>
                </div>
            </div>
        </div>
        <div class="header-nav">
            <div class="wrapper">
                <div class="dropdown header-dropdown left">
                    <div class="header-dropdown__btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-map-marker mr15 h3"></i><span
                            class="link mr15"><?= $session->get('city') ?></span><i class="fa fa-angle-down"></i>
                    </div>
                    <!--                <form action="">
                                        <input type="text" value="Воронеж" class="header-dropdown__btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-map-marker mr15 h3"></i><span class="link mr15">Воронеж</span><i class="fa fa-angle-down"></i>
                      </form>-->
                    <div class="dropdown-menu header-dropdown__menu" role="menu">
                        <div class="mb40 open-sans semibold"><span
                                class="text-white">Здравствуйте! Ваш город <?= $session->get('city') ?>? </span><span
                                class="text-red">Да ,все верно!</span></div>
                        <ul class="dropdown-menu__row row mb40 city-list">
                            <?php foreach ($result as $key => $value): ?>
                                <?php foreach ($value as $item): ?>
                                    <li class="city-item dropdown-menu__col col-4"><a href="javascript:void(0)"
                                                                                      onclick="setplace(this)"
                                                                                      place="<?= $item['city_name'] ?>"
                                                                                      class="city-link"><?= $item['city_name'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                        <div class="open-sans semibold mb5"><span class="text-white">Ищете пути развития бизнеса?</span>
                        </div>
                        <div class="open-sans semibold"><span class="text-white">Вы можете ознакомиться с </span><a
                                href="/business"><span class="text-red">партнерской программой</span></a></div>
                    </div>
                </div>
                <nav class="main-nav right">
                    <ul class="main-nav__list">
                        <?php foreach ($menu as $key): ?>
                            <li class="main-nav__item"><a href="<?= $key['menu_link'] ?>"
                                                          class="main-nav__link link"><?= $key['menu_name'] ?></a></li>
                        <?php endforeach; ?>
                        <li class="main-nav__item"><i class="fa fa-user text-white mr10">
                                <?php if (isset($_SESSION['name'])) { ?>
                                <a data-toggle="modal" href="<?= Yii::$app->request->hostInfo ?>/profile"
                                   class="main-nav__link link"></i><?= $_SESSION['name'] ?></a>
                            <?php } else { ?>
                                <a data-toggle="modal" href="#signModal" class="main-nav__link link"></i> Личный
                                    кабинет</a>
                            <?php } ?>


                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-midline">
                <div class="wrapper">
                    <div class="header-schedule clearfix">
                        <div class="header-schedule-item h5 bold text-black">
                            <i class="fa fa-clock-o"></i>
                            <div class="header-schedule__time mb15">
                                Работаем <span class="header-schedule__time-begin"> с 11:00 до 00:00</span>
                            </div>
                            <div class="header-schedule__day uppercase">
                                <a href="javacript:void(0)" onclick="schedule(this)" id="mon"
                                   class="header-schedule__day-item">ПН</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="tue"
                                   class="header-schedule__day-item">Вт</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="wed"
                                   class="header-schedule__day-item">Ср</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="thur"
                                   class="header-schedule__day-item">Чт</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="fri"
                                   class="header-schedule__day-item">Пт</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="sat"
                                   class="header-schedule__day-item">Сб</a>
                                <a href="javacript:void(0)" onclick="schedule(this)" id="sun"
                                   class="header-schedule__day-item">Вс</a>
                            </div>
                        </div>
                        <div class="header-schedule-item">
                            <i class="fa fa-phone"></i> <?php $phone = $session->get('phone') ?>
                            <div class="h3 bold text-black mb10"><?= $phone[0]['filial_phone'] ?></div>
                            <a href="javacript:void(0)" onclick="showMod()"
                               class="header-call-link link h4 text-red uppercase" data-toggle="modal">перезвоните
                                мне</a>
                        </div>
                    </div>
                    <div class="logo header-logo text-center">
                        <a href="/"><img src="/img/logo-header.png" alt=""></a>
                    </div>
                    <!-- Если к  <div class="header-midline__cart-box cart-box"> добавить cart-box--active, будет активное состояние-->
                    <div class="header-midline__cart-box cart-box">
                        <!-- Если к  <div class="header-midline__cart-box cart-box"> добавить cart-box--active, будет активное состояние-->
                        <div class="cart-box__favourite">
                            <div id="theOneTitle" class="cart-box__title">
                                <strong>
                                    <?php
                                    if ($ordering == 0) {
                                        ?>
                                        В избранном
                                    <?php } else { ?>
                                        <span style="color:red">В избранном</span>
                                    <?php }
                                    ?>
                                </strong>
                            </div>
                            <?php
                            if ($ordering == 0) {
                            ?>
                            <a href="javascript:void(0)" id="theOne" class="cart-box__link"><strong>
                                    <?php } else { ?>
                                    <a href="<?= $linker ?>/profile/favorite" id="theOne"
                                       class="cart-box__link"><strong>
                                            <?php } ?>
                                            <?php

                                            if ($ordering == 0) {
                                                ?>
                                                нет блюд
                                                <?php
                                            } else {
                                                echo $ordering
                                                ?>
                                                шт.
                                                <?php
                                            }
                                            ?>

                                        </strong></a>
                        </div>
                        <div class="cart-box__cart-img"></div>
                        <div class="cart-box__order">
                            <div id="basketTitle" class="cart-box__title">
                                <strong>
                                    <?php
                                    $ordering = $session['order'];
                                    $counter = count($ordering);
                                    if ($counter == 0) {
                                        ?> Мой заказ
                                    <?php } else { ?>
                                        <span style="color:red">Мой заказ</span>
                                    <?php }
                                    ?>
                                </strong>
                            </div>
                            <?php $orderAll = $session['order'];
                            $count = count($orderAll);
                            if ($count == 0) {
                            ?>
                            <a href="javascript:void(0)" id="basket" class="cart-box__link">
                                <?php }else { ?>
                                <a href="/basket" id="basket" class="cart-box__link">
                                    <?php } ?>
                                    <strong>             <?php

                                        if ($count == 0) {
                                            ?>
                                            нет блюд
                                            <?php
                                        } else {
                                            $sum = 0;
                                            foreach ($orderAll as $key):
                                                ?>
                                                <?php $sum += $key['price']; ?>
                                                <?php
                                            endforeach;
                                            echo $count
                                            ?>
                                            шт., <?= $sum ?> руб.
                                            <?php
                                        }
                                        ?>   </strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo header-logo text-center">
            <a href="<?= Url::home(); ?>"><img src="/img/logo-header.png" alt=""></a>
        </div>

        <div class="header-categories">
            <div class="wrapper">
                <div class="header-categories__row">
                    <?php $linker = Yii::$app->request->hostInfo; ?>

                    <?php foreach ($name as $key): ?>
                        <a class="header-categories__item" href="<?= $linker ?>/set/<?= $key["category_alias"] ?>">
                            <div id="<?= $key["category_file"] ?>" class="header-categories__img">
                                <img src="/img<?= $key["category_file"] ?>"
                                     onmouseover="this.src = '/img/<?= $key["category_redfile"] ?>', this.parentNode.parentNode.children[1].style.color = 'red'"
                                     onmouseout="this.src = '/img<?= $key["category_file"] ?>', this.parentNode.parentNode.children[1].style.color = 'black'"
                                     alt="">
                            </div>
                            <span class="header-categories__text"
                                  onmouseover="this.style.color = 'red', this.parentNode.children[0].children[0].src = '/<?= $key["category_redfile"] ?>"
                                  onmouseout="this.style.color = 'black', this.parentNode.children[0].children[0].src = '/img/<?= $key["category_file"] ?>'"><?= $key["category_name"]; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </header>


    <!-- Модалка-->
    <div class="modal modal-sign" id="signModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div class="modal-title">
                        Личный кабинет
                    </div>

                </div>
                <div class="modal-body">
                    <div id="form1">
                        <?php
                        $model = new EntryForm;
                        $form = ActiveForm::begin([
                            'id' => 'signer',
                            'action' => "../entry/login",
                            //'options' => ['enctype' => 'multipart/form-data'],
                        ])
                        ?>
                        <div class="form-group">
                            <?= $form->field($model, 'email')->label(false)->textInput(['class' => 'form-input mb20', 'placeholder' => 'Ваш email']) ?>

                            <label class="input-icon">
                                <i class="fa fa-user"></i>
                            </label>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'passer')->label(false)->passwordInput(['class' => 'form-input mb20', 'placeholder' => 'Ваш пароль']) ?>
                            <label class="input-icon">
                                <i class="fa fa-lock"></i>
                            </label>
                        </div>
                        <?= Html::submitButton('Вход', ['class' => 'btn btn-red wmax mb20', 'id' => 'regas']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div id="form2">
                        <?php
                        $model = new EntryForm;
                        $form = ActiveForm::begin([
                            'id' => 'askforpass',
                            'action' => "../entry/forgot",
                            //'options' => ['enctype' => 'multipart/form-data'],
                        ])
                        ?>
                        <div class="form-group">

                            <?= $form->field($model, 'email')->label(false)->textInput(['class' => 'form-input mb20', 'placeholder' => 'Введите Ваш email']) ?>
                            <label class="input-icon">
                                <i class="fa fa-user"></i>
                            </label>
                        </div>

                        <?= Html::submitButton('Восстановить', ['class' => 'btn btn-red wmax mb20', 'id' => 'sendForg']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="mb20">
                        <?php $link = Yii::$app->request->hostInfo; ?>
                        <a href="<?= $link . '/sign' ?>" class="link"><span class="h5 text-gray">Регистрация</span></a>
                        <a href="javascript:void(0)" onclick="showForg()" class="right link"><span class="h5 text-gray">Забыли пароль?</span></a>
                    </div>

                    <div class="text-center">
                        <?php
                        if (Yii::$app->getSession()->hasFlash('error')) {
                            echo '<div class="alert alert-danger">' . Yii::$app->getSession()->getFlash('error') . '</div>';
                        }
                        ?>
                        <?php echo \nodge\eauth\Widget::widget(array('action' => 'site/login')); ?>
                        <!--                    <a href="javascript:void(0)" class="modal-social__link"><i class="fa fa-vk"></i></a>-->
                        <!--                    <a href="javascript:void(0)" class="modal-social__link"><i class="fa fa-facebook"></i></a>-->
                        <!--                    <a href="javascript:void(0)" class="modal-social__link"><i class="fa fa-odnoklassniki"></i></a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Модалка презвоните-->
    <div class="modal modal-sign" id="headerCallModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Заказать звонок</div>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <?php
                        echo MaskedInput::widget([
                            'name' => 'phone',
                            'mask' => '(999) 999-99-99',
                            'class' => 'form-input mb20',
                            'id' => 'numbero',
                        ]);
                        ?>
                        <label class="input-icon">
                            <i class="fa fa-user"></i>
                        </label>
                    </div>
                    <a href="javascript:void(0)" onclick="callerback()" class="btn btn-red wmax mb20">Перезвонить</a>
                </div>
            </div>
        </div>
    </div>

<?php if ($session->get('city') == NULL) { ?>
    <div id="cityPopup" class="popup city-popup" style="display: block;">
        <div class="popup-bg"></div>
        <div class="popup-dialog">
            <div class="popup-content">
                <a href="javascript:void(0)" class="popup-close">
                    <div class="fa fa-close"></div>
                </a>
                <div class="popup-ninja"></div>
                <div class="popup-title mb30">
                    <div class="big-title">Выберите</div>
                    <div class="small-title">город доставки:</div>
                </div>

                <div class="text-center mb40">
                    <?php foreach ($result as $key => $value): ?>
                        <?php foreach ($value as $item): ?>
                            <a href="Javascript:void(0)" onclick="setplace(this)" place="<?= $item['city_name'] ?>"
                               class="city-popup__link mr55"><?= $item['city_name'] ?> </a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>

                <div class="city-popup__partnership">Ищете пути развития бизнеса?<br>Вы можете ознакомиться с <a
                        href="javascript:void(0)" class="link text-red">партнерской программой</a></div>
            </div>
        </div>
    </div>
<?php } ?>