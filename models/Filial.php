<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Filial extends ActiveRecord {
    
     public function getty($city) {
        return (new Query())
                        ->select('*')
                        ->from('filial')
                        ->where(['filial_city' => $city])
                        ->all();
    }

    public function getall() {
        return (new Query())
            ->select('c.city_name, f.filial_name, f.filial_id, f.filial_phone')
            ->from('city as c')
            ->leftJoin('filial AS f', 'f.filial_city = c.city_name')
            //->leftJoin('schedule AS s', 'c.city_name = s.schedule_city')
            ->all();
    }

//    public function getAbout() {
//        return (new Query())
//            ->select('c.city_name, f.filial_name, f.filial_id, f.filial_phone')
//            ->from('city as c')
//            ->leftJoin('filial AS f', 'f.filial_city = c.city_name')
//            ->all();
//    }

    public function updater($arr) {
        $item = Filial::findOne(['filial_id' => $arr['ider']]);
        $item->filial_city = $arr['city'];
        $item->filial_phone = $arr['phone'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('filial', ['filial_city' => $arr['city'], 'filial_name' => $arr['name'], 'filial_phone' => $arr['phone']])->execute();
    }
    public function addnew($name) {
        return Yii::$app->db->createCommand()->insert('filial', ['filial_city' => $name])->execute();
    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('filial', ['filial_id' => $arr['ider']])
            ->execute();
    }

    public function delold($name) {
        return Yii::$app->db->createCommand()->delete('filial', ['filial_city' => $name])
            ->execute();
    }

}
