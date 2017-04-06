<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
//use app\models\Client_addresses;
use yii\db\Query;

class Addresses extends ActiveRecord {

    public function getty($number) {
        return (new Query())
                        ->select('*')
                        ->from('client_addresses')
                        ->where(['client_addresses_client' => $number])
                        ->all();
    }

    public function updater($arr) {
        $customer = Client_addresses::findOne(['client_addresses_id' => $arr['idiero']]);
        $customer->client_addresses_city = $arr['city'];
        $customer->client_addresses_street = $arr['street'];
        $customer->client_addresses_house = $arr['house'];
        $customer->client_addresses_flat = $arr['flat'];
        return $customer->update();
    }

    public function inserter($arr, $id) {
        return Yii::$app->db->createCommand()->insert('client_addresses', ['client_addresses_city' => $arr['city'], 'client_addresses_street' => $arr['street'], 'client_addresses_house' => $arr['house'], 'client_addresses_flat' => $arr['flat'], 'client_addresses_client' => $id])->execute();
    }
  public function dele($number) {
        return Yii::$app->db->createCommand()->delete('client_addresses', ['client_addresses_id' => $number])
    ->execute();
    }

}
