<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Registration extends ActiveRecord {

    public function getty($log) {

        return (new Query())
                        ->select('*')
                        ->from('registration')
                        ->where(['registration_mail' => $log])
                        ->all();
    }

    public function getNumo($num) {
        return (new Query())->from('registration')
            ->select('COUNT(*) as count')
            ->where(['>','registration_when', $num])
            ->all();
    }


    public function getall() {

        return (new Query())
            ->select('*')
            ->from('registration')
            ->all();
    }

    public function gettier($log, $pass) {

        return (new Query())
                        ->select('*')
                        ->from('registration')
                        ->where(['registration_phone' => $log, 'registration_pass' => $pass])
                        ->all();
    }

    public function getSocial($ider) {

        return (new Query())
            ->select('*')
            ->from('registration')
            ->where(['registration_social' => $ider])
            ->all();
    }




    public function getMax() {

        return (new Query())
                        ->select('MAX(registration_unique)')
                        ->from('registration')
                        ->scalar();
    }

     public function getMaxer() {

        return (new Query())
                        ->select('MAX(registration_unique)')
                        ->from('registration')
                        ->scalar();
    }

    public function finder($num) {

        return (new Query())
                        ->select('registration_mail')
                        ->from('registration')
                ->where(['registration_backup' => $num])
                        ->one();
    }

    public function getNum($num) {

        return (new Query())
            ->select('registration_unique')
            ->from('registration')
            ->where(['registration_id' => $num])
            ->one();
    }

    public function upPass($number, $id) {
        $customer = Registration::findOne(['registration_unique' => $id]);
        $customer->registration_pass = $number;
        return $customer->update();

        return $id;
    }
    
     public function newpass($mail, $hash) {
        $customer = Registration::findOne(['registration_mail' => $mail]);
        $customer->registration_pass = $hash;
        return $customer->update();

        return $id;
    }
    
     public function delkey($mail) {
        $customer = Registration::findOne(['registration_mail' => $mail]);
        $customer->registration_backup = NULL;
        return $customer->update();

        return $id;
    }
    
    
     public function updatekey($rand, $mail) {
        $customer = Registration::findOne(['registration_mail' => $mail]);
        $customer->registration_backup = $rand;
        return $customer->update();

        return $rand;
    }
    public function getbon($number) {
     return(new Query())
                        ->select('registration_bonuses')
                        ->from('registration')
                        ->where(['registration_unique' => $number])
                        ->one();   
    }
    public function getUnique($number) {
        return(new Query())
            ->select('*')
            ->from('registration')
            ->where(['registration_unique' => $number])
            ->one();
    }
public function upbon($number, $bonus) {
    
    $customer = Registration::findOne(['registration_unique' => $number]);
    $customer->registration_bonuses = $bonus;
    return $customer->update();
}
    public function updater($arr, $id) {

        $customer = Registration::findOne(['registration_unique' => $id]);
        $customer->registration_name = $arr['namer'];
        $customer->registration_mail = $arr['mailer'];
        $customer->registration_phone = $arr['phoner'];
        $customer->registration_phone2 = $arr['phoner2'];
        $customer->registration_birthday = $arr['day'];
        return $customer->update();
    }

    public function updating($arr) {

        $customer = Registration::findOne(['registration_id' => $arr['ider']]);
        $customer->registration_bonuses = $arr['bonuses'];
        $customer->registration_mail = $arr['mail'];
        $customer->registration_phone2 = $arr['phone2'];
        $customer->registration_pass = $arr['newpass'];
        return $customer->update();
    }
  public function addFrom($fromer) {
        return Yii::$app->db->createCommand()->insert('fromer', ['fromer_info' => $fromer])->execute();
    }
    public function cliento($client) {

        return (new Query())
                        ->select('registration_unique')
                        ->from('registration')
                        ->where(['registration_phone' => $client])
                        ->all();
    }

    public function getByid($client) {

        return (new Query())
            ->select('*')
            ->from('registration')
            ->where(['registration_id' => $client])
            ->all();
    }
    
    public function findmail($client) {

        return (new Query())
                        ->select('registration_mail')
                        ->from('registration')
                        ->where(['registration_mail' => $client])
                        ->all();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('registration', ['registration_id' => $arr['ider']])
            ->execute();
    }
     public function inserter($arr) {
        $model = new Registration;
        $model->registration = $arr['name'];
        $model->save();  // equivalent to $model->insert();
        return true;

    }

    public function newSocial($unique, $ider, $name, $date) {
        $model = new Registration;
        $model->registration_unique = $unique;
        $model->registration_name = $name;
        $model->registration_social = $ider;
        $model->registration_date = $date;
        $model->registration_bonuses = 0;
        $model->registration_pass = '0';
        $model->save();  // equivalent to $model->insert();
        return true;

    }
}
