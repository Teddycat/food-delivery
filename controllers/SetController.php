<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Choosen;
use app\models\Filters;
use app\models\Product;
use app\models\Orders;
use app\models\Registration;
use yii\web\Session;

class SetController extends Controller {

    /**
     * Display products in selected category
     * @param $smak
     * @return string
     */
    public function actionIndex($smak) {
        $session = new Session;
        $session->open();
        $prod = new Product;
        $category = new Category;
        $filters = new Filters;
        $set_number = $category->get_set($smak); 
        $product = $prod->getCato($set_number['category_id']);
        $whereIs = $category->getSmak($smak);
        $backArr = array();
        $filter = $filters->getty($set_number['category_id']);
       return $this->render('index', ['filters' => $filter, 'category' => $whereIs, 'smak' => $smak, 'product' => $product]);
    }

    /**
     * Display one selected product
     * @param $smak
     * @param $food
     * @return string
     */
    public function actionFood($smak, $food) {
        $product = new Product;
        $category = new Category;
        $chos = new Choosen;
        $regis = new Registration;
        $orders = new Orders;
        $servire = $product->get_set($food);
        $whereIs = $category->getSmak($smak);
        $allProducts = $product->getAll();
        $ider = $session->get('login');
        $number = $session->get('number');
        $client = $regis->cliento($ider);
        $prod = $servire['product_id'];
        $getId = $chos->getId($client[0]['registration_unique'], $prod);

        if($number != NULL) {
            $like = $orders->getLikes($number);
            $likes = array();
            foreach ($like as $key) {
                $likes[] = $product->getById($key['orders_product_ider']);
            }

        } else {
            $likes = $product->getLikes($whereIs['category_order']);
        }

        return $this->render('good', ['servire' => $servire, 'category' => $whereIs, 'product' => $allProducts, 'getty' => $getId, 'likes' => $likes]);
   }
}
