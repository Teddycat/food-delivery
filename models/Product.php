<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Product extends ActiveRecord
{

    public function getty($smak)
    {
        return (new Query())->from('product')
            ->select(['product_id', 'product_name', 'product_alias', 'product_weight', 'product_weight_2', 'product_img', 'product_price1', 'product_price2', 'product_length', 'product_kkal', 'product_length2', 'product_kkal2', 'product_description', 'product_choice', 'product_percent', 'product_fixprice'])
            ->innerJoin('filters', '`filters`.`filters_id` = `product`.`product_filter`')
            ->innerJoin('category', '`category`.`category_id` = `filters`.`filters_category`')
            ->where(['category.category_alias' => $smak])
            ->all();
    }

    public function getList($ider)
    {
        return (new Query())->from('product_filter')->select('product_filter_prod')->where(['product_filter_filt' => $ider])->all();
    }

     public function getCato($ider)
    {
        return (new Query())->from('product')->select('*')->where(['product_filter' => $ider])->all();
    }

    public function filtern($ider)
    {
        return (new Query())->from('product')->select('*')->where(['product_number' => $ider])->one();
    }
    

    public function filternAll($filt)
    {
        return (new Query())->from('product_filter')->select('product_filter_prod')->where(['product_filter_filt' => $filt])->all();
//        return (new Query())->from('product')
//            ->select(['product_id', 'product_name', 'product_img', 'product_price1', 'product_price2', 'product_length', 'product_kkal', 'product_length2', 'product_kkal2', 'product_weight', 'product_weight_2', 'product_choice', 'product_percent', 'product_fixprice', 'product_fresh', 'product_popular', 'product_promo', 'product_isbonus','product_description'])
//            ->innerJoin('filters', '`filters`.`filters_id` = `product`.`product_filter`')
//            ->where(['filters.filters_category' => $filt])
//            ->all();
    }

    public function get_set($good)
    {
        return (new Query())->from('product')->select('*')->where(['product_alias' => $good])->one();
    }

    public function maxid() {
        return (new Query())->from('product')
            ->select('MAX(product_number) as morer')
            ->one();
    }

    public function getProd($index)
    {
        return (new Query())
            ->select(['product_name', 'product_number'])
        ->from('product')
        ->where(['product_filter' => $index])
        ->all();
    }
    public function info($prid) {
        return (new Query())->from('product')
            ->select(['product_id', 'product_price1', 'product_name', 'product_img', 'product_weight', 'product_kkal', 'product_description'])
            ->where(['product_number' => $prid])
            ->one();
    }



    public function filting($good)
    {
        return (new Query())->from('category')
            ->select('category_alias')
            ->innerJoin('filters', '`filters`.`filters_category` = `category`.`category_id`')
            ->innerJoin('product', '`filters`.`filters_id` = `product`.`product_filter`')
            ->where(['product.product_filter' => $good])
            ->one();
    }

    public function getCategory($good)
    {
        return (new Query())->from('category')
            ->select(['category_name', 'category_alias', 'category_order'])
            ->innerJoin('filters', '`filters`.`filters_category` = `category`.`category_id`')
            ->innerJoin('product', '`filters`.`filters_id` = `product`.`product_filter`')
            ->where(['product.product_alias' => $good])
            ->one();
    }

    public function getAll()
    {
        return (new Query())
            ->select(['*'])
            ->from('product')
            ->all();
    }

    public function Allcat()
    {
        return (new Query()) ->from('product as p')
            ->select('p.product_name, p.product_number, p.product_alias, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_adds, p.product_choice, p.product_percent, p.product_fixprice, p.product_fresh, p.product_popular, p.product_promo, p.product_is_special, p.product_isbonus, c.category_name')
            ->innerJoin('category as c', '`c`.`category_id` = `p`.`product_filter`')
            ->all();
    }

    public function Allcatbyname()
    {
        return (new Query()) ->from('product as p')
            ->select('p.product_name, p.product_number, p.product_alias, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_adds, p.product_choice, p.product_percent, p.product_fixprice, p.product_fresh, p.product_popular, p.product_promo, p.product_is_special, p.product_isbonus, c.category_name')
            ->innerJoin('category as c', '`c`.`category_id` = `p`.`product_filter`')
            ->orderBy('p.product_name')
            ->all();
    }

    public function Allcatbycat()
    {
        return (new Query()) ->from('product as p')
            ->select('p.product_name, p.product_number, p.product_alias, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_adds, p.product_choice, p.product_percent, p.product_fixprice, p.product_fresh, p.product_popular, p.product_promo, p.product_is_special, p.product_isbonus, c.category_name')
            ->innerJoin('category as c', '`c`.`category_id` = `p`.`product_filter`')
            ->orderBy('c.category_name')
            ->all();
    }


    public function Allcatbynamedown()
    {
        return (new Query()) ->from('product as p')
            ->select('p.product_name, p.product_number, p.product_alias, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_adds, p.product_choice, p.product_percent, p.product_fixprice, p.product_fresh, p.product_popular, p.product_promo, p.product_is_special, p.product_isbonus, c.category_name')
            ->innerJoin('category as c', '`c`.`category_id` = `p`.`product_filter`')
            ->orderBy(['p.product_name' => SORT_DESC])
            ->all();
    }

    public function Allcatbycatdown()
    {
        return (new Query()) ->from('product as p')
            ->select('p.product_name, p.product_number, p.product_alias, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_adds, p.product_choice, p.product_percent, p.product_fixprice, p.product_fresh, p.product_popular, p.product_promo, p.product_is_special, p.product_isbonus, c.category_name')
            ->innerJoin('category as c', '`c`.`category_id` = `p`.`product_filter`')
            ->orderBy(['c.category_name' => SORT_DESC])
            ->all();
    }


    public function getSpecial()
    {
        return (new Query())
            ->select(['*'])
            ->from('product')
            ->where(['product_is_special'=> 1])
            ->all();
    }
    public function getByNumb($ider)
    {
        return (new Query())
            ->select(['*'])
            ->from('product')
            ->where(['product_number' => $ider])
            ->one();
    }

    public function getById($ider)
    {
        return (new Query())
            ->select(['*'])
            ->from('product')
            ->where(['product_id' => $ider])
            ->one();
    }


    public function getAjax($ider, $price, $weight, $kkal)
    {
        return (new Query())
            ->select(['product_id', 'product_name', 'product_number', 'product_img', '' . $price . ' AS price', '' . $weight . ' AS weight', '' . $kkal . ' AS kkal', 'product_description', 'product_choice', 'product_price1', 'product_price2', 'product_percent', 'product_fixprice', 'product_isbonus'])
            ->from('product')
            ->where(['product_id' => $ider,])
            ->one();
    }

    public function getTheOne($ider)
    {
        return (new Query())
            ->select(['product_id', 'product_name', 'product_img', 'product_isbonus', 'product_price1', 'product_price2', 'product_description'])
            ->from('product')
            ->where(['product_id' => $ider,])
            ->one();
    }

    public function fromer($number)
    {
        return (new Query())->from('product')->select('*')->where(['product_id' => $number])->one();
    }

    public function getLikes($number)
    {
        return (new Query())->from('product')->select('*')->where(['product_filter' => $number])->all();
    }
    public function getPrices($ider)
    {
        return (new Query())->from('product')->select('product_price1, product_price2, product_choice, product_percent, product_fixprice')->where(['product_id' => $ider])->one();
    }


    public function getcat($mon)
    {
        return (new \yii\db\Query)
            ->select('p.product_name, p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_choice, p.product_percent, p.product_fixprice, p.product_isbonus, c.category_alias')
            ->from('product AS p')
            //->innerJoin('filters AS f', 'f.filters_id = p.product_filter')
//            ->innerJoin('category AS c', 'c.category_id = f.filters_category')
            ->innerJoin('category AS c', 'c.category_id = p.product_filter')
            ->where([$mon => 1])
            ->all();
    }

//    public function every()
//    {
//        return (new \yii\db\Query)
//            ->select('p.product_name, p.product_id, p.product_number,  p.product_price1, p.product_price2, p.product_id, p.product_filter, p.product_img, p.product_length, p.product_kkal, p.product_length2, p.product_kkal2, p.product_weight, p.product_weight_2, p.product_description, p.product_full_description, p.product_choice, p.product_percent, p.product_fresh, p.product_promo, p.product_popular, p.product_fixprice, p.product_isbonus, c.category_name, f.filters_name')
//            ->from('product AS p')
//            ->innerJoin('filters AS f', 'f.filters_id = p.product_filter')
//            ->innerJoin('product_filter AS pf', 'pf.filters_id = p.product_filter')
//            ->innerJoin('category AS c', 'c.category_id = f.filters_category')
//            ->orderBy('p.product_id', 'p.product_name', 'f.filters_name')
//            ->all();
//    }

    public function updater($arr) {
        $item = Product::findOne(['product_id' => $arr['id']]);
        $item->product_name = $arr['name'];
        $item->product_alias = $arr['alias'];
        $item->product_price1 = $arr['price1'];
        $item->product_price2 = $arr['price2'];
        $item->product_img = $arr['img'];
        $item->product_length = $arr['length'];
        $item->product_kkal = $arr['kkal'];
        $item->product_weight = $arr['weight'];
        $item->product_length2 = $arr['length2'];
        $item->product_kkal2 = $arr['kkal2'];
        $item->product_weight_2 = $arr['weight2'];
        $item->product_description = $arr['disc'];
        $item->product_full_description = $arr['fulldisc'];
        $item->product_percent = $arr['less'];
        $item->product_fixprice = $arr['lessfix'];
        $item->product_fresh = $arr['fresh'];
        $item->product_promo = $arr['promo'];
        $item->product_popular = $arr['popular'];
        $item->product_isbonus = $arr['bonus'];
        $item->product_choice = $arr['choice'];
        $item->product_amount = $arr['amount'];
        $item->product_keywords = $arr['keywords'];
        $item->product_metadesc = $arr['metadesc'];
        $item->product_pagetitle = $arr['pagetitle'];
        $item->product_is_special = $arr['special'];
        return $item->update();
    }

    public function prodfil($maxid, $filtid) {
        return Yii::$app->db->createCommand()->insert('product_filter', ['product_filter_filt' => $filtid, 'product_filter_prod' => $maxid])->execute();
    }
    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('product', ['product_name' => $arr['name'], 'product_number' => $arr['maxid'],'product_alias' => $arr['alias'],'product_img' => $arr['img'],'product_price1' => $arr['price1'],'product_price2' => $arr['price2'],'product_length' => $arr['length'],'product_kkal' => $arr['kkal'], 'product_weight' => $arr['weight'], 'product_length2' => $arr['length2'],'product_kkal2' => $arr['kkal2'], 'product_weight_2' => $arr['weight2'], 'product_description' => $arr['disc'], 'product_full_description' => $arr['fulldisc'], 'product_percent' => $arr['less'],'product_fixprice' => $arr['lessfix'],'product_fresh' => $arr['fresh'],'product_popular' => $arr['popular'], 'product_promo' => $arr['promo'],'product_isbonus' => $arr['bonus'], 'product_choice' => $arr['choice'], 'product_keywords' => $arr['keywords'], 'product_metadesc' => $arr['metadesc'], 'product_pagetitle' => $arr['pagetitle'], 'product_filter' => $arr['cat'], 'product_amount' => $arr['amount'], 'product_adds' => $arr['adds'],'product_is_special' => $arr['special']])->execute();
    }

    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('product', ['product_id' => $arr['ider']])
            ->execute();
    }
}

