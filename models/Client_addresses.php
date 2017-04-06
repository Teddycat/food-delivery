<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Client_addresses extends ActiveRecord
{
   public function known($id) {
        return (new Query())->from('client_addresses')
                        ->select('*')
                        ->where([ 'client_addresses_id' => $id])
                        ->one();
    }

    public function client($id) {
        return (new Query())->from('client_addresses')
            ->select('*')
            ->where([ 'client_addresses_client' => $id])
            ->all();
    }

    public function changer($arr) {

        $customer = Client_addresses::findOne(['client_addresses_id' => $arr['ider']]);
        $customer->client_addresses_city = $arr['city'];
        $customer->client_addresses_street = $arr['street'];
        $customer->client_addresses_house = $arr['house'];
        $customer->client_addresses_flat = $arr['flat'];
        return $customer->update();
    }

    public function deler($arr) {
        return Yii::$app->db->createCommand()->delete('client_addresses', ['client_addresses_id' => $arr['ider']])
            ->execute();
    }
}