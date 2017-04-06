<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
//use app\models\Client_addresses;
use yii\db\Query;

class Feedback extends ActiveRecord {

    public function getty() {
        return Feedback::find()->orderBy('feedback_number desc')->all();
    }
    public function getNum() {
        return (new Query())->from('feedback')
            ->select('COUNT(*) as count')
            ->where(['feedback_status' => 0])
            ->all();
    }


    public function getByid($ider) {
        return Feedback::find()->where(['feedback_id' => $ider])->all();
    }

    public function updater($arr) {
        $item = Feedback::findOne(['feedback_id' => $arr['ider']]);
        $item->feedback_status = $arr['status'];
        return $item->update();
    }


    public function inserter($arr, $order, $file,$date) {
        return Yii::$app->db->createCommand()->insert('feedback', ['feedback_number' => $order, 'feedback_name' => $arr['name'], 'feedback_phone' => $arr['phone'], 'feedback_mail' => $arr['email'], 'feedback_message' => $arr['message'], 'feedback_img' => $file,'feedback_dater' => $date])->execute();
    }
    
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('feedback', ['feedback_id' => $arr['ider']])
            ->execute();
    }

}
