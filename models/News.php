<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class News extends ActiveRecord {

    public function getty() {
    return News::find()->orderBy('news_date')->all();
}

    public function getone($num) {
        return News::find()->where(['news_id' => $num])->one();
    }

    public function getmax() {

        return (new Query())
            ->select('max(news_number)')
            ->from('news')
            ->scalar();
    }

    public function updater($arr) {
        $item = News::findOne(['news_number' => $arr['num']]);
       // $item->news_date = $arr['date'];
        $item->news_img = $arr['img'];
        $item->news_title = $arr['title'];
        $item->news_content = $arr['desc'];
        $item->news_full = $arr['full'];
        $item->news_keywords = $arr['key'];
        $item->news_main = $arr['main'];
        return $item->update();
    }

    public function inserter($arr, $number) {
        return Yii::$app->db->createCommand()->insert('news', ['news_date' => $arr['date'], 'news_img' => $arr['img'],'news_title' => $arr['title'],'news_content' => $arr['content'],'news_full' => $arr['full'],'news_keywords' => $arr['keywords'],'news_main' => $arr['main'], 'news_number' => $number])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('news', ['news_id' => $arr['ider']])
            ->execute();
    }
}
