<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Prints extends ActiveRecord
{
    public function getty($key) {
        return Prints::find()->where(['prints_key' => $key])->one();
    }

    public function maxid() {
        return (new Query())->from('polygons')
            ->select('MAX(polygons_number) as morer')
            ->one();
    }
    public function inserter($arr, $key) {
        $model = new Prints;
        $model->prints_key = $key;
        $model->prints_content = $arr['tabler'];
        $model->save();  // equivalent to $model->insert();
        return true;

    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('polygons', ['polygons_id' => $arr['ider']])
            ->execute();
    }

}

