<?php

namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use app\components\HelloWidget;
use yii\widgets\ActiveForm;
use yii\bootstrap\Carousel;
//use yii\widgets\MaskedInput;
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



            <div class="content-wrapper">
                <!--					include('tpl/breadcrumbs.php'); -->
                <div class="cart-title medium text-black mb5">Вход</div>
                <div class="h5 mb30"><span class="text-red">* </span><span class="text-gray">- обязательны к заполению</span></div>

                <?php
                $model = new EntryForm;
                $form = ActiveForm::begin([
                    'id' => 'signerow',
                    'action' => "../entry/login",
                    //'options' => ['enctype' => 'multipart/form-data'],
                ])
                ?>
                <div class="row mb20">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <div class="light h3 mt10">
                                    <span class="text-gray">Телефон:</span><span class="text-red">*</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <?= $form->field($model, 'phone')->label(false)->widget(\yii\widgets\MaskedInput::className(), ['name' => 'phone', 'mask' => '(999) 999-99-99',])->textInput(['class' => 'form-input mb20', 'placeholder' =>'Ваш номер телефона']) ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="light h3 mt10">
                                    <span class="text-gray">Пароль:</span><span class="text-red">*</span>
                                </div>
                            </div>
                            <div class="col-7">
                                <?= $form->field($model, 'passer')->label(false)->passwordInput(['class' => 'form-input', 'placeholder' => 'Ваш пароль']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= Html::submitButton('Вход', ['class' => 'btn btn-red', 'id' => 'regas']) ?>
                <?php ActiveForm::end(); ?>
            </div>

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