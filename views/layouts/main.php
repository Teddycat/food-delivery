<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']); ?>
        <?= Html::csrfMetaTags() ?>
        <link rel="shortcut icon" href="web/favicon.ico" type="image/x-icon" />
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php echo \Yii::$app->view->renderFile('@app/views/layouts/header.php'); ?>
        <?= $content ?>   
        <?php echo \Yii::$app->view->renderFile('@app/views/layouts/footer.php'); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>           





