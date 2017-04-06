<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Menu extends ActiveRecord {

    public function getty() {
        return Menu::find()->orderBy('menu_order')->all();
    }

    public function updater($arr) {
        $item = Menu::findOne(['menu_id' => $arr['id']]);
        $item->menu_name = $arr['name'];
        $item->menu_order = $arr['order'];
        $item->menu_link = $arr['link'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('menu', ['menu_name' => $arr['name'], 'menu_order' => $arr['order'], 'menu_link' => $arr['link']])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('menu', ['menu_id' => $arr['ider']])
            ->execute();
    }

}