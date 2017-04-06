<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Actions extends ActiveRecord {

    public function getty() {
        return Actions::find()->orderBy('actions_date')->all();
    }
    public function getone($num) {
        return Actions::find()->where(['actions_number' => $num])->one();
    }
    public function getmax() {

        return (new Query())
            ->select('max(actions_number)')
            ->from('actions')
            ->scalar();
    }

    public function updater($arr) {
        $item = Actions::findOne(['actions_number' => $arr['num']]);
        $item->actions_img = $arr['img'];
        $item->actions_title = $arr['title'];
        $item->actions_content = $arr['desc'];
        $item->actions_full = $arr['full'];
        $item->actions_keywords = $arr['key'];
        $item->actions_main = $arr['main'];
        return $item->update();
    }

    public function inserter($arr, $number) {
        return Yii::$app->db->createCommand()->insert('actions', ['actions_date' => $arr['date'], 'actions_img' => $arr['img'],'actions_title' => $arr['title'],'actions_content' => $arr['content'],'actions_full' => $arr['full'],'actions_keywords' => $arr['keywords'],'actions_main' => $arr['main'],'actions_number' => $number])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('actions', ['actions_id' => $arr['ider']])
            ->execute();
    }
}
