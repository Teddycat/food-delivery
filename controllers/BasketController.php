<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Content;
use app\models\City;
use app\models\Category;
use app\models\Menu;
use app\models\Filters;
use app\models\Product;
use app\models\Sauce;
use app\models\Orders;
use app\models\Adds;
use yii\web\Session;
use app\assets;

class BasketController extends Controller {

    /**
     * Working with basket
     * @return string
     */

    public function actionIndex() {
        $session = new Session;
        $session->open();
        $city = new City;
        $add = new Adds;
        $product = new Product;
        $sauce = new Sauce;
        $result['cities'] = $city->getty();
        $place = $session->get('city');
        $portmone = $city->getPays($place);
        $sauce = $sauce->getty();
        $cities = $city->getty();
        $product = $product->getSpecial();
        $ordering = $session->get('order');
        $price1 = $session->get('price1');
        $price2 = $session->get('price2');
        $county=0;
        foreach($sauce as $item) {
            $sauce[$county]['amount'] = 0;
            $county++;
        }
        if ($ordering != NULL) {
            foreach ($ordering as $key) {
                $tempo = $add->getty($key['product_number']);
                foreach ($tempo as $sign) {
                    $count = 0;
                    foreach ($sauce as $item) {
                        if (intval($item['sauce_id']) === intval($sign['adds_sauce'])) {
                            $sauce[$count]['amount'] += $sign['adds_amount'];
                        }
                        $count++;
                    }

                }

            }
        }

       return $this->render('index', ['model' => $model, 'result' => $result, 'sauce' => $sauce, 'product' => $product, 'cities' => $cities, 'price1' => $price1, 'price2' => $price2, 'ordering' => $ordering, 'portmone' => $portmone['city_pay']]);
    }

    public function actionSuccess($ordero) {// выводит данные на страницу успешного подтверждения
        $ordero = intval($ordero);
        $orders = new Orders;
        $ordero = $orders->getSuccess($ordero);
        $orderProd = $orders->getProducts($ordero);
        $orderSauce = $orders->getSauce($ordero);
        return $this->render('success', ['model' => $model, 'ordero' => $ordero, 'orderProd' => $orderProd, 'orderSauce' => $orderSauce]);
    }

    public function actionSauces() {
        $adds= new Adds;
        $ider = Yii::$app->request->post('atri');
        $result = $adds->getAll($ider);
        echo json_encode($result);
    }

    public function actionDeleter() {
        $session = new Session;
        $session->open();
        $ider = Yii::$app->request->post('atri');
        $whatprice = Yii::$app->request->post('wprice');
        $sess = $session->get('order');
        $newsess = array();
        foreach($sess as $key) {
            $newsess[] = $key;
        }
        $sess = $newsess;
        for ($i = 0; $i < count($sess); $i++) {
            if ($sess[$i]['product_id'] == $ider && $sess[$i]['whatprice'] == $whatprice) {
                unset($sess[$i]);
                if($whatprice == 'product_price1') {
                    $price1 = $session->get('price1');
                    unset($price1[$ider]);
                    $session->set('price1', $price1);
                } else if($whatprice == 'product_price2') {
                    $price2 = $session->get('price2');
                    unset($price2[$ider]);
                    $session->set('price2', $price2);
                }
            }
        }
        $session->set('order', $sess);
      echo json_encode($_SESSION['order']);
    }
}
