<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Filters extends ActiveRecord {

    public function getty($id) {
        return Filters::find()
    ->select(['filters_name', 'filters_category'])        
    ->innerJoin('category', '`category`.`category_id` = `filters`.`filters_category`')
    ->where(['category.category_id' => $id])
    ->all();
    }

    public function iders($filt)
    {
        return (new \yii\db\Query)->from('filters')->select('filters_id')->where(['filters_category' => $filt])->all();
    }

    public function getid($name)
    {
       return (new \yii\db\Query)->from('filters')->select('filters_id')->where(['filters_name' => $name])->one();
    }

    public function getName($name)
    {
        return (new \yii\db\Query)->from('filters')->select('*')->where(['filters_id' => $name])->one();
    }

    public function allByCat($name)
    {
        return (new \yii\db\Query)->from('filters')->select('*')->where(['filters_category' => $name])->all();
    }

    public function getMass($name)
    {
        return (new \yii\db\Query)->from('product_filter as p')
            ->select('p.product_filter_filt, f.filters_name')
            ->innerJoin('filters as f', '`f`.`filters_id` = `p`.`product_filter_filt`')
            ->where(['p.product_filter_prod' => $name])->all();
    }

    public function getFilcat() {
        return (new \yii\db\Query)
            ->select('f.filters_name, c.category_name')
            ->from('filters as f')
             ->leftJoin('category AS c', '`c`.`category_id` = `f`.`filters_category`')
            //->where(['f.filters_category' => 'c.category_id'])
            ->all();
//        return Filters::find()
//            ->select(['filters_name', 'filters_category'])
//            ->innerJoin('category', '`category`.`category_id` = `filters`.`filters_category`')
////            ->where(['category.category_id' => $id])
//            ->all();
    }

    public function getall() {
        return (new \yii\db\Query)
            ->select('c.category_name, f.filters_name')
            ->from('category AS c')
            ->innerJoin('filters AS f')
            ->where(['f.filters_category' => 'c.category_id'])
            ->where(['f.filters_category' => 'c.category_id'])
            ->all();
//        return Filters::find()
//            ->select(['filters_name', 'filters_category'])
//            ->innerJoin('category', '`category`.`category_id` = `filters`.`filters_category`')
////            ->where(['category.category_id' => $id])
//            ->all();
    }
    public function updater($arr) {
        $item = Filters::findOne(['filters_name' => $arr['oldnam']]);
        $item->filters_name = $arr['name'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('filters', ['filters_name' => $arr['name'], 'filters_category' => $arr['categ']])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('filters', ['filters_name' => $arr['ider']])
            ->execute();
    }

    public function delNum($ider) {
        return Yii::$app->db->createCommand()->delete('product_filter', ['product_filter_prod' => $ider])
            ->execute();
    }


}