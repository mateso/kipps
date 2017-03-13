<?php

namespace webvimark\extensions\BootstrapSwitch;

use yii\web\AssetBundle;

class BootstrapSwitchAsset extends AssetBundle
{
	public function init()
	{
		$this->sourcePath = __DIR__ . '/assets';
		$this->css = ['css/bootstrap-switch.min.css'];
		$this->js = ['js/bootstrap-switch.min.js'];

		parent::init();
	}
}