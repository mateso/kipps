<?php
namespace webvimark\extensions\DateRangePicker;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * DateRangePicker
 *
 * Wrapper for https://github.com/dangrossman/bootstrap-daterangepicker 
 * 
 * @author vi mark <webvimark@gmail.com> 
 * @license MIT
 */
class DateRangePicker extends Widget
{
        /**
         * @var string
         */
        public $selector;

        /**
	 * For example: can be "PostSearch" as string or $searchModel for PostSearch class
	 *
         * @var mixed
         */
        public $model;

        /**
         * @var string
         */
        public $attribute;

        /**
	 * Event listener attached to the body to be sure that plugin works even after AJAX refresh
	 * To improve performance you can set some container ID that will be not changed during AJAX refresh
	 *
         * @var string
         */
        public $domContainer = 'body';

        /**
         * Datepicker params 
         * 
         * @var array
         */
        public $pluginOptions = [];

        public $applyCallback = '';


        protected $_selector;
	protected $_params = [
		'opens'               => 'left',
		'format'              => 'YYYY-MM-DD H:mm',
		'showDropdowns'       => true,

		'timePicker'          => true,
		'timePicker12Hour'    => false,
		'timePickerIncrement' => 5,
        ];

	/**
	 * Multilingual support
	 */
	public function init()
	{
		parent::init();
		$this->registerTranslations();
	}

	/**
	 * Multilingual support
	 */
	public function registerTranslations()
	{
		$i18n = Yii::$app->i18n;
		$i18n->translations['widgets/DateRangePicker/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => __DIR__ . '/messages',
			'fileMap' => [
				'widgets/DateRangePicker/app' => 'app.php',
			],
		];
	}

	/**
	 * @param string $category
	 * @param string $message
	 * @param array  $params
	 * @param null   $language
	 *
	 * @return string
	 */
	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('widgets/DateRangePicker/' . $category, $message, $params, $language);
	}

        /**
         * init 
         */
        public function run()
        {
		// If $searchModel has been passed instead of string
		if ( is_object($this->model) )
		{
			$this->model = (new \ReflectionClass($this->model))->getShortName();
		}

                if ( $this->selector )
                {
                        $this->_selector = $this->selector;
                }
                elseif ( $this->model AND $this->attribute ) 
                {
                        $this->_selector = 'input[name="' . $this->model .'[' . $this->attribute . ']"]';
                } 

                if ( ! $this->_selector )
                        throw new InvalidConfigException('Define selector or model + attributes');

		DateRangePickerAsset::register($this->view);


                // If applyCallback not set, then we try to update given grid
                if ( ! $this->applyCallback AND $this->model AND $this->attribute AND $this->selector )
                {
                        $this->applyCallback = "$('input[name=\"{$this->model}[{$this->attribute}]\"]').val(picker.startDate.format('{$this->_params['format']}') + ' - ' + picker.endDate.format('{$this->_params['format']}'));";
                        $this->applyCallback .= "$('input[name=\"{$this->model}[{$this->attribute}]\"]').trigger('change');";
                }

		$this->view->registerJs(<<<JS
			var container = $('$this->domContainer');

			container.off('focus', '$this->_selector').on('focus', '$this->_selector', function(){
				$(this).daterangepicker({$this->_mergeParams()});
			});

			container.off('apply.daterangepicker', '$this->_selector').on('apply.daterangepicker', '$this->_selector', function(ev, picker) {
				$('$this->_selector').trigger('change');
				$this->applyCallback;
			});
JS
);

        }

        /**
         * _mergeParams 
         * 
         * @return string json array
         */
        protected function _mergeParams()
        {
		$this->_params['locale'] = [
			'firstDay'         => 1,
			'fromLabel'        => DateRangePicker::t("app", "FROM"),
			'toLabel'          => DateRangePicker::t("app", "TO"),
			'applyLabel'       => DateRangePicker::t("app", "Apply"),
			'cancelLabel'      => DateRangePicker::t("app", "Cancel"),
			'customRangeLabel' => DateRangePicker::t("app", "Custom range"),
			'daysOfWeek'       => [
				DateRangePicker::t("app", 'Su'),
				DateRangePicker::t("app", 'Mo'),
				DateRangePicker::t("app", 'Tu'),
				DateRangePicker::t("app", 'We'),
				DateRangePicker::t("app", 'Th'),
				DateRangePicker::t("app", 'Fr'),
				DateRangePicker::t("app", 'Sa'),
			],
			'monthNames'       => [
				DateRangePicker::t("app", 'Jan'),
				DateRangePicker::t("app", 'Feb'),
				DateRangePicker::t("app", 'Mar'),
				DateRangePicker::t("app", 'Apr'),
				DateRangePicker::t("app", 'May'),
				DateRangePicker::t("app", 'Jun'),
				DateRangePicker::t("app", 'Jul'),
				DateRangePicker::t("app", 'Aug'),
				DateRangePicker::t("app", 'Sep'),
				DateRangePicker::t("app", 'Oct'),
				DateRangePicker::t("app", 'Nov'),
				DateRangePicker::t("app", 'Dec'),
			],
		];

		if ( !isset($this->pluginOptions['ranges']) )
		{
			$this->_params['ranges'] = [
				DateRangePicker::t("app","Yesterday") => array(
					date('Y-m-d', strtotime('-1 day')),
					date('Y-m-d', time())
				),
				DateRangePicker::t("app","Today") => array(
					date('Y-m-d', time()),
					date('Y-m-d', time()) . ' 23:59'
				),
				DateRangePicker::t("app","7 days") => array(
					date('Y-m-d', strtotime('-1 week')),
					date('Y-m-d', time()) . ' 23:59'
				),
				DateRangePicker::t("app","30 days") => array(
					date('Y-m-d', strtotime('-1 month')),
					date('Y-m-d', time()) . ' 23:59'
				),
				DateRangePicker::t("app","Previous month") => array(
					date('Y-m-d', strtotime('first day of previous month')),
					date('Y-m-d', strtotime('last day of previous month')) . ' 23:59'
				),
				DateRangePicker::t("app","This month") => array(
					date('Y-m-d', strtotime('first day of this month')),
					date('Y-m-d', time()) . ' 23:59'
				),
			];
		}

                return json_encode(ArrayHelper::merge($this->_params, $this->pluginOptions));
        }
}
