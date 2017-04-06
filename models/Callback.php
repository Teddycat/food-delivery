<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Callback extends ActiveRecord {

    public function getty() {
        return Callback::find()->orderBy('callback_status')->all();
    }
    public function getCity($city) {
        return Callback::find()->where(['callback_city' => $city])->all();
    }


       public function inserter($num, $dater, $city) {
        return Yii::$app->db->createCommand()->insert('callback', ['callback_number' => $num, 'callback_time' => $dater, 'callback_city' => $city, 'callback_status' => 0])->execute();
    }
    public function updater($arr) {
        $item = Callback::findOne(['callback_id' => $arr['id']]);
        $item->callback_status = $arr['status'];
        $item->callback_last = $arr['last'];
        return $item->update();
    }

    public function insertero($arr) {
        return Yii::$app->db->createCommand()->insert('callback', ['callback_date' => $arr['date'], 'callback_img' => $arr['img'],'callback_title' => $arr['title'],'callback_content' => $arr['content'],'callback_full' => $arr['full'],'callback_keywords' => $arr['keywords'],'callback_main' => $arr['main']])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('callback', ['callback_id' => $arr['ider']])
            ->execute();
    }
}
