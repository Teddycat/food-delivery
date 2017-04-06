<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;

class Delivery extends ActiveRecord {

    public function getty() {
        return Delivery::find()->one();
    }
}
