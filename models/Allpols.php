<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Allpols extends ActiveRecord {

    public function getty() {
        return City::find()->all();
    }

    public function Points($num) {
        return (new Query())->from('allpols')
            ->select(['allpols_lat', 'allpols_let'])
            ->where(['allpols_polygon' => $num])
            ->all();
    }

    public function inserter($maxid, $lat, $let) {
        $model = new Allpols;
        $model->allpols_polygon = $maxid;
        $model->allpols_lat = $lat;
        $model->allpols_let = $let;
        $model->save();  // equivalent to $model->insert();
        return true;

    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('allpols', ['allpols_polygon' => $arr['idero']])
            ->execute();
    }
}
