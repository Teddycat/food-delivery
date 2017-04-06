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
    <section class="sign main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
        <?php if($key) {?>
        <div class="wrapper"> 

            <?php
            $model = new EntryForm;
            $form = ActiveForm::begin([
                        'id' => 'backpass',
                        //'action' => "",
                            //'options' => ['enctype' => 'multipart/form-data'],
                    ])
            ?>

            <div class="content-wrapper"> 
                <!--					include('tpl/breadcrumbs.php'); -->
                <div class="cart-title medium text-black mb5">Смена пароля</div>
 
                <section class="sign-pass">
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Новый пароль:</span><span class="text-red">*</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'passer')->label(false)->passwordInput(['class' => 'form-input', 'id' => 'passer', 'placeholder' =>'Введите пароль']) ?>
                                </div>
                                <div class="col-6"> 
                                    <?= $form->field($model, 'email')->label(false)->hiddenInput(['class' => 'form-input',  'value' =>$mail['registration_mail']]) ?>
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
                    <div class="col-3"></div>
                    <div class="col-3">
                         <?= Html::submitButton('Отправить', ['class' => 'btn btn-big btn-red wmaxortybg', 'id'=> 'bapa']) ?>
                        
                    </div>
                    <div class="col-3">
                        <a href="javascript:void(0)" id="resetForm" class="btn btn-big btn-gray wmax">Сбросить</a>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
<?php ActiveForm::end(); ?>
        </div>
        <?php } else {?>
        <h1 id="nonback">ВНИМАНИЕ! ВЫ НЕ ЗАКАЗЫВАЛИ ВОССТАНОВЛЕНИЕ ПАРОЛЯ</h1> 
        <?php }?>
    </section>
</div>
