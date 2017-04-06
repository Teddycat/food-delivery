<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
//use app\models\Client_addresses;
use yii\db\Query;

class Choosen extends ActiveRecord {
    
     public function getty($number) {
        return (new Query())
                        ->select('*')
                        ->from('choosen')
                        ->where(['choosen_client' => $number])
                        ->all();
    }

       public function counter($number) {
        return (new Query())
                        ->select('COUNT(*)')
                        ->from('choosen')
                        ->where(['choosen_client' => $number])
                        ->scalar();
    }
    
    public function inserter($arr, $id, $client) {
        return Yii::$app->db->createCommand()->insert('choosen', ['choosen_thing' => $id, 'choosen_name' => $arr['namer'], 'choosen_price' => $arr['pi'], 'choosen_balls' => $arr['bi'], 'choosen_desc' => $arr['descro'], 'choosen_weight' => $arr['wi'],'choosen_length' => $arr['li'],'choosen_kkal' => $arr['ki'], 'choosen_client' => $client, 'choosen_img' => $arr['img']])->execute();
    }
    
     public function dele($number) {
        return Yii::$app->db->createCommand()->delete('choosen', ['choosen_id' => $number])
    ->execute();
    }

     public function isobj($number, $ider) {
        return (new Query())
                        ->select('*')
                        ->from('choosen')
                        ->where(['choosen_client' => $ider])
                        ->andWhere(['choosen_thing' => $number])
                        ->exists();
    }

 public function getId($number, $prod) {
        return (new Query())
                        ->select('choosen_thing')
                        ->from('choosen')
                        ->where(['choosen_client' => $number, 'choosen_thing'  => $prod])
                        ->one();
    }
}
