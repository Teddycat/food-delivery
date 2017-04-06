<?php

use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $id string */
/** @var $services stdClass[] See EAuth::getServices() */
/** @var $action string */
/** @var $popup bool */
/** @var $assetBundle string Alias to AssetBundle */

Yii::createObject(['class' => $assetBundle])->register($this);

// Open the authorization dilalog in popup window.
if ($popup) {
	$options = [];
	foreach ($services as $name => $service) {
		$options[$service->id] = $service->jsArguments;
	}
	$this->registerJs('$("#' . $id . '").eauth(' . json_encode($options) . ');');
}

?>

		<?php
		foreach ($services as $name => $service) {
			switch ($name) {
				case 'vkontakte':
					$icon = 'fa fa-vk';
					break;
				case 'facebook':
					$icon = 'fa fa-facebook';
					break;
				case 'odnoklassniki':
					$icon = 'fa fa-odnoklassniki';
					break;

			}
			echo Html::a('<i class="'.$icon.'"></i>', [$action, 'service' => $name], [
				'class' => 'modal-social__link',
				'data-eauth-service' => $service->id,
			]);

		}

		?>

