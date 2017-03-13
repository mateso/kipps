<?php

namespace webvimark\extensions\DateRangePicker;

use yii\web\AssetBundle;

class DateRangePickerAsset extends AssetBundle
{
	public function init()
	{
		$this->sourcePath = __DIR__ . '/assets';
		$this->js = [
			'moment.min.js',
			'daterangepicker.js',
		];
		$this->css = ['daterangepicker-bs3.css'];

		parent::init();
	}
}