<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Statics extends ActiveRecord {

    public function getty($mod) {
        return Statics::find()->where(['static_mod'=>$mod])->one();
    }

    public function getall($mod) {
        return Statics::find()->where(['static_mod'=>$mod])->all();
    }

    public function withcity($mod, $city) {
        return Statics::find()->where(['static_mod'=>$mod, 'static_city'=>$city])->one();
    }

    public function updater($arr, $where) {
        $item = Statics::findOne(['static_mod' => $where]);
//        $item->static_img = $arr['img'];
//        $item->static_title = $arr['title'];
//        $item->static_preview = $arr['preview'];
        $item->static_text = $arr['text'];
        return $item->update();
    }

    public function adddel($name) {
        $model = new Statics;
        $model->static_city = $name;
        $model->static_title = "Условия доставки";
        $model->static_mod = "delivery";
        $model->save();  
        return true;
    }

     public function addcon($name) {
        $model = new Statics;
        $model->static_city = $name;
        $model->static_title = "Контакты";
        $model->static_mod= "contacts";
        $model->save();  
        return true;
    }

    public function updatero($arr, $where, $city) {
        $item = Statics::findOne(['static_mod' => $where, 'static_city' => $city]);
//        $item->static_img = $arr['img'];
//        $item->static_title = $arr['title'];
//        $item->static_preview = $arr['preview'];
        $item->static_text = $arr['text'];
        return $item->update();
    }

      public function deleter($place) {
        return Yii::$app->db->createCommand()->delete('statics', ['static_city' => $place])
            ->execute();
    }
}
