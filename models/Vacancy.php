<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Vacancy extends ActiveRecord {

    public function getty($city) {
        return Vacancy::find()->where(['vacancy_city'=>$city])->orderBy('vacancy_date')->all();
    }
    public function getall() {
        return Vacancy::find()->orderBy('vacancy_date')->all();
    }
    public function getone($num) {
        return Vacancy::find()->where(['vacancy_number' => $num])->one();
    }
    public function getmax() {

        return (new Query())
            ->select('max(vacancy_number)')
            ->from('vacancy')
            ->scalar();
    }


    public function updater($arr) {
        $item = Vacancy::findOne(['vacancy_number' => $arr['num']]);
        //$item->vacancy_date = $arr['date'];
        $item->vacancy_img = $arr['img'];
        $item->vacancy_title = $arr['title'];
        $item->vacancy_content = $arr['desc'];
        $item->vacancy_full = $arr['full'];
        $item->vacancy_keywords = $arr['key'];
        $item->vacancy_main = $arr['main'];
        return $item->update();
    }

    public function inserter($arr, $maxer) {
        return Yii::$app->db->createCommand()->insert('vacancy', ['vacancy_date' => $arr['date'], 'vacancy_img' => $arr['img'],'vacancy_title' => $arr['title'],'vacancy_content' => $arr['content'], 'vacancy_city' => $arr['city'], 'vacancy_full' => $arr['full'],'vacancy_keywords' => $arr['keywords'],'vacancy_main' => $arr['main'],'vacancy_number' => $maxer])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('vacancy', ['vacancy_id' => $arr['ider']])
            ->execute();
    }
}
