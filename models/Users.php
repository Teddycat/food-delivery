<?php

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\Session;
use yii\db\Query;


class User extends ActiveRecord
{
    protected $table = 'users';
    protected $data = null;
    
    
    public function __construct()
    {
        parent::__construct();
        $this->getAuthorization();         
    }
    
    
    private function getAuthorization()
    {
        $session = new Session();
        $session->open();
        if ($session->isActive) {
            if ($session->has('hash') && $session->has('id')) {
                $hash  = trim(htmlspecialchars($session->get('hash')));
                $id    = trim(base64_decode($session->get('id')));
                $query = new Query();
                $identity = $query->from('users')->where(['id' => $id, 'hash' => $hash])->one();
                return $this->data = (is_array($identity) && (count($identity) > 0)) ? $identity : $this->unsetAuthorization();
            }
        }
    }
    
    
    public function unsetAuthorization()
    {
        $session = new Session();
        $session->open();
        if ($session->isActive) {
            $session->remove('hash');
            $session->remove('id');
        }
    }
    
    
    public function isUser()
    {
        return (is_array($this->data) && (count($this->data) > 0)) ? true : false;
    }
    
    
    public function getData($filed = '')
    {
        return $this->isUser() ? (trim($filed) != '') ? trim($this->data[$filed]) : array_reverse($this->data) : false;
    }
}