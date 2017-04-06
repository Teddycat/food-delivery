<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Content;
use app\models\City;
use app\models\Filial;
use app\models\Filters;
use app\models\Registration;
use app\models\Product;
use app\models\Schedule;
use app\models\Location;
use app\models\Callback;
use app\models\Sauce;
use app\models\News;
use app\models\Vacancy;
use app\models\Choosen;
use app\models\Statics;
use app\models\Orders;
use yii\web\Session;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Get content, shedule and filial list depends on city selected by user
     * @return string
     */
    public function actionIndex()
    {
        $session = new Session;
        $session->open();
        $content = new Content;
        $schedule = new Schedule;
        $filial = new Filial;
        $text = $content->getty();
        $times = $schedule->getty($session->get('city'));
        $session->set('times', $times);
        $phone = $filial->getty($session->get('city'));
        $session->set('phone', $phone);
        return $this->render('index', ['model' => $model, 'text' => $text]);
    }

    /**
     * display feedback of product by order number
     * @param $orderNumber
     * @return string
     */
    public function actionFeedback($orderNumber)
    {
        $registration = new Registration;
        $log = $session->get('login');
        $user = $registration->getty($log);
        return $this->render('feedback', ['model' => $model, 'number' => $orderNumber, 'user' => $user]);
    }

    /**
     * Display news page
     * @return string
     */
    public function actionNews()
    {
        $news = new News;
        $allnews = $news->getty();
        return $this->render('news', ['model' => $model, 'news' => $allnews]);
    }

    public function actionVacancy()
    {
        $vac = new Vacancy;
        $vacance = $vac->getty($session->get('city'));
        return $this->render('vacancy', ['model' => $model, 'vacancy' => $vacance]);
    }

    public function actionDelivery()
    {
        $delModel = new Statics;
        $delivery = $delModel->withcity('delivery', $session->get('city'));
        return $this->render('delivery', ['model' => $model, 'delivery' => $delivery]);
    }

    public function actionContacts()
    {
        $contactModel = new Statics;
        $contacts = $contactModel->withcity('contacts', $session->get('city'));
        return $this->render('contacts', ['model' => $model, 'contacts' => $contacts]);
    }

    public function actionAllnews($numnew)
    {
        $news = new News;
        $regis = new Registration;
        $onenews = $news->getone($numnew);
        return $this->render('allnews', ['model' => $model, 'oner' => $onenews]);
    }

    public function actionVacancion($vaca)
    {
        $vac = new Vacancy;
        $vacas = $vac->getone($vaca);
        return $this->render('vacancion', ['model' => $model, 'onevac' => $vacas]);
    }

    /**
     * Select products by category of Promo (promo, popular or fresh)
     * @return string
     */
    public function actionPromo($kindOfPromo)
    {
        $prodModel = new Product;
        $product = $prodModel->getcat('p.'. $kindOfPromo);
        return $this->render('promo', ['model' => $model, 'product' => $product]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }

    /**
     * authentication by Social network and get bonus category
     * @param $profile
     * @return int
     */
    public function actionSocial($profile)
    {
        $request = Yii::$app->request;
        $ordio = new Orders;
        $regis = new Registration;
        $query = new Query();

        $authentication = $query->select(['registration_pass'])->from('registration')->where(['registration_social' => $profile['id']])->one();

        if ((is_array($authentication) && (count($authentication) > 0))) {
            $date = strtotime(Yii::$app->formatter->asDatetime('now'));
            $user_info = $regis->getSocial($profile['id']);
            $summi = $ordio->getTimer($date, $user_info[0]['registration_unique']);
            $summi = intval($summi["SUM(orders_total)"]);
            if ($summi <= 999)
                $tokens = 3;
            if ($summi >= 1000 && $summi <= 2499)
                $tokens = 5;
            if ($summi >= 2500 && $summi < 4999)
                $tokens = 6;
            if ($summi >= 5000 && $summi < 7499)
                $tokens = 7;
            if ($summi >= 7500 && $summi < 9999)
                $tokens = 8;
            if ($summi >= 10000 && $summi < 14999)
                $tokens = 9;
            if ($summi >= 15000 && $summi < 999999)
                $tokens = 10;
            $session->set('login', $user_info[0]['registration_phone']);
            $session->set('tokens', $tokens);
            $session->set('bonuses', $user_info[0]['registration_bonuses']);
            $session->set('number', $user_info[0]['registration_unique']);
            $session->set('name', $profile['name']);
            return 1;
        } else {
            $maxer = $regis->getMax();
            $maxer++;
            $dater = date("Y-m-d H:i:s");
            $regis->newSocial($maxer, $profile['id'], $profile['name'], $dater);
            return 2;
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * get array of product with selected filter(s)
     */
    public function actionProduct()
    {
        $product = new Product;
        $filters = new Filters;
        $arr = Yii::$app->request->post('arr');
        $filter = Yii::$app->request->post('filter');
        $backArr = array();
        if (count($arr) > 0) {
            foreach ($arr as $key) {
                $id = $filters->getid($key);
                $list = $product->getList($id['filters_id']);

                foreach ($list as $key) {
                    $backArr[] =$product->filtern($key['product_filter_prod']);
                }
            }
            $count = count($backArr);
            for ($i = 0; $i < $count; $i++)
                for ($j = $i + 1; $j < $count; $j++)
                    if ($backArr[$i] == $backArr[$j])
                        $backArr[$j] = null;
        } else {
            $backArr = $product->getCato($filter);
        }
        echo json_encode($backArr);
    }

    /**
     * Every product have two prices: for little and big portions. We get all parameters for every options of price
     */
    public function actionAjax()
    {
        $product = new Product;
        $id = Yii::$app->request->post('id');
        $price = Yii::$app->request->post('price');
        $weight = Yii::$app->request->post('weight');
        $kkal = Yii::$app->request->post('kkal');
        $orders = $product->getAjax($id, $price, $weight, $kkal);
        if ($orders['product_choice'] == 1) {
            $startprice = $orders[$price] * $orders['product_percent'];
            $midprice = round(($startprice / 100));
            $orders['price'] = $orders[$price] - $midprice;
        } else if ($orders['product_choice'] == 2) {
            $orders['price'] = $orders['product_fixprice'];
        }
        $orders['whatprice'] = $price;
        // $orders[$price] = $price;
        if ($session->isActive) {
            $orderAll = $session['order'];
            $count = count($orderAll);
            if (isset($_SESSION['order'][$count])) {
                $_SESSION['order'][++$count] = $orders;
            } else
                $_SESSION['order'][$count] = $orders;
            $orderSession = $_SESSION['order'];
        }
        $orders = $orderSession;
        $price1 = array();
        $price2 = array();
        foreach ($orders as $key) {
            if ($key['whatprice'] == 'product_price1') {
                $price1[] = $key['product_id'];
            } else if ($key['whatprice'] == 'product_price2') {
                $price2[] = $key['product_id'];
            }
        }
        $price1 = array_count_values($price1);
        $price2 = array_count_values($price2);
        $session->set('price1', $price1);
        $session->set('price2', $price2);
        echo json_encode($orderSession);
    }

    /**
     * add product to basket
     */
    public function actionTobasket()
    {
        $product = new Product;
        $thing = Yii::$app->request->post('thing');
        $pricer = Yii::$app->request->post('pricer');
        $fromer = $product->fromer($thing);
        if ($fromer['product_price1'] == $pricer) {
            $price = 'product_price1';
            $weight = 'product_weight';
            $kkal = 'product_kkal';
        } else if ($fromer['product_price2'] == $pricer) {
            $price = 'product_price2';
            $weight = 'product_weight_2';
            $kkal = 'product_kkal2';
        }
        $orders = $product->getAjax($thing, $price, $weight, $kkal);
        if ($session->isActive) {
            $orderAll = $session['order'];
            $count = count($orderAll);
            if (isset($_SESSION['order'][$count])) {
                $_SESSION['order'][++$count] = $orders;
            } else
                $_SESSION['order'][$count] = $orders;
            $orderArr = $_SESSION['order'];
        }
        echo json_encode($orderArr);
    }

    /**
     * delete product
     */
    public function actionDeleteProduct()
    {
        $session = new Session;
        $session->open();
        $delete = Yii::$app->request->post('delete');
        $choose = new Choosen;
        $result = $choose->dele($delete);
        echo json_encode($result);
    }

    /**
     * Order process
     */
    public function actionOrder()
    {
        $orders = new Orders;
        $sauceso = new Sauce;
        $regis = new Registration;
        $user = Yii::$app->request->post('user');
        $city = Yii::$app->request->post('city');
        $phone = Yii::$app->request->post('phone');
        $persons = Yii::$app->request->post('persons');
        $sauces = Yii::$app->request->post('sauces');
        $payInfo = Yii::$app->request->post('payInfo');
        $sendOrder = Yii::$app->request->post('sendOrder');
        $sumOrder = Yii::$app->request->post('sumOrder');
        $bonusPlus = intval(Yii::$app->request->post('bonusPlus'));
        $bonusMinus = intval(Yii::$app->request->post('bonusMinus'));
        $devPrice = intval(Yii::$app->request->post('devPrice'));
        $timer = Yii::$app->request->post('timer');
        date_default_timezone_set('Europe/Moscow');
        $dater = date('Y-m-d H:i:s');
        $dater = strtotime($dater);
        $totalSum = Yii::$app->request->post('totalSum');
        $userSauce = Yii::$app->request->post('userSauce');
        if ($session->isActive) {
            $amount = $orders->getAmmount();
            $amount['orders_number']++;
            $amount = $amount['orders_number'];
        }
        if ($session->has('tokens')) {
            $tokens = $session->get('tokens');
        } else {
            $tokens = 0;
        }
        $client = $session->get('number');
        if ($client == NULL) {
            $client = 0;
        }
        $orders->addOrder($user, $city, $phone, $persons, $sauces, $payInfo, $sendOrder, $sumOrder, $bonusPlus, $bonusMinus, $devPrice, $tokens, $timer, $totalSum, $tokens, $amount, $dater, $client);
        if (count($userSauce) > 0) {
            foreach ($userSauce as $key) {
                $addingSauces = $sauceso->addSauce($key['name'], $key['price'], $key['amount'], $amount, $key['inputer']);
            }
        }
        $price1 = $session->get('price1');
        $price2 = $session->get('price2');
        $order = array();
        $temp = Yii::app()->params['key_product'];
        $ordering = $session['order'];
        foreach ($price1 as $item => $value) {
            foreach ($ordering as $key) {
                if ($item == intval($key['product_id'])) {
                    if ($temp != intval($key['product_id'])) {
                        if (isset($price2[$item])) {
                            $key["price1_num"] = $value;
                            $key["price2_num"] = $price2[$item];
                            $order[] = $key;
                        } else {
                            $key["price1_num"] = $value;
                            $key["price2_num"] = 0;
                            $order[] = $key;
                        }
                    }
                }
            }
        }

        foreach ($order as $key) {
            $orders->addProduct($key["product_id"], $key["product_name"], $key["product_img"], $key["price"], $key["weight"], $key["kkal"], $key["product_description"], $key["price1_num"], $key["price2_num"], $amount);
        }

        if ($bonusPlus != 0) {
            $getBon = $regis->getbon($session['number']);
            $bonny = $getBon['registration_bonuses'] + $bonusPlus - $bonusMinus;
            $regis->upbon($session['number'], $bonny);
            $session->set('bonuses', $bonny);
        }
        echo json_encode($amount);
    }

    /**
     * get sauces
     */
    public function actionSauces()
    {
        $post = Yii::$app->request->post();
        $count = Yii::$app->request->post('count');
        $_SESSION['sauces'][$count]['name'] = Yii::$app->request->post('sauceName');
        $_SESSION['sauces'][$count]['price'] = Yii::$app->request->post('saucePrice');
        $_SESSION['sauces'][$count]['consider'] = Yii::$app->request->post('consider');
        echo json_encode($post);
    }

    /**
     * Get working time of service
     */
    public function actionTimes()
    {
        $schedule = new Schedule;
        $day = Yii::$app->request->post('times');
        $times = $session->get('times');
        $newtime = '';
        foreach ($times as $key) {
            if ($key['schedule_day'] == $day) {
                $newtime = $key['schedule_time'];
            }
        }
        echo json_encode($newtime);
    }

}
