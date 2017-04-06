<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Location extends ActiveRecord {
    public function getty($city) {
     return (new Query())->from('location')
                        ->select(['location_address', 'location_lat', 'location_let', 'location_ident'])
                        ->where(['location_city' => $city])
                        ->all();    
    }
    public function getall() {
        return (new Query())
            ->select(['c.city_name', 'l.location_id', 'l.location_address', 'l.location_lat', 'l.location_let', 'l.location_ident'])
            ->from('city as c')
            ->leftJoin('location AS l', 'l.location_city = c.city_id')
            ->all();
    }

    public function updater($arr) {
        $item = Location::findOne(['location_id' => $arr['id']]);
        $item->location_address = $arr['place'];
        $item->location_lat = $arr['lat'];
        $item->location_let = $arr['let'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('location', ['location_city' => $arr['place'], 'location_address' => $arr['address'], 'location_lat' => $arr['lat'], 'location_let' => $arr['let'], 'location_ident' => $arr['ident']])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('location', ['location_id' => $arr['ider']])
            ->execute();
    }
}