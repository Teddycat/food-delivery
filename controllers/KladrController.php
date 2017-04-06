<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\assets;
use Kladr;

class KladrController extends Controller
{
    /**
     * API for work with checking of input address
     */

    public function actionPlaces()
    {
        $city = Yii::$app->request->post('city');
        $api = new Kladr\Api('51dfe5d42fb2b43e3300006e', '86a2c2a06f1b2451a87d05512cc2c3edfdf41969');

        $query = new Kladr\Query();
        $query->ContentName = $city;
        $query->ContentType = Kladr\ObjectType::City;
        $query->WithParent = true;
        $query->Limit = 2;

        $result = $api->QueryToArray($query);
        echo json_encode($result);
    }

    public function actionGetting()
    {
        $city = Yii::$app->request->post('city');
        $street = Yii::$app->request->post('street');
        $house = Yii::$app->request->post('house');
        echo \Yii::$app->view->renderFile('@app/views/basket/kladr.php');
        $api = new Kladr\Api('51dfe5d42fb2b43e3300006e', '86a2c2a06f1b2451a87d05512cc2c3edfdf41969');

        $result = array();
        $query = new Kladr\Query();
        $query->ContentName = $city;
        $query->ContentType = Kladr\ObjectType::City;
        $query->WithParent = true;
        $query->Limit = 5;
        $citing = $api->QueryToArray($query);

        $query1 = new Kladr\Query();
        $query1->ContentName = $street;
        $query1->ContentType = Kladr\ObjectType::Street;
        $query1->WithParent = true;
        $query1->Limit = 10;
        $query1->ParentType = Kladr\ObjectType::City;
        $query1->ParentId = $citing[0]['id'];
        $streetname = $api->QueryToArray($query1);
        $result['street'] = $streetname;

        $res = [];
        foreach ($result['street'] AS $item) {
            $res[] = $item['name'];
        }
        $res = array_unique($res);
        $result['street'] = $res;
        $result['city'] = $citing;

        echo json_encode($result);
    }

    public function actionGethouse()
    {
        $city = Yii::$app->request->post('city');
        $street = Yii::$app->request->post('street');
        echo \Yii::$app->view->renderFile('@app/views/basket/kladr.php');
        $api = new Kladr\Api('51dfe5d42fb2b43e3300006e', '86a2c2a06f1b2451a87d05512cc2c3edfdf41969');

        $query = new Kladr\Query();
        $query->ContentName = $city;
        $query->ContentType = Kladr\ObjectType::City;
        $query->WithParent = true;
        $query->Limit = 2;
        $citing = $api->QueryToArray($query);

        $query1 = new Kladr\Query();
        $query1->ContentName = $street;
        $query1->ContentType = Kladr\ObjectType::Street;
        $query1->WithParent = true;
        $query1->Limit = 10;
        $query1->ParentType = Kladr\ObjectType::City;
        $query1->ParentId = $citing[0]['id'];
        $streetname = $api->QueryToArray($query1);

        echo json_encode($streetname);
    }

}



