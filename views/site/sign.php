<?php

namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\HelloWidget;
use yii\widgets\ActiveForm;
use yii\bootstrap\Carousel;
use yii\widgets\MaskedInput;
?>

<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>
    <section class="sign main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
        <div class="wrapper"> 

            <?php
            $model = new EntryForm;
            $form = ActiveForm::begin([
                        'id' => 'signer',
                        'action' => "../entry/signer",
                            //'options' => ['enctype' => 'multipart/form-data'],
                    ])
            ?>

            <div class="content-wrapper"> 
                <!--					include('tpl/breadcrumbs.php'); -->
                <div class="cart-title medium text-black mb5">Регистрация пользователя</div>
                <div class="h5 mb30"><span class="text-red">* </span><span class="text-gray">- обязательны к заполению</span></div>
                <section class="sign-personal">
                    <div class="h2 bold mb20">Личные данные:</div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">ФИО:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'name')->label(false)->textInput(['class' => 'form-input', 'id'=> 'namer', 'placeholder' =>'Введите свое имя']) ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-4">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">E-mail:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <?= $form->field($model, 'email')->label(false)->textInput(['class' => 'form-input', 'id'=> 'mailer', 'placeholder' =>'Введите свою почту']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Телефон:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb20">
                                        <?= $form->field($model, 'phoner')->label(false)->widget(\yii\widgets\MaskedInput::className(), ['name' => 'phone', 'id'=> 'phoner', 'mask' => '(999) 999-99-99',])->textInput(['class' => 'form-input', 'placeholder' =>'Введите свой номер телефона']) ?>

                                    </div>
                                    <div id="phoneTwo" class="mb20" style="display: none;">
                                        <?= $form->field($model, 'phone2')->label(false)->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(999) 999-99-99',])->textInput(['class' => 'form-input', 'placeholder' =>'Введите еще один номер']) ?>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <a href="javascript:void(0)" id="phonePlus" class="btn btn-big btn-red w40">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-4">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Дата рождения:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <?= $form->field($model, 'birth')->label(false)->widget(\yii\jui\DatePicker::classname(), ['id'=> 'dater'])->textInput(['class' => 'form-input', 'placeholder' =>'Введите дату своего рождения']) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <hr class="mb40 mt40">
                <section class="sign-address">
                    <div class="h2 bold mb20"><span class="mr10">Адрес:</span> 
                        <?= $form->field($model, 'isaddress')->label(false)->checkbox(['label' => '', 'class' => 'checker', 'id' => 'signAdressSection']) ?> 
                    </div>
                    <div class="sign-adress-box">
                        <div class="row mb20">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="light h3 mt10">
                                            <span class="text-gray">Улица:</span><span class="text-red">*</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <?= $form->field($model, 'street')->label(false)->textInput(['class' => 'form-input', 'placeholder' =>'Введите номер улицы']) ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="light h3 mt10">

                                            <span class="text-gray">Квартира/офис:</span><span class="text-red">*</span>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <?= $form->field($model, 'flat')->label(false)->textInput(['class' => 'form-input', 'placeholder' =>'Введите номер квартиры']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="light h3 mt10">
                                            <span class="text-gray">Дом:</span><span class="text-red">*</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <?= $form->field($model, 'house')->label(false)->textInput(['class' => 'form-input', 'placeholder' =>'Введите номер дома']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <hr class="mb40 mt40">
                <section class="sign-pass">
                    <div class="h2 bold mb20">Пароль:</div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Пароль:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'passer')->label(false)->passwordInput(['class' => 'form-input', 'id' => 'passer', 'placeholder' =>'Введите пароль']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Подтверждение пароля:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'passer2')->label(false)->passwordInput(['class' => 'form-input', 'id' => 'passer2', 'placeholder' =>'Подтвердите пароль']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <hr class="mb40 mt40">
                <div class="row">
                    <div class="col-3">
                        <div class="light h3 mt10">
                            <span class="text-gray">Откуда вы о нас узнали?:</span>
                        </div>
                    </div>
                    <div class="col-3">

                        <?=
                        $form->field($model, 'knowfrom')->label(false)->dropDownList([
                           // '0' => 'Delivery club',
                            'Delivery club' => 'Delivery club',
                            'Агрегатор заказов' => 'Агрегатор заказов',
                            'Бизнесы-центр' => 'Бизнес-центры',
                            'Баннеры и прочее' => 'Баннеры и прочее'
                                ], ['class' => 'form-input']);
                        ?>
                    </div>
                </div>
                <hr class="mb40 mt40">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                         <?= Html::submitButton('Отправить', ['class' => 'btn btn-big btn-red wmaxorty', 'id'=> 'regiso']) ?>
                        
                    </div>
                    <div class="col-3">
                        <a href="javascript:void(0)" id="resetForm" class="btn btn-big btn-gray wmax">Сбросить</a>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
<?php ActiveForm::end(); ?>
        </div>
    </section>
</div>
<script>
    $("#signAdressSection").change(function () {
        var box = $(".sign-adress-box");
        var field = box.find('input');
        if ($(this).is(':checked')) {
            box.addClass('active');
            field.prop('readonly', false).prop('required', true);
        } else {
            box.removeClass('active');
            field.prop('required', false).prop('readonly', true);
        }
    });
    $('#phonePlus').click(function () {
        $('#phoneTwo').show();
    });
    $('#resetForm').click(function () {
        var form = $(this).closest('form'),
                checker = $('.checker'),
                checkerStyler = checker.closest('.jq-checkbox');
        form.find("input, textarea, select").val("");
        if (checker.is(':checked')) {
            checkerStyler.trigger("click");
        }
    });
</script>