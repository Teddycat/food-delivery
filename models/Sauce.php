<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Sauce extends ActiveRecord {

    public function getty() {
        return (new Query())->from('sauce')
                        ->select(['*'])
                        ->all();
    }

    public function getOrder($prid) {
        return (new Query())->from('orders_sauce')
            ->select(['*'])
            ->where(['orders_sauce_order' => $prid])
            ->all();
    }
    public function info($prid) {
        return (new Query())->from('sauce')
            ->select(['sauce_name', 'sauce_price'])
            ->where(['sauce_id' => $prid])
            ->one();
    }


    public function addSauce($name, $price, $ammount, $numbero, $adding) {
         return Yii::$app->db->createCommand()->insert('orders_sauce', ['orders_sauce_name' => $name, 'orders_sauce_price' => $price, 'orders_sauce_amount' => $ammount, 'orders_sauce_order' => $numbero, 'orders_sauce_adding' => $adding])->execute();
    }

    public function updater($arr) {
        $item = Sauce::findOne(['sauce_id' => $arr['id']]);
        $item->sauce_name = $arr['name'];
        $item->sauce_img = $arr['img'];
        $item->sauce_price = $arr['price'];
        return $item->update();
    }
    public function upderio($amount, $namer) { return true;
        $connection = Yii::$app->db;
        $conn = $connection->createCommand("UPDATE `orders_sauce` SET orders_sauce_amount=".$amount." WHERE orders_sauce_id=".$namer)
            ->execute();

    }


    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('sauce', ['sauce_name' => $arr['name'], 'sauce_img' => $arr['img'],'sauce_price' => $arr['price']])->execute();
    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('sauce', ['sauce_id' => $arr['ider']])
            ->execute();
    }

   
}
