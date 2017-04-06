<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use  yii\web\Session;

$session = new Session;
$session->open();

?>
<?php $this->registerJsFile('../js/profile.js'); ?>
<!-- You may need to put some content here -->
<div class="super-wrapper">
    <section class="main-firstscreen">
        <div class="main-firstscreen__bg"></div>
        <div class="wrapper">
            <?php echo \Yii::$app->view->renderFile('@app/views/site/slider.php'); ?>
        </div>
    </section>
    <section class="cabinet main-content">
        <?php echo \Yii::$app->view->renderFile('@app/views/site/content-nav.php'); ?>
        <div class="wrapper">
            <div class="content-wrapper">
                <!--				include('tpl/breadcrumbs.php'); -->
                <div class="row">
                    <div class="col-3">
                        <aside class="sidebar">
                            <ul class="sidebar-list">
                                <li class="sidebar-item">
                                    <a href="/profile" class="sidebar-link">Личные данные</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/password" class="sidebar-link">Изменить пароль</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="javascript:void(0)" class="sidebar-link active">Адрес доставки</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/favorite" class="sidebar-link">Избранное</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/orders" class="sidebar-link">Мои заказы</a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-8">
                        <div id="datasi" idish="<?= Html::encode($user_info[0]["registration_unique"]) ?>"
                             class="cabinet-title">Адреса доставки
                        </div>
                        <table id="addressTable" class="table table__address-table mb20">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Город</th>
                                <th>Улица</th>
                                <th>Дом/корпус</th>
                                <th>Квартира/офис</th>
                                <th></th>
                            </tr>
                            </thead> <?php $count = 1 ?>
                            <?php foreach ($unique as $key): ?>
                                <tr class="address-table__row"
                                    idiero="<?= Html::encode($key['client_addresses_id']) ?>">
                                    <td><a href="javascript:void(0)" onclick="closer(this)"
                                           class="circle-icon remove-row"><i class="fa fa-close"></i></a></td>
                                    <td class="rower"><?= $count ?></td>
                                    <td>
                                        <div class="column-text city"></div>
                                        <input type="text" onkeyup="showhome(this.value)"
                                               city="<?= $session->get('city') ?>" class="form-input column-edit-text"
                                               value="<?= Html::encode($key['client_addresses_city']) ?>"></td>
                                    <td>
                                        <div class="column-text street" sign="street"></div>
                                        <input type="text" class="form-input column-edit-text"
                                               value="<?= Html::encode($key['client_addresses_street']) ?>"></td>
                                    <td>
                                        <div class="column-text house"></div>
                                        <input type="text" class="form-input column-edit-text"
                                               value="<?= Html::encode($key['client_addresses_house']) ?>"></td>
                                    <td>
                                        <div class="column-text flat"></div>
                                        <input type="text" class="form-input column-edit-text"
                                               value="<?= Html::encode($key['client_addresses_flat']) ?>"></td>
                                    <td><a href="javascript:void(0)" class="circle-icon edit-row"><i
                                                class="fa fa-pencil"></i></a><a href="javascript:void(0)"
                                                                                class="circle-icon accept-row addering"><i
                                                class="fa fa-check"></i></a></td>
                                </tr>
                                <?php $count++ ?>
                            <?php endforeach; ?>
                        </table>
                        <div id="addRow" class="btn btn-red btn-big w200043">Добавить адрес</div>

	