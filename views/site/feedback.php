<?php

namespace app\models;

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\Session;
use yii\bootstrap\Carousel;
use yii\widgets\ActiveForm;
use app\models\EntryForm;

$session = new Session;
$session->open();
?>
<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>
    <section class="feedback main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>  
        <div class="wrapper">
             <?php
                    $model = new EntryForm;
                    $form = ActiveForm::begin([
                                'id' => 'feed',
                               'action' => "../entry/upload",
                                'options' => ['enctype' => 'multipart/form-data'],
                        ])
                            
                    ?>
                <div class="content-wrapper">
                    <!--					include('tpl/breadcrumbs.php');-->
                    <div class="cart-title medium text-black mb30">Оставить отзыв</div>
                    <div class="h3 light mb40">
                        Уважаемые клиенты! <br><br><br>
                        Мы ценим ваше доверие и благодарим за то, что вы выбрали «Антисуши». Мы стремимся делать все возможное для того, чтобы предоставлять вам обслуживание самого высокого качества.<br><br><br>
                        Мы постоянно совершенствуемся и нам важно знать ваше мнение об услугах компании.<br><br><br>
                        Мы будем благодарны, если вы направите отзыв, пожелание или комментарий о нашей работе.<br><br><br>
                    </div> 
                   
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">ФИО:</span>
                                    </div>
                                </div>
                                <div class="col-6">
<?= $form->field($model, 'name')->label(false)->textInput(['value' => $user[0]["registration_name"], 'class' => 'form-input']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Телефон:</span>
                                    </div>
                                </div>
                                <div class="col-6"><?= $form->field($model, 'phone')->label(false)->textInput(['value' => $user[0]["registration_phone"], 'class' => 'form-input']) ?>                                                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Email:</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'email')->label(false)->textInput(['value' => $user[0]["registration_mail"], 'class' => 'form-input']) ?>  
                                    <?= $form->field($model, 'numbers')->label(false)->hiddenInput(['value' => $numero, 'class' => 'form-input']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Тема:</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <?= $form->field($model, 'topic')->label(false)->textInput(['value' => 'Отзыв о заказе № '.$numero, 'class' => 'form-input']) ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-2">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Сообщение:</span>
                                    </div>
                                </div>
                                <div class="col-10">
 <?= $form->field($model, 'message')->label(false)->textArea(['cols' => 30, 'rows' => 10, 'class' => 'form-input']) ?>       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb40">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="light h3 mt10">
                                        <span class="text-gray">Файл:</span>
                                    </div>
                                </div>
                                <div class="col-9">
                                     <?= $form->field($model, 'filer')->label(false)->fileInput(['class' => 'form-input']) ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-4">
                                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-big btn-red wmaxo']) ?>
                                   
                                </div>
                                <div class="col-1"></div>
                                <div class="col-4">
                                    <a href="javascript:void(0)" id="resetForm" class="btn btn-big btn-gray wmaxiop">Сбросить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           <?php
    ActiveForm::end(); ?>
        </div>
    </section>
</div>

<script>
    
</script>