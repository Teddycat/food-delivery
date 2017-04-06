<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


<!--    <div class="alert alert-danger">-->
<!--         nl2br(Html::encode($message))
<!--    </div>-->
<!---->
<!--    <p>-->
<!--        The above error occurred while the Web server was processing your request.-->
<!--    </p>-->
<!--    <p>-->
<!--        Please contact us if you think this is a server error. Thank you.-->
<!--    </p>-->


<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <center><img src="/img/404.jpg" alt=""></center>
    </section>
    <section class="news-item main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>
<!--        <div class="wrapper">-->
<!--            <div class="content-wrapper">-->
<!---->
<!--                -->
<!--            </div>-->
<!--        </div>-->
    </section>
</div>