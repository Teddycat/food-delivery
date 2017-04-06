<?php
use yii\bootstrap\Carousel;

use app\models\Slider;

$slide = new Slider;
$images=array();
$aller = $slide->getty();
$link = Yii::$app->request->hostInfo;

foreach ($aller as $key) {
    $images[] = '<img style="max-height:320px; min-height:320px; min-width: 1400px; max-width: 1400px" src="'.$link.'/'.$key['slider_img'].'"/>';
}

echo Carousel::widget(['items'=>$images, 'options' => [
    'style' => 'width: 100%; height: 330px; margin-top: 95px;  overflow: visible' // Задаем ширину контейнера
]]);
  ?>