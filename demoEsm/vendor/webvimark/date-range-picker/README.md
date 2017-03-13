Date range picker for Yii 2
=====
Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/date-range-picker "*"
```

or add

```
"webvimark/date-range-picker": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

If input in GridView

```php

<?php DateRangePicker::widget([
	'model'=>'CampaignSearch',
	'attribute'=>'created_at',
]) ?>

```

If external input

```php

<?php $val = isset($_GET['ULogger']['create_date']) ? $_GET['ULogger']['create_date'] : ''; ?>

<div class="input-prepend superda">
        <span class="add-on"><i class='icon icon-calendar'></i></span>
        <input value='<?php echo $val; ?>' class="span12 superda" type="text" >
</div>


<?php
$this->widget('ext.Drp.Drp', array(
        'model'=>'ULogger',
        'attribute'=>'create_date',
        'selector'=>'.superda',
        'params'=>array(
                'opens'=>'right',
                'format'=>'YYYY-MM-DD H:mm',
                'timePicker'=>true,
                'timePicker12Hour'=>false,
                'timePickerIncrement'=>5,
                'locale'=>array(
                        'fromLabel'=>Yii::t("drp","С"),
                        'toLabel'=>Yii::t("drp","По"),
                        'applyLabel' => Yii::t("drp","Принять"),
                        'cancelLabel' => Yii::t("drp","Отмена"),
                        'customRangeLabel' => Yii::t("drp","Произвольная дата"),
                        'daysOfWeek' => (Yii::app()->language == 'ru') ? array('Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс') : '',
                        'monthNames' => (Yii::app()->language == 'ru') ? array('Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек') : '',
                ),
                'ranges' => array(
                        Yii::t("drp","Вчера") => array(
                                date('Y-m-d', strtotime('-1 day')), 
                                date('Y-m-d', time())
                        ),
                        Yii::t("drp","Сегодня") => array(
                                date('Y-m-d', time()), 
                                date('Y-m-d', time()) . ' 23:59'
                        ),
                        Yii::t("drp","30 дней") => array(
                                date('Y-m-d', strtotime('-1 month')), 
                                date('Y-m-d', time()) . ' 23:59'
                        ),
                        Yii::t("drp","Предыдущий месяц") => array(
                                date('Y-m-d', strtotime('first day of previous month')), 
                                date('Y-m-d', strtotime('last day of previous month')) . ' 23:59' 
                        ),
                        Yii::t("drp","Текущий месяц") => array(
                                date('Y-m-d', strtotime('first day of this month')), 
                                date('Y-m-d', time()) . ' 23:59'
                        ),
                ),
        ),
));
?>

```
