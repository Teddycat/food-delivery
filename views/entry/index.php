<?php

namespace app\models;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EntryForm;

?>
<?php
if (isset($ok)) {
    echo "Ваша заявка успешно отправлена!";
} else {
    $model = new EntryForm;
    $form = ActiveForm::begin([
        'id' => 'first_reg', 
        'action' => "",
        'options' => ['class' => 'main-form'],
    ])
    ?>
    <div class="mb10 text-center">
        <?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => 'Имя', 'class' => 'main-form__input']) ?>
    </div>
    <div class="mb10 text-center">
        <?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => 'Ваш e-mail', 'class' => 'main-form__input']) ?>
    </div>
    <div class="mb15 text-center">
        <?= $form->field($model, 'phone')->label(false)->textInput(['placeholder' => 'Телефон', 'class' => 'main-form__input']) ?>
    </div>
    <div class="text-center">
        <?= Html::submitButton('ОТПРАВИТЬ', ['class' => 'main-form__btn']) ?>
    </div>
    <?php
    ActiveForm::end();
    unset($ok);
}
?>        
