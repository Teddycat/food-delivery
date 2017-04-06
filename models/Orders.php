<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Orders extends ActiveRecord {

    public function getty() {
        return Orders::find()->all();
    }

    public function getCity($city) {
        return Orders::find()->where(['orders_city' => $city])->all();
    }

    public function getSuccess($number) {
        return (new Query())->from('orders')
                        ->select('*')
                        ->where(['orders_number' => $number])
                        ->one();
    }
    public function getSelect($time1, $time2) {
        return (new Query())->from('orders')
            ->select('*')
            ->where(['>','orders_when', $time1])
            ->andWhere(['<','orders_when', $time2])
            ->all();
    }

    public function getProducto($number) {
        return (new Query())->from('orders_product')
            ->select('*')
            ->where(['orders_product_number' => $number])
            ->all();
    }


    public function getTimer($date, $login) {       
        return (new Query())
        ->select('SUM(orders_total)')
        ->from('orders')
        ->where(['orders_client' => $login, 'orders_status' => 1,])
        ->andWhere(['>', 'orders_timer', ($date-155520000)])
        ->one();
    }
//текущая дата -180 дней   дата в базе
    public function getSoon($number) {
        return (new Query())->from('orders')
                        ->select('*')
                        ->where(['orders_client' => $number, 'orders_status' => 1])
                        ->all();
    }

    public function getAll($number) {
        return (new Query())->from('orders')
                        ->select('*')
                        ->where(['orders_client' => $number])
                        ->all();
    }

    public function getOrders($number) {
        return (new Query())->from('orders_product')
                        ->select('*')
                        ->where(['orders_product_number' => $number])
                        ->all();
    }

    public function amounty($number) {
        return (new Query())->from('orders')
                        ->select('COUNT(*) as count')
                        ->where(['orders_client' => $number, 'orders_status' => 1])
                        ->one();
    }
    public function getNum() {
        return (new Query())->from('orders')
            ->select('COUNT(*) as count')
            ->where(['orders_status' => 0])
            ->all();
    }

    public function getLikes($num) {
        return (new Query())
            ->select('orders_product_ider, COUNT(p.orders_product_ider)')
            ->from('orders_product AS p')
            ->innerJoin('orders AS o', 'p.orders_product_number = o.orders_number')
            ->where(['o.orders_client' => $num])
            ->groupBy('orders_product_ider')
            ->all();
    }

    public function getMax() {
        return (new Query())->from('orders')
            ->select('MAX(orders_number) as maxer')
            ->all();
    }


    public function getProducts($number) {
        return (new Query())->from('orders_product')
                        ->select('*')
                        ->where(['orders_product_number' => $number])
                        ->all();
    }

    public function getSauce($number) {
        return (new Query())->from('orders_sauce')
                        ->select('*')
                        ->where(['orders_sauce_order' => $number])
                        ->all();
    }

    public function getAmmount() {
        return (new Query())->from('orders')
                        ->select('orders_number')
                        ->orderBy('orders_number DESC')
                        ->one();
    }

    public function addOrder($user, $city, $phone, $persons, $sauces, $payInfo, $sendOrder, $sumOrder, $bonusPlus, $bonusMinus, $devPrice, $promo, $timer, $totalSum, $tokens, $amount, $daters, $client) {
        return Yii::$app->db->createCommand()->insert('orders', ['orders_number' => $amount, 'orders_user' => $user, 'orders_city' => $city, 'orders_phone' => $phone, 'orders_persons' => $persons, 'orders_sauces' => $sauces, 'orders_pay_info' => $payInfo, 'orders_send' => $sendOrder, 'orders_sum' => $sumOrder, 'orders_bonus_plus' => $bonusPlus, 'orders_bonus_minus' => $bonusMinus, 'orders_price' => $devPrice, 'orders_promo' => $promo, 'orders_client' => $client, 'orders_timer' => $timer, 'orders_when' => $daters,  'orders_total' => $totalSum])->execute();
    }

    public function addProduct($product_id, $product_name, $product_img, $price, $weight, $kkal, $product_description, $price1, $price2,$amount) {
        return Yii::$app->db->createCommand()->insert('orders_product', ['orders_product_ider' => $product_id, 'orders_product_name' => $product_name, 'orders_product_img' => $product_img, 'orders_product_price' => $price, 'orders_product_weight' => $weight, 'orders_product_kkal' => $kkal, 'orders_product_descript' => $product_description, 'orders_product_token' => 'sdgsdg', 'orders_product_adds' => 'adds', 'orders_product_price1_num' => $price1, 'orders_product_price2_num' => $price2,'orders_product_number' => $amount])->execute();
    }

    public function updater($arr) {
        $item = Orders::findOne(['orders_id' => $arr['id']]);
        $item->orders_status = $arr['status'];
        return $item->update();
    }
    public function udpOrder($amount, $ider, $num) {
        $connection = Yii::$app->db;
        $connection->createCommand('UPDATE `orders_product` SET '. $num .'='.$amount.' WHERE orders_product_id='.$ider)
            ->execute();
    }

    public function updatero($arr) {
        $item = Orders::findOne(['orders_number' => $arr['id']]);
        $item->orders_user = $arr['name'];
        $item->orders_phone = $arr['phone'];
        $item->orders_persons = $arr['persons'];
        $item->orders_pay_info = $arr['pay'];
        $item->orders_send = $arr['delivery'];
        $item->orders_sum = $arr['sum'];
        $item->orders_bonus_plus = $arr['bonplus'];
        $item->orders_bonus_minus = $arr['bonmin'];
        $item->orders_price = $arr['sender'];
        $item->orders_total= $arr['total'];
        $item->orders_status = $arr['status'];
        return $item->update();
    }

    public function inserter($arr) {
        return Yii::$app->db->createCommand()->insert('orders', ['orders_date' => $arr['date'], 'orders_img' => $arr['img'],'orders_title' => $arr['title'],'orders_content' => $arr['content'],'orders_full' => $arr['full'],'orders_keywords' => $arr['keywords'],'orders_main' => $arr['main']])->execute();
    }
    public function adding($arr, $maxer) {
        $model = new Orders;
        $model->orders_number = $maxer;
        $model->orders_user = $arr['name'];
        $model->orders_city = $arr['city'];
        $model->orders_phone = $arr['phone'];
        $model->orders_persons = $arr['persons'];
        $model->orders_pay_info = $arr['howpay'];
        $model->orders_send = $arr['howget'];
        $model->orders_price = $arr['howmuch'];
        $model->orders_sum = $arr['total'];
        $model->orders_total = $arr['totally'];
        $model->orders_timer = $arr['timeGet'];
        $model->orders_when = $arr['timeOrder'];
        $model->orders_status = $arr['statuso'];
        $model->save();
        return true;
    }


    public function deleter($arr) {
        return Yii::$app->db->createCommand()->delete('orders', ['orders_id' => $arr['ider']])
            ->execute();
    }
}
