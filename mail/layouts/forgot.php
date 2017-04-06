<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
<h2>Здравствуйте!</h2>

<p>Это письмо автоматически отправлено с сайта www.anti-sushi.ru, так-как кто то (возможно вы) сделал Запрос на восстановление забытого логина или пароля для e-mail <?= $mail?>.</p>

<p>ЕСЛИ ВЫ НЕ ДЕЛАЛИ ЗАПРОС, просто проигнорируйте это сообщение.</p>

<p>Для того, чтобы сбросить пароль, перейдите по указанной ниже ссылке:</p>
<a href="www.anti-sushi.ru/backup/<?= $rand?>">ПЕРЕЙТИ ПО ССЫЛКЕ</a>
<p>Если при переходе по ссылке выдаётся сообщение 'Запрос с указанным идентификатором не найден', то скопируйте строчку <?php Yii::$app->request->hostInfo ?>/backup/<?= $rand?> и вставьте в адресную строку браузера.</p>

<p>С уважением,</p>
<p>администрация сайта</p>
<p>www.anti-sushi.ru</p>