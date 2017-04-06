<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Admin extends ActiveRecord {

    public function getty($level) {

        return (new Query())
            ->select('*')
            ->from('admin')
            ->where(['admin_level' => $level])
            ->all();
    }
    public function getCity($level, $city) {

        return (new Query())
            ->select('*')
            ->from('admin')
            ->where(['admin_level' => $level])
            ->andWhere(['admin_city' => $city])
            ->all();
    }


    public function newman($arr) {
        $model = new Admin;
        $model->admin_name = $arr['name'];
        $model->admin_login = $arr['login'];
        $model->admin_pass = $arr['pass'];
        $model->admin_city = $arr['city'];
        $model->admin_level = $arr['level'];
        $model->save();  // equivalent to $model->insert();
    }

    public function passupd($arr) {

        $customer = Admin::findOne(['admin_id' => $arr['ider']]);
        $customer->admin_pass = $arr['pass'];
        return $customer->update();
    }


    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('admin', ['admin_id' => $arr['ider']])
            ->execute();
    }
}
