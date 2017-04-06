<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Content;
use app\models\Category;
use app\models\Filters;
use app\models\Product;
use app\models\Orders;
use app\models\Registration;
use app\models\Addresses;
use app\models\Choosen;
use app\models\Sauce;
use app\models\City;
use app\models\Client_addresses;
use yii\web\Session;
use yii\db\Query;

class ProfileController extends Controller
{

    /**
     * All action about profile of customer
     */

    /**
     * @return string
     */
    public function actionIndex()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $content = new Content;
        $regis = new Registration;
        $order = new Orders;
        $address = new Addresses;
        $log = $_SESSION['login'];
        $pass = $_SESSION['pass'];
        $num = $_SESSION['number'];
        $user_info = $regis->getUnique($num);
        $user_amounty = $order->amounty($user_info['registration_id']);
        $user_orders = $order->getAll($user_info['registration_id']);
        $user_products = array();
        for ($i = 0; $i < count($user_orders); $i++) {
            $user_products[$i] = $order->getOrders($user_orders[$i]['orders_number']);
        }
        $addresses = $address->getty($user_info[0]['registration_unique']);
        return $this->render('index', ['model' => $model, 'user_info' => $user_info, 'user_orders' => $user_orders, 'addresses' => $addresses, 'user_amounty' => $user_amounty, 'user_products' => $user_products]);
    }

    /**
     * @return string
     */
    public function actionPassword()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $regis = new Registration;
        $log = $session['login'];
        $user_info = $regis->getty($log);
        return $this->render('password', ['model' => $model, 'user_info' => $user_info]);
    }

    /**
     *
     */
    public function actionGetcity()
    {
        $regis = new City;
        $allers = $regis->getty();
        echo json_encode($allers);

    }

    /**
     * @return string
     */
    public function actionAddresses()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $regis = new Registration;
        $address = new Addresses;
        $log = $session['login'];
        $user_info = $regis->getty($log);
        $unique = $address->getty($user_info[0]['registration_unique']);
        //$this->view->registerJsFile('../js/profile.js');
        return $this->render('addresses', ['model' => $model, 'user_info' => $user_info, 'unique' => $unique]);
    }

    /**
     * @return string
     */
    public function actionOrders()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $regis = new Registration;
        $orderi = new Orders;
        $log = $session['login'];
        $user_info = $regis->getty($log);
        $total = $orderi->getSoon($user_info[0]['registration_unique']);
        return $this->render('orders', ['model' => $model, 'user_info' => $user_info, 'total' => $total]);
    }

    /**
     * @return string
     */
    public function actionFavorite()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $regis = new Registration;
        $address = new Addresses;
        $choose = new Choosen;
        $log = $session['login'];
        $user_info = $regis->getty($log);
        $unique = $address->getty($user_info[0]['registration_unique']);
        $choosero = $choose->getty($user_info[0]['registration_unique']);
        return $this->render('favorite', ['model' => $model, 'user_info' => $user_info, 'unique' => $unique, 'choosero' => $choosero]);
    }

    /**
     *
     */
    public function actionSaver()
    {
        $arr = Yii::$app->request->post();
        $id = $arr['idero'];
        $regis = new Registration;
        $updatero = $regis->updater($arr, $id);
        echo json_encode($updatero);
    }

    /**
     *
     */
    public function actionGrabber()
    {
        $orderi = new Orders;
        $number = Yii::$app->request->post('number');
        $orderow = $orderi->getProducts($number);
        echo json_encode($orderow);
    }

    /**
     *
     */
    public function actionOrderinfo()
    {
        $ordero = Yii::$app->request->post('number');
        $orders = new Orders;
        $ordereo = $orders->getSuccess($ordero);
        echo json_encode($ordereo);
    }

    /**
     *
     */
    public function actionAddplace()
    {
        $address = new Addresses;
        $cliento = new Client_addresses;
        $arr = Yii::$app->request->post('arr');
        $id = Yii::$app->request->post('idish');
        $length = count($arr);
        foreach ($arr as $key) {
            $known = $cliento->known($key['idiero']);
            if ($known) {
                $updatero = $address->updater($key);
            } else {
                $inserter = $address->inserter($key, $id);
            }
        }
        echo json_encode($length);
    }

    /**
     *
     */
    public function actionMailer()
    {
        $mailo = Yii::$app->request->post('mailer');
        $idero = Yii::$app->request->post('ider');
        Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($mailo)
            ->setSubject('Hallo')
            ->setTextBody('HJK')
            ->setHtmlBody('<a href="antisushi/' . $idero . '">ПЕРЕЙДИТЕ ПО ССЫЛКЕ</a>')
            // ->setHtmlBody($idero)
            ->send();
        echo json_encode($mailo);
    }

    /**
     * @return string
     */
    public function actionPass()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $query = new Query();
        $older = Yii::$app->request->post('older');
        $newer = Yii::$app->request->post('newer');
        $id = intval(Yii::$app->request->post('idero'));
        if ($session->isActive) {
            $login = $session->get('login');
        }
        $authentication = $query->select(['registration_pass'])->from('registration')->where(['registration_phone' => $login])->one();
        if ((is_array($authentication) && (count($authentication) > 0)) && Yii::$app->getSecurity()->validatePassword($older, $authentication['registration_pass'])) {
            $regis = new Registration;
            $hash = Yii::$app->getSecurity()->generatePasswordHash($newer);
            $updater = $regis->upPass($hash, $id);
            echo json_encode($updater);
        } else {
            return json_encode(false);
        }
    }

    /**
     *
     */
    public function actionRepeat()
    {
        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $product = new Product;
        $orders = new Orders;
        $sauceso = new Sauce;
        $number = Yii::$app->request->post('number');
        $ordereo = $orders->getSuccess($number);
        $amount = $orders->getAmmount();
        $amount['orders_number']++;
        $amount = $amount['orders_number'];
        $newOrder = $orders->addOrder($ordereo['orders_user'], $ordereo['orders_city'], $ordereo['orders_phone'], $ordereo['orders_persons'], $ordereo['orders_sauces'], $ordereo['orders_pay_info'], $ordereo['orders_send'], $ordereo['orders_sum'], $ordereo['orders_bonus_plus'], $ordereo['orders_bonus_minus'], $ordereo['orders_price'], $ordereo['orders_promo'], $ordereo['orders_timer'], $ordereo['orders_total'], $amount);
        $products = $orders->getProducts($number);
        foreach ($products as $key) {
            $orders->addProduct($key["orders_product_ider"], $key["orders_product_name"], $key["orders_product_img"], $key["orders_product_price"], $key["orders_product_token"], $key["orders_product_weight"], $key["orders_product_kkal"], $key["orders_product_descript"], $amount);
        }
        $userSauce = $orders->getSauce($number);
        foreach ($userSauce as $key) {
            $addingSauces = $sauceso->addSauce($key['orders_sauce_name'], $key['orders_sauce_price'], $key['orders_sauce_amount'], $amount);
        }
        echo json_encode($amount);
    }

    /**
     *
     */
    public function actionDeleteNow()
    {
        $session = Yii::$app->session;
        $adres = new Addresses;
        $delete = Yii::$app->request->post('deleti');
        $result = $adres->dele($delete);
        echo json_encode($result);
    }
}
