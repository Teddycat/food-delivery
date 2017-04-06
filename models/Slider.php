<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Slider extends ActiveRecord {

    public function getty() {
        return Slider::find()->all();
    }

    public function inserter($arr) {
        $model = new Slider;
        $model->slider_img = $arr['img'];
        $model->save();
        return true;

    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('slider', ['slider_id' => $arr['ider']])
            ->execute();
    }
}
