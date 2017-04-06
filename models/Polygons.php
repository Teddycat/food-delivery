<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Polygons extends ActiveRecord
{
    public function getty() {
        return Polygons::find()->orderBy('polygons_city')->all();
    }

    public function maxid() {
        return (new Query())->from('polygons')
            ->select('MAX(polygons_number) as morer')
            ->one();
    }
    public function inserter($arr) {
        $model = new Polygons;
        $model->polygons_name = $arr['name'];
        $model->polygons_city = $arr['city'];
        $model->polygons_number = $arr['maxid'];
        $model->save();  // equivalent to $model->insert();
        return true;

    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('polygons', ['polygons_id' => $arr['ider']])
            ->execute();
    }

}

