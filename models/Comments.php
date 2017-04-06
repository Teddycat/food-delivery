<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
//use app\models\Client_addresses;
use yii\db\Query;

class Comments extends ActiveRecord {

    public function getty() {
        return Comments::find()->orderBy('comments_dater desc')->all();
    }
    public function getNum() {
        return (new Query())->from('comments')
            ->select('COUNT(*) as count')
            ->where(['comments_status' => 0])
            ->all();
    }


    public function getByid($ider) {
        return Comments::find()->where(['comments_id' => $ider])->all();
    }

    public function inserter($arr, $order, $file,$date) {
        return Yii::$app->db->createCommand()->insert('comments', ['comments_number' => $order, 'comments_name' => $arr['name'], 'comments_phone' => $arr['phone'], 'comments_mail' => $arr['email'], 'comments_message' => $arr['message'], 'comments_topic' => $arr['topic'],'comments_img' => $file,'comments_dater' => $date])->execute();
    }

    public function maxer() {
        return (new Query())->from('comments')
            ->select('MAX(comments_number) AS maxer')
            ->one();
    }
    public function updater($arr) {
        $item = Comments::findOne(['comments_id' => $arr['ider']]);
        $item->comments_status = $arr['status'];
        return $item->update();
    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('comments', ['comments_id' => $arr['ider']])
            ->execute();
    }
}
