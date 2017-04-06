<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db;

class Category extends ActiveRecord {

    public function getty() {
        return Category::find()->all();
    }
    public function getNames()
    {
        return (new Query())
            ->select(['category_name', 'category_id'])
            ->from('category')
            ->all();
    }
    public function getById($ider)
    {
        return (new Query())
            ->select(['*'])
            ->from('category')
            ->where(['category_order' => $ider])
            ->one();
    }

    public function getMaxer() {
        return (new Query())
            ->select('MAX(category_order) as ider')
            ->from('category')
            ->one();
    }

    public function getByCity() {
        return Category::find()->all();
    }
    
    public function get_set($id) {
        return Category::find()->select('category_id')->where(['category_alias' => $id])->one();
    }

     public function getSmak($smak) {
        return (new Query())->from('category')
                        ->select('category_name, category_alias')
                        ->where(['category_alias' => $smak])
                        ->one();
    }

    public function getlist()
    {
        return (new \yii\db\Query)
            ->select('c.category_name, c.category_alias, f.filters_name')
            ->from('category AS c')
            ->leftJoin('filters AS f', 'f.filters_category = c.category_id')
            //->where(['f.filters_category' => 'c.category_id'])
            ->all();
    }

    public function getShow($ider)
    {
        return (new \yii\db\Query)
            ->select('c.category_name, c.category_alias, c.category_order, c.category_file, c.category_redfile, s.show_is, s.show_categ')
            ->from('category AS c')
            ->leftJoin('show AS s', 'c.category_order = s.show_categ')
            ->where(['s.show_is' => 1])
            ->andWhere(['s.show_city' => $ider['city_id']])
            ->all();
    }

    public function getid($name) {
        return (new \yii\db\Query)->from('category')->select('category_id')->where(['category_name' => $name])->one();
    }
    public function getName($name) {
        return (new \yii\db\Query)->from('category')->select('category_name')->where(['category_id' => $name])->one();
    }
    public function getNamen($name) {
        return (new \yii\db\Query)->from('category as c')
            ->select('c.category_name, c.category_id')
            ->innerJoin('filters AS f', 'f.filters_category = c.category_id')
            ->where(['f.filters_id' => $name])
            ->one();
    }


    public function inserter($arr, $maxer) {
        return Yii::$app->db->createCommand()->insert('category', ['category_name' => $arr['name'], 'category_file' => $arr['img'], 'category_redfile' => $arr['active'],'category_alias' => $arr['alias'], 'category_order' => $maxer])->execute();
    }
    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('category', ['category_order' => $arr['ider']])
            ->execute();
    }

    public function updater($arr) {
        $item = Category::findOne(['category_order' => $arr['id']]);
        $item->category_name = $arr['name'];
        $item->category_alias = $arr['alias'];
        $item->category_file = $arr['img'];
        $item->category_redfile = $arr['active'];
        return $item->update();
    }

}