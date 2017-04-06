<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Content extends ActiveRecord
{
    public function getty() {
        return Content::find()->all();
    }
}