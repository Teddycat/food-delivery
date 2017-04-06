<?php

//use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use  yii\web\Session;
use yii\widgets\MaskedInput;
$session = new Session;
$session->open();
?>


<?php $this->registerJsFile('js/basket.js'); ?>
<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>
    <?php if ($ordering != NULL) { ?>
        <section class="cart main-content">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
            <div class="wrapper">
                <div class="content-wrapper">
                    <div class="breadcrumbs">
                        <ul class="breadcrumbs-list clearfix">
                            <li class="breadcrumbs-item">
                                <a href="<?= Url::home(); ?>" class="breadcrumbs-link link">Главная</a>
                            </li>
                            <li class="breadcrumbs-item">Корзина</li>  
                        </ul>
                    </div>
                    <div class="cart-title medium text-black mb20" id="minimum" minim="">Корзина</div>
                    <div class="text-black mb10">Ваши персональные данные:</div>
                    <div class="mb40"> 
                        <div class="row mb20">
                            <div class="col-4">
                                <div class="content__form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="light h3 mt10">
                                                <span class="text-gray">Пользователь:</span><span class="text-red">*</span>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <?php $namer = $session->get('name');
                                            if(strlen($namer)<1)
                                                $namer = "Новый пользователь";
                                            ?>
                                            <input type="text" id="user" class="form-input" value="<?php echo $namer ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-4"> 
                                <div class="content__form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="light h3 mt10">
                                                <span  class="text-gray">Ваш город:
                                                </span><span class="text-red">*</span>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            
                                            <div class="form-input" id="city"><?= $session->get('city') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="content__form-group">
                                    <div class="row">
                                        <div class="col-4" style="padding-right: 0;">
                                            <div class="light h3 mt10">
                                                <span  class="text-gray">Ваш телефон:</span><span class="text-red">*</span>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                             <?php
                                    echo MaskedInput::widget([
                                        'name' => 'phone',
                                        'mask' => '(999) 999-99-99',                                        
                                        'options' => [
                                            'class' => 'form-input mb15',
                                            'value' => $user_info[0]["registration_phone"],
                                            'id' => 'phone',
                                        ]
                                    ]);
                                    ?>
                                            <div class="h5"><span class="text-red">* </span><span class="text-gray">- обязательны к заполению</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="cart__time-delivery h3 mt10">
                                    <span class="text-gray">Время доставки: </span><span id="setTime">0 минут
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $count=0; $county=0;
                    ?>
                    <?php foreach ($price1 as $item=>$value): ?>
                        <?php $tempo = 99999999999; ?>
                    <?php foreach ($ordering as $key): ?>
                            <?php if($item == intval($key['product_id'])) {?>
                            <?php if($tempo != intval($key['product_id'])) {?>

                        <section iderow="<?= $key['product_id'] ?>" wprice="product_price1" class="cart-item">
                            <a href="javascript:void(0)" class="cart-item__closer"><i class="fa fa-close"></i></a>
                            <div class="row">
                                <div class="col-3">
                                    <img src="/img<?= $key['product_img'] ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-7">
                                    <div class="cart-item__title">
                                        <?= $key['product_name'] ?> (целая порция)
                                    </div>
                                    <div class="cart-item__descr">
                                        <?= $key['product_description']?>
                                    </div>
                                    <ul class="cart-item__prop-list clearfix">
                                        <li class="cart-item__prop-item cart-item__prop-item--weight">
                                            <?= $key['weight'] ?> гр.
                                            <?php $weight1 = $key['weight']*$value?>
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--ccal">
                                            <?= $key['kkal'] ?>  ккал
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--price">
                                            <?= $key['price'] ?> руб.
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--bonus">
                                            <?php if($key['product_isbonus'] != 0) {
                                            $bon = round((($session['tokens'])*$key['price'])/100);
                                            ?>
                                            <?= $bon ?> баллов
                                            <?php } else {?>
                                            0 баллов
                                            <?php }?>
                                        </li>
                                        <li class="cart-item__prop-item cart-item__prop-item--comment">
                                            <a href="javascript:void(0)" onclick="$(this).next('.cart-item__order-comment').slideToggle();">Комментарий к заказу</a>
                                            <div class="cart-item__order-comment mt10">
                                                <textarea name="" id="" cols="30" rows="5" class="form-input no-resize mb10"></textarea>
                                                <div class="clearfix">
                                                    <a href="javascript:void(0)" onclick="bnm(this, true)" class="btn btn-red left mr10">Готово</a>
                                                    <a href="javascript:void(0)" onclick="bnm(this,false)" class="btn btn-gray left">Отмена</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <div money="<?= $key['price'] ?>" class="mt65 text-center">
                                        <input class="cypher" type="number" num="<?= $key['product_number'] ?>" min="0" value="<?= $value ?>" data-toggle="input-num">
                                        <div  class="cart-item__price light mt15"><?= $key['price']*$value ?> руб.</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                                <?php $tempo = intval($key['product_id'])?>

                                <?php } ?>
                            <?php } ?>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php foreach ($price2 as $item=>$value): ?>
                    <?php $tempo = 99999999999; ?>
                    <?php foreach ($ordering as $key): ?>
                    <?php if($item == intval($key['product_id'])) {?>
                    <?php if($tempo != intval($key['product_id'])) {?>
                                <section iderow="<?= $key['product_id'] ?>" wprice="product_price2"  class="cart-item">
                                    <a href="javascript:void(0)" class="cart-item__closer"><i class="fa fa-close"></i></a>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="/img<?= $key['product_img'] ?>" alt="" class="img-responsive">
                                        </div>
                                        <div class="col-7">
                                            <div class="cart-item__title">
                                                <?= $key['product_name']?> (1/2 порции)
                                            </div>
                                            <div class="cart-item__descr">
                                                <?= $key['product_description'] ?>
                                            </div>
                                            <ul class="cart-item__prop-list clearfix">
                                                <li class="cart-item__prop-item cart-item__prop-item--weight">
                                                    <?= $key['weight'] ?> гр.
                                                    <?php $weight2 = $key['weight']*$value?>
                                                </li>
                                                <li class="cart-item__prop-item cart-item__prop-item--ccal">
                                                    <?= $key['kkal'] ?>  ккал
                                                </li>
                                                <li class="cart-item__prop-item cart-item__prop-item--price">
                                                    <?= $key['price'] ?> руб.
                                                </li>
                                                <li class="cart-item__prop-item cart-item__prop-item--bonus">
                                                    <?php if($key['product_isbonus'] != 0) {
                                                        $bon = round((($session['tokens'])*$key['price'])/100);
                                                        ?>
                                                        <?= $bon ?> баллов
                                                    <?php } else {?>
                                                        0 баллов
                                                    <?php }?>
                                                </li>
                                                <li class="cart-item__prop-item cart-item__prop-item--comment">
                                                    <a href="javascript:void(0)" onclick="$(this).next('.cart-item__order-comment').slideToggle();">Комментарий к заказу</a>
                                                    <div class="cart-item__order-comment mt10">
                                                        <textarea name="" id="" cols="30" rows="5" class="form-input no-resize mb10"></textarea>
                                                        <div class="clearfix">
                                                            <a href="javascript:void(0)" onclick="bnm(this, true)" class="btn btn-red left mr10">Готово</a>
                                                            <a href="javascript:void(0)" onclick="bnm(this,false)" class="btn btn-gray left">Отмена</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-2">
                                            <div money="<?= $key['price'] ?>" class="mt65 text-center">
                                                <input class="cypher" type="number" num="<?= $key['product_number'] ?>" min="0" value="<?= $value ?>" data-toggle="input-num">
                                                <div  class="cart-item__price light mt15"><?= $key['price']*$value ?> руб.</div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                    <?php $tempo = intval($key['product_id'])?>

                                <?php } ?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <section class="cart-item__summary">
                        <ul class="cart-item__summary-list clearfix">
                            <li class="cart-item__summary-item cart-item__summary-item--weight">
                                <div class="medium">Общий вес:</div>
                                <div id="numGramm" class="light"></div>
                            </li>
                            <li class="cart-item__summary-item cart-item__summary-item--ccal">
                                <div class="medium">Калорийность:</div>
                                <div id="numKkal" class="light"></div>
                            </li>
                            <li class="cart-item__summary-item cart-item__summary-item--delivery">
                                <div class="medium">Доставка:</div>
                                <div id="numPrice" class="light">100 руб.</div>
                            </li>
                            <li class="cart-item__summary-item cart-item__summary-item--bonus">
                                <div class="medium">Бонусы:</div>
                                <div id="numToken" class="light"></div>
                            </li>
                            <li class="cart-item__summary-item cart-item__summary-item--sum">
                                <div class="medium">Сумма заказа:</div>
                                <div id="totalPrice" class="light"></div>
                            </li>
                        </ul>
                    </section>
                    <section class="cart-persons slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Количество персон</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
                            <div class="mb20">
                                <input id="persons" type="number" value="1" min="1">
                            </div>
                            <div class="h3 light mb15">Исходя из количества участников вашей трапезы, мы бесплатно укомплектуем:</div>
                            <ul class="cart-persons__list clearfix">
                                <li class="cart-persons__item">
                                    Салфетки
                                </li>
                                <li class="cart-persons__item">
                                    Палочки
                                </li>
                                <li class="cart-persons__item">
                                    Жевательные резинки
                                </li>
                                <li class="cart-persons__item">
                                    Зубочистки
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section class="cart-spices slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Приправы и соусы</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
                            <div class="h3 light mb20">Мы бесплатно предоставим приправы: имбирь, васаби, соевый соус исходя из размера вашего заказа и количества персон. Свыше этого количества приправы и соусы платные и стоимость заказа изменится.</div>
                            <div id="addSauce" class="cart-spices__box">
                                <div id="souses" class="row">
                                    <?php foreach ($sauce as $key => $value): ?>		
                                        <div class="col-3">
                                            <div class="cart-spices__img">
                                                <img src="/img/cart/<?= $value['sauce_img'] ?>" alt="">
                                            </div>
                                            <div class="cart-spices__name"><?= $value['sauce_name'] ?></div>
                                            <div class="cart-spices__price"><?= $value['sauce_price'] ?> </div>
                                            <div class="cart-spices__ammount">
                                                <?php if($value['amount'] == 0) {
                                                    $valuer = 99987;
                                                } else {
                                                    $valuer = $value['amount'];
                                                }
                                                ?>
                                                <input name="amountSausses" type="number" ider="<?= $value['sauce_id'] ?>" adding="<?= $valuer ?>" sum="<?= $valuer ?>" value="<?= ceil($value['amount']) ?>" min="0">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>	
                                </div>
                            </div>
                            <div class="h2 text-center"><span class="light">К стоимости вашего заказа добавляется еще</span> <span id="addPrice" class="medium">0 руб.</span></div>
                        </div>
                    </section>
                    <section class="cart-special slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Специальные предложения</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
                            <div class="categories-row row"> 
                                <?php $count = 0 ?> 
                                <?php foreach ($product as $key => $value): ?>
                                    <div class="categories-col col-4"> 
                                        <div class="categories-item">
                                            <a href="javascript:void(0)" class="categories-title">
                                                <strong><?= $value['product_name'] ?> </strong></a>
<!--                                            <div class="categories-bonus">Пирожок с глазами</div>-->
                                            <a href="javascript:void(0)" class="categories-img">
                                                <img style="min-width:100%" src="/img<?= $value['product_img'] ?> " alt="">
                                            </a>
                                            <div class="categories-info">
                                                <div class="clearfix">
                                                    <div class="left">
                                                        <div class="categories-price">
                                                            <strong><?= $value['product_price1'] ?> </strong>
                                                        </div>
                                                        <div class="categories-size">
                                                            <div><?= $value['product_length'] ?>см,  <?= $value['product_weight'] ?>гр.</div>
                                                            <div><?= $value['product_kkal'] ?>ккал/100гр. </div>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0)" class="categories__btn-order right mt10" ider="<?= $value['product_id'] ?>" img="<?= $key['product_img'] ?>" name="<?= $key['product_name'] ?>" price="product_price1" weight="product_weight" kkal="product_kkal" tokens="product_balls">
                                                        Хочу!
                                                    </a>
                                                </div>
                                                <?php if ($value['product_price2'] != 0) { ?>

                                                    <div class="clearfix">
                                                        <div class="left">
                                                            <div class="categories-price">
                                                                <strong><?= $value['product_price2'] ?> </strong>
                                                            </div>

                                                            <div class="categories-size">
                                                                <div><?= $value['product_length2'] ?>см,  <?= $value['product_weight'] ?>гр.</div>
                                                                <div><?= $value['product_kkal2'] ?>ккал/100гр. </div>
                                                            </div>
                                                        </div>
                                                        <a href="javascript:void(0)" class="categories__btn-order right mt10" ider="<?= $value['product_id'] ?>" price="product_price2" weight="product_weight_2" kkal="product_kkal2" tokens="product_balls2">
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
                    </section>
                    <div class="row">
                        <div class="col-6">
                            <section class="cart-delivery slide-toggle-item">
                                <div class="slide-toggle-header">
                                    <div class="slide-toggle-title"><input type="radio" class="cart-delivery__radio radio mr20" name="delivery-type" value="we" checked>Доставка быстрым курьером</div>
                                    <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                                </div>
                                <div class="slide-toggle-body">
                                    <form action="" class="delivery-form">
                                        										<div class="row mb20">
<!--                                                                                                                                <div class="col-4 mt10"><span class="text-gray light h3">Город</span><span class="text-red">*</span></div>-->
<!--                                                                                                                                <div class="col-6">-->
<!--                                                                                                                                        <input type="text" class="form-input" required>-->
<!--                                                                                                                                </div>-->
                                         
                                        <div class="row mb20">
                                            <div class="col-4 mt10"><span class="text-gray light h3">Улица</span><span class="text-red">*</span></div>
                                            <div class="col-6">
                                                <input id="street" city="<?= $session->get('city')?>" type="text" onkeyup="showenter(this)" class="form-input" required>
                                                <div id="livesearch"></div>
                                            </div>
                                        </div>
                                        <div class="row mb20">
                                            <div class="col-4 mt10"><span class="text-gray light h3">Дом</span><span class="text-red">*</span></div>
                                            <div class="col-8">
                                                <input id="home" onkeyup="showhome(this.value)" city="<?= $session->get('city')?>" type="text" class="form-input w80 mr20" required>
                                                <div id="livesearcher"></div>
                                            </div>
                                        </div>
                                         <div class="row mb20">
                                         <div class="col-4 mt10"><span class="text-gray light h3">Квартира/офис</span><span class="text-red">*</span></div>
                                          <div class="col-8">
                                          <input id="flat"  type="text" class="form-input w80 mr20" required>
                                         </div>
                                          </div><div class="row mb20">
                                            <div class="col-4 mt10"><span  class="text-gray light h3">Подъезд</span><span class="text-red">*</span></div>
                                            <div class="col-8">
                                                <input id="door" type="text" class="form-input w80 mr20" required>
                                                <span class="text-gray light h3">Этаж</span><span class="text-red mr20">*</span>
                                                <input id="level" type="text" class="form-input w80" required>
                                            </div>
                                        </div>
                                        <div class="row mb20">
                                            <div class="col-4 mt10"><span class="text-gray light h3">Код домофона</span></div>
                                            <div class="col-8">
                                                <input id="domophone" type="text" class="form-input w125 mr20" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 mt10"><span class="text-gray light h3">Комментарий</span></div>
                                            <div class="col-8">
                                                <textarea class="form-input no-resize mb10" name="" id="commentAdress" cols="4" rows="5"></textarea>
                                                <div class="h5"><span class="text-red">* </span><span class="text-gray">- обязательны к заполнению</span></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="h3 text-black mb10 mt20">Время доставки</div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb10">
                                                <label for="" class="radio-check">
                                                    <input type="radio" value="closeTime" class="radio mr5" name="delivery-time" checked>
                                                    <span class="radio-text"><span class="medium">На ближайшее время</span></span>
                                                </label>
                                            </div>
                                            <div class="h5 text-gray">
                                                <div class="light mb10">Ориентировочное время доставки:</div>
                                                <div id="ourTime" class="medium"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb10">
                                                <label for="" class="radio-check">
                                                    <input type="radio" value="ownTime" class="radio mr5" name="delivery-time">
                                                    <span class="radio-text"><span class="medium">Указать</span></span>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="col-3"><div class="text-center mb10">Часы</div></div>
                                                <div class="col-1"></div>
                                                <div class="col-3"><div class="text-center mb10">Минуты</div></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 text-center">
                                                    <input id="hours" type="text" class="form-input" placeholder="00" data-toggle="input-num" maxlength="2" style="text-align: center">
                                                </div>
                                                <div class="col-1">
                                                    <div class="mt10 h3 bold">:</div>
                                                </div>
                                                <div class="col-3 text-center">
                                                    <input id="minutes" type="text" class="form-input" placeholder="00" data-toggle="input-num" maxlength="2" style="text-align: center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-6">
                            <section class="cart-delivery slide-toggle-item">
                                <div class="slide-toggle-header">
                                    <div class="slide-toggle-title"><input type="radio" class="cart-delivery__radio radio mr20" value="he" name="delivery-type">Заберу заказ сам</div>
                                    <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                                </div>
                                <div class="slide-toggle-body">
                                    <div class="mb20">
                                        <div class="text-gray light">Заказ будет готов через 25-40 минут. </div>
                                        <div class="text-gray light">Мы начислим вам дополнительные 50 бонусов.</div>
                                    </div>
                                    <div class="h3 medium text-black mb15">Выберите точку, чтобы забрать заказ:</div>
                                    <div id="locations">

                                </div>
                                    <div class="cart__delivery-map">
                                        <div class="maper" style="width:500px;height:200px;overflow:hidden"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <section class="cart-bonus slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Оплата бонусами</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
                            <?php if ($session->has('bonuses')) {
                                $bonno = $session->get('bonuses');
                            } else {
                                $bonno = 0;
                            }?>
                            <div class="h3 light text-black mb20">На вашем счету:<span id="howBon" class="bold"> <?= $bonno ?></span> бонусов</div>
                            <span class="text-gray h3">Оплатить бонусами: </span><input id="bonuses" type="text" class="form-input mr10 w170" data-toggle="input-num"> <i class="fa fa-info-circle text-red mr5"></i><span class="h4 light">(Сумма оплаты бонусами не может составлять более 50% стоимости заказа)</span>
                        </div>
                    </section>
                    <section class="cart-payment slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Способ оплаты</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
<!--                            <div class="h1 mb20"><span class="light text-black">Общая сумма заказа:</span> <span id="totalOrder" idclass="bold text-red"></span></div>-->
                            <div class="row">
                                <div class="col-4">
                                    <label class="cart-payment__label">
                                        <div class="mb10"><input type="radio" value="cash" class="radio mr5" name="cart-payment" checked><span class="h3 light">Оплата наличными</span></div>
                                        <div>
                                            <span class="light text-gray h3 mr10">Сдача</span>
                                            <select name="" id="shortPay" class="form-input w240">
                                                <option>Не требуется</option>
                                                <option>Требуется</option>
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="cart-payment__label">
                                        <div class="mb10"><input type="radio" value="uncash" class="radio mr5" name="cart-payment"><span class="h3 light">Оплата безналом при получении</span></div>
                                        <div>
                                            <div class="mb10"><span class="light text-gray h3 mr10">Оплата при помощи банковской карты (расчетная, кредитная)</span></div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label class="cart-payment__label">
                                        <div class="mb10"><input type="radio" value="netcash" class="radio mr5" name="cart-payment"><span class="h3 light">Электронный платеж</span></div>
                                        <div>
                                            <select name="" id="mon" class="form-input">
                                                <option value="Yan">ЯндекКасса</option>
                                                <option value="webb">WebMoney</option>
                                            </select>

                                        </div>
                                    </label>
                                </div

                            </div>
                        </div>
                    </section>
                    <section class="cart-summary slide-toggle-item">
                        <div class="slide-toggle-header">
                            <div class="slide-toggle-title">Итоговые данные</div>
                            <a href="javascript:void(0)" class="slide-toggle-close"><i class="fa fa-sort-up"></i></a>
                        </div>
                        <div class="slide-toggle-body">
                            <div class="row">
                                <div class="col-7">
                                    <ul class="cart-summary__list">
                                        <li class="cart-summary__item h3">
                                            <div class="left light">Сумма заказа:</div>
                                            <div class="right medium" id="summaryPrice"> </div>
                                        </li>
                                        <li class="cart-summary__item h3">
                                            <div class="left light">Стоимость доставки:</div>
                                            <div class="right medium" id="summaryDeliveryPrice"> </div>
                                        </li>
                                        <li class="cart-summary__item h3">
                                            <div class="left light">Оплачено бонусами:</div>
                                            <div class="right medium" id="summaryBonusesOut">0 руб.</div>
                                        </li>
<!--                                        <li class="cart-summary__item h3">
                                            <div class="left light">Промо-код:</div>
                                            <div class="right medium" id="summaryPromo">0 руб.</div>
                                        </li>-->
                                        <li class="cart-summary__item h3">
                                            <div class="left light">Начислено бонусов: </div>
                                            <div class="right medium" id="summaryBonusesIn">0 </div>
                                        </li>
                                        <li class="cart-summary__item h3">
                                            <div class="left light">Ориентировочное время доставки:</div>
                                            <div class="right medium" id="summaryDeliveryTime"></div>
                                        </li>
                                        <li class="cart-summary__item h1 mt25">
                                            <div class="left light">Сумма оплаты:</div>
                                            <div class="right bold text-red" id="summaryPriceFinal">Выберите город, чтобы узнать</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="clearfix text-right">
                        <div class="left mt20">
                            <label>
                                <input type="checkbox" id="rulesCheck" class="checker mr5" required>
                                <span>Я прочел и согласен с <a href="/agreement" class="text-red link">условиями заказа</a></span>
                            </label>
                        </div>
                        <div class="btn btn-red btn-large">Оформить заказ</div>
                    </div>
                </div>
            </div>
        </section>
    <?php  } else { ?>
        <center><h1>КОРЗИНА ПУСТА </h1></center>
    <?php } ?>

</div>
<script>
    $('.cart-payment__label').click(function () {
        $('.cart-payment__label').removeClass('focus');
        $(this).addClass('focus');
    });
    
</script>