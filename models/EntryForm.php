<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $phoner;
    public $phone2;
    public $topic;
    public $message;
    public $filer;
    public $numbers;
    public $birth;
    public $isaddress;
    public $street;
    public $flat;
    public $house;
    public $passer;
    public $passer2;
    public $knowfrom;
    public $date;

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'phoner'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            // [['filer'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
        
    }
     public function upload($order)
    {
        
          return  $this->filer->saveAs('upload/' . $order . '.' . $this->filer->extension);
         // return  $this->filer->extension; 
        }

    public function comments($order)
    {

        return  $this->filer->saveAs('comments/' . $order . '.' . $this->filer->extension);
        // return  $this->filer->extension; 
    }
    
    
    /**
     * @return array customized attribute labels
     */
//    public function attributeLabels()
//    {
//        return [
//            'verifyCode' => 'Verification Code',
//        ];
//    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
//    public function contact($email)
//    {
//        if ($this->validate()) {
//            Yii::$app->mailer->compose()
//                ->setTo($email)
//                ->setFrom([$this->email => $this->name])
//                ->setSubject($this->subject)
//                ->setTextBody($this->body)
//                ->send();
//
//            return true;
//        }
//        return false;
//    }
}
