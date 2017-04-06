<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Adds extends ActiveRecord {

    public function getty($prid) {
        return Adds::find()->where(['adds_product' => $prid])->all();
    }

    public function getAll($prid) {
        return (new Query())
            ->select(['*'])
            ->from('adds')
            ->where(['adds_product' => $prid])
            ->all();
       // return Adds::find()->where(['adds_product' => $prid])->all();
    }
    public function inserter($product, $sauce, $amount) {
        $model = new Adds;
        $model->adds_product = $product;
        $model->adds_sauce = $sauce;
        $model->adds_amount = $amount;
        $model->save();  // equivalent to $model->insert();

    }

    public function updater($product, $sauce, $amount) {
        $item = Adds::findOne(['adds_product' => $product, 'adds_sauce' => $sauce]);
        $item->adds_amount = $amount;
        return $item->update();
    }

    public function deleting($number, $sauce) {
        return Yii::$app->db->createCommand()->delete('adds', ['adds_product' => $number, 'adds_sauce' => $sauce])
            ->execute();
    }


}
