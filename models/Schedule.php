<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Schedule extends ActiveRecord {
    
     public function getty($city) {
        return (new Query())
                        ->select('*')
                        ->from('schedule')
                        ->where(['schedule_city' => $city])
                        ->all();
    }

    public function getall() {
        return (new Query())
            ->select('c.city_name, s.schedule_day, s.schedule_time')
            ->from('city as c')
            ->leftJoin('schedule AS s', 's.schedule_city = c.city_name')
            ->all();
    }

    public function updater($city, $day, $time) {
        $item = Schedule::findOne(['schedule_city' => $city, 'schedule_day' => $day]);
        $item->schedule_time = $time;
        return $item->update();
    }

}
