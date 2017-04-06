<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class City extends ActiveRecord {

    public function getty() {
        return (new Query())->from('city')
            ->select('*')
            ->all();
    }

    public function getIds() {
        return (new Query())->from('city')
            ->select(['city_id'])
            ->all();
    }

    public function getJustice($city) {
        return (new Query())->from('city')
            ->select(['city_justic'])
            ->where(['city_name' => $city])
            ->one();
    }

    public function getname($ider) {
        return (new Query())->from('city')
            ->select(['city_name'])
            ->where(['city_id' => $ider])
            ->one();
    }

    public function getDevTime($city) {
        return (new Query())->from('city')
            ->select(['city_minsum'])
            ->where(['city_name' => $city])
            ->one();
    }

    public function getPays($city) {
        return (new Query())->from('city')
            ->select(['city_pay'])
            ->where(['city_name' => $city])
            ->one();
    }

      public function getid($city) {
        return (new Query())->from('city')
            ->select(['city_id'])
            ->where(['city_name' => $city])
            ->one();
    }

    public function getnamen($ider) {
        return (new Query())->from('city')
            ->select(['city_name'])
            ->where(['city_id' => $ider])
            ->all();
    }

    public function getjustic() {
            return (new Query())->from('city')
                ->select(['city_name', 'city_justic'])
            ->all();
    }

    public function getpay() {
        return (new Query())->from('city')
            ->select(['city_name', 'city_pay'])
            ->all();
    }
    
public function getCity($choose) {
       return (new Query())->from('city')
               ->select(['city_time', 'city_id', 'city_name', 'city_minsum'])
               ->where(['city_name' => $choose])
               ->one();
    }
    public function updater($arr) {
        $item = City::findOne(['city_id' => $arr['id']]);
        $item->city_name = $arr['name'];
        $item->city_time = $arr['time'];
        $item->City_minsum = $arr['minsum'];
        $item->city_justic = $arr['justic'];
        return $item->update();
    }

    public function payinfo($arr) {
        $item = City::findOne(['city_name' => $arr['city']]);
        $item->city_pay = $arr['info'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('city', ['city_name' => $arr['name'], 'city_time' => $arr['time'], 'City_minsum' => $arr['minsum'], 'city_justic' => $arr['justic']])->execute();
    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('city', ['city_id' => $arr['ider']])
            ->execute();
    }

    public function creator($city)
    {
        Yii::$app->db->createCommand("ALTER TABLE category ADD COLUMN $city INT default 1")->execute();
    }
}
