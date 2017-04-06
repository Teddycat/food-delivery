<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\EntryForm;
use app\models\Orders;
use app\models\Registration;
use app\models\Feedback;
use yii\helpers\Html;
use yii\web\Session;

class EntryController extends Controller {

    /**
     * Methods for work with Forms
     */

    public function actionIndex() {
        $model = new EntryForm;
        $filter = new Html();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $ok = true;
            $request = Yii::$app->request->post('EntryForm');
            $name = $filter->encode($request['name']);
            $email = $filter->encode($request['email']);
            $phone = $filter->encode($request['phone']);
            $dater = date("Y-m-d H:i:s");
            $result = Yii::$app->db->createCommand()->insert('registration', ['registration_name' => $name, 'registration_mail' => $email, 'registration_phone' => $phone, 'registration_date' => $dater])->execute();
            if ($result)
                echo json_encode($result);
        } else {
            $ok = false;
            echo json_encode($request);
        }
    }

    public function actionNewpass() {
        $request = Yii::$app->request;
        $model = new EntryForm;
        $filter = new Html();
        $regis = new Registration;
        $req = Yii::$app->request->post('EntryForm');
        $pass = $filter->encode($req['passer']);
        $hash = Yii::$app->getSecurity()->generatePasswordHash($pass);
        $mail = $filter->encode($req['email']);

        $result = $regis->newpass($mail, $hash);
        $regis->delkey($mail);
        echo json_encode($result);
    }
 public function actionCity() {

        $session = new Session;
        $session->open();
        $session = Yii::$app->session;
        $city = Yii::$app->request->post('place');
        $session->set('city', $city);
        echo json_encode(true);
 }
    public function actionUpload() {
        $model = new EntryForm;
        $fba = new Feedback;
        $posto = Yii::$app->request->post('EntryForm');
        $order = $posto['numbers'];
        $link = Yii::$app->request->hostInfo;
        $link = $link . '/profile';


        if (Yii::$app->request->isPost) {
            $model->filer = UploadedFile::getInstance($model, 'filer');
            $extens = $model->filer->extension;
            $fileo = 'upload/' . $order . '.' . $extens;
            $addFile = $model->upload($order);

            if ($addFile) {
                $date = date('Y-m-d H:i:s');
                $addFB = $fba->inserter($posto, $order, $fileo, $date);

                if ($addFB) {
                    Yii::$app->mailer->compose()
                            ->setFrom('no-reply@anti-sushi.ru')
                            ->setTo($posto['email'])
                            ->setSubject('Ваш отзыв для AntiSushi принят')
                            ->setTextBody('HJK')
                            ->setHtmlBody($posto['message'])
                            ->send();
                }
                $this->redirect($link);

                return;
            }
        }
    }


    public function actionSigner() {
        $request = Yii::$app->request;
        $regis = new Registration;
        $errors = [];
        $labels = [];
        $address = [];
        $formo = $request->post('EntryForm');
        $name = $formo['name'];
        $phone = $formo['phoner'];
        $phone2 = $formo['phone2'];
        $email = $formo['email'];
        $password = $formo['passer'];
        $checker = $formo['isadress'];
        $fromer = $formo['knowfrom'];
        $birth = $formo['birth'];
        $dater = date("Y-m-d H:i:s");
        if ($checker) {
            $address['street'] = $request->post('street');
            $address['house'] = $request->post('house');
            $address['flat'] = $request->post('flat');
        }
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        $query = new Query();
        $identity_mail = $query->from('registration')->where(['registration_mail' => $mail])->exists();

        if ($identity_mail) {
            $errors[] = 'Такой email уже существует.';
            $labels[] = 'login';
        }

        if (count($errors) == 0) {
            $maxer = $regis->getMax();
            $maxer++;
            $query->createCommand()->insert('registration', ['registration_phone' => $phone, 'registration_phone2' => $phone2, 'registration_name' => $name, 'registration_date' => $dater, 'registration_unique' => $maxer, 'registration_mail' => $email, 'registration_bonuses' => 0, 'registration_birthday' => $birth, 'registration_pass' => $hash])->execute();
            $fr = $regis->addFrom($fromer);
            $link = Yii::$app->request->hostInfo;
            $this->redirect($link);
        } else {
            $link = Yii::$app->request->hostInfo;
            //echo '<script>alert("'.$errors[0].'")</script>';
              // return json_encode(['result' => false, 'errors' => $errors, 'labels' => $labels]);
            foreach ($errors as $key) {
                echo $key.'<br>';
            }

            echo '<br><a href="'.$link.'/sign"><button class="btn btn-big btn-red">ВЕРНУТЬСЯ</button></a>';
        }
    }

    public function actionForgot() {
        $request = Yii::$app->request;
        $regis = new Registration;
        $formo = $request->post('EntryForm');
        $mail = $formo['email'];
        $isMail = $regis->findmail($mail);
        if (is_array($isMail)) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $rand = '';
            for ($i = 0; $i <= 32; $i++) {
                $rand .= $characters[mt_rand(0, strlen($characters) - 1)];
            }
            $regis->updatekey($rand, $mail);
            Yii::$app->mailer->compose('layouts/forgot', [
                        'rand' => $rand,
                        'mail' => $mail,
                    ])
                    ->setFrom('from@domain.com')
                    ->setTo($mail)
                    ->setSubject('Восстановление пароля')
                    ->send();

            echo json_encode(true);
        } else {

            echo json_encode(false);
        }
    }

    public function actionLogin() {
        $request = Yii::$app->request;
        $ordio = new Orders;
        $regis = new Registration;

        $formo = $request->post('EntryForm');
        $login = $formo['email'];
        $password = $formo['passer'];
        $query = new Query();

        $authentication = $query->select(['registration_pass'])->from('registration')->where(['registration_mail' => $login])->one();

        if ((is_array($authentication) && (count($authentication) > 0)) && Yii::$app->getSecurity()->validatePassword($password, $authentication['registration_pass'])) {
            $hash = trim($authentication['registration_pass']);
            $identity = $query->select(['registration_phone', 'registration_phone', 'registration_name', 'registration_unique', 'registration_bonuses'])->from('registration')->where(['registration_mail' => $login, 'registration_pass' => $hash])->one();
            if (is_array($identity) && (count($identity) > 0)) {
                $session = new Session();
                $session->open();

                $date = strtotime(Yii::$app->formatter->asDatetime('now'));
                $user_info = $regis->gettier($login, $hash);
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
                $session->set('pass', trim($hash));
                $session->set('login', $login);
                $session->set('tokens', $tokens);
                $session->set('bonuses', $identity['registration_bonuses']);
                $session->set('number', $identity['registration_unique']);
                $session->set('name', $identity['registration_name']);
                $link = Yii::$app->request->hostInfo;
                return Yii::$app->response->redirect($link, 302);
            }
        } else {
            echo "Неверный логин или пароль";
        }
    }

    public function actionAdmin() {
        $request = Yii::$app->request;
        $ordio = new Orders;
        $formo = $request->post('EntryForm');
        $login = $formo['name'];
        $password = $formo['passer'];
        $query = new Query();

        $authentication = $query->select(['admin_pass'])->from('admin')->where(['admin_login' => $login])->one();

        if ((is_array($authentication) && (count($authentication) > 0)) && Yii::$app->getSecurity()->validatePassword($password, $authentication['admin_pass'])) {
            $hash = trim($authentication['admin_pass']);
            $identity = $query->select(['admin_name', 'admin_img', 'admin_level', 'admin_city'])->from('admin')->where(['admin_login' => $login, 'admin_pass' => $hash])->one();
            if (is_array($identity) && (count($identity) > 0)) {
                $session = new Session();
                $session->open();

                $session->set('name', $identity['admin_name']);
                $session->set('level', $identity['admin_level']);
                $session->set('admincity', $identity['admin_city']);

                echo json_encode(['result' =>true]);
            } else {
                echo "NO";
            }
        } else {
            echo "Неверный логин или пароль";
        }
    }

}
