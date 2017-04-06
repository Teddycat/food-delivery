<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use  yii\web\Session;
use yii\bootstrap\Carousel;
$session = new Session;
$session->open(); 
//unset($session['order']);
?>

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
                                    <a href="javascript:void(0)" class="sidebar-link active">Изменить пароль</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/profile/addresses" class="sidebar-link">Адрес доставки</a>
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
					<div id="dataso" idero="<?= Html::encode($user_info[0]["registration_unique"]) ?>" class="col-8">
						<div class="cabinet-title">Изменить пароль</div>
						<div class="row mb20">
							<div class="col-3">
								<div class="h3 text-gray light mt10">Пароль:</div>
							</div>
							<div class="col-5">
								<input id="oldPass" type="password" class="form-input" required>
							</div>
						</div>
						<div class="row mb20">
							<div class="col-3">
								<div class="h3 text-gray light mt10">Новый пароль:</div>
							</div>
							<div class="col-5">
								<input id="newPass" type="password" class="form-input" required>
							</div>
						</div>
						<div class="row mb50">
							<div class="col-3">
								<div class="h3 text-gray light mt10">Повторить:</div>
							</div>
							<div class="col-5">
								<div>
									<input id="confNewPass" type="password" class="form-input" required>
								</div>
							</div>
						</div>
						<div>
							<a href="javascript:void(0)" onclick="passSave()" class="btn btn-red btn-big w200">Сохранить</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</div>
