<?php
namespace webvimark\components;


use yii\base\InvalidConfigException;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class StatusColumn
 *
 * For rendering attributes with dropDown filters and colored value
 *
 * @package app\webvimark\helpers
 */
class StatusColumn extends DataColumn
{
	/**
	 * Format - ['attribute_value', 'desired_name', 'label_class']
	 *
	 * If empty it will be filled with - ['yes', 'no']
	 * If ['attribute_value', 'desired_name', false] - simple text will be rendered
	 *
	 * @var array
	 */
	public $optionsArray = [];

	/**
	 * If set, than request will be sent to this url and grid will be reloaded
	 *
	 * Format - 'toggleUrl'=>Url::to(['toggle-status', 'id'=>'_id_']),
	 * Or - 'toggleUrl'=>Url::to(['some-action', 'someParam'=>'_modelAttribute_']),
	 *
	 * @var string
	 */
	public $toggleUrl;

	/**
	 * Default is $this->grid->id . "-pjax"
	 *
	 * @var string
	 */
	public $pjaxId;

	/**
	 * If true, than async request will be used on element click and pjax will be reloaded
	 * otherwise it will be redirect
	 *
	 * @var bool
	 */
	public $withPjax = true;

	/**
	 * @var array
	 */
	protected $_labelClasses =[];

	/**
	 * Init
	 */
	public function init()
	{
		parent::init();

		$this->setDefaultOptions();

		if ( $this->toggleUrl )
		{
			if ( $this->withPjax )
				$this->grid->view->registerJs($this->jsWithPjax());
			else
				$this->grid->view->registerJs($this->jsWithoutPjax());
		}

		$this->initOptions();
	}

	/**
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function initOptions()
	{
		$this->checkOptionsArray();
		$this->setCellStyleOptions();

		$this->format = 'raw';

		foreach ($this->optionsArray as $option)
		{
			$this->filter[$option[0]] = $option[1];
			$this->_labelClasses[$option[0]] = $option[2];
		}

        if ($this->value instanceof \Closure) {
            $userFunc = $this->value;
        } else {
            $userFunc = function ($model, $key, $index, $widget) {
                return $model->{$this->attribute};
            };
        }
        $this->value = function ($model, $key, $index, $widget) use ($userFunc) {
            $attributeValue = call_user_func($userFunc, $model, $key, $index, $widget);

			if ( isset($widget->_labelClasses[$attributeValue], $widget->filter[$attributeValue]) )
			{
				$label = $widget->_labelClasses[$attributeValue];

				$class = ($label === false) ? '' : "label label-{$label}";
				$value = $widget->filter[$attributeValue];

				$style = ($label === false) ? '' : 'font-size:85%;';
				$data = '';

				if ( ! empty($this->toggleUrl) )
				{
					$style .= 'cursor:pointer;';

					preg_match('/=_\w+_/',$this->toggleUrl, $matches);

					$idAttributePlaceholder = ltrim($matches[0], '=');
					$idAttribute = trim($idAttributePlaceholder, '_');

					$toggleUrl = str_replace($idAttributePlaceholder, $model->{$idAttribute}, $this->toggleUrl);

					$dataType = empty($this->pjaxId) ? 'grid-toggle' : 'grid-toggle-pjax';
					$data .= "data-type='{$dataType}'";
					$data .= "data-url='{$toggleUrl}'";
				}

				return "<span style='{$style}' {$data} class='{$class}'> {$value} </span>";
			}
			else
			{
				return $attributeValue;
			}
		};
	}


	/**
	 * Set default options
	 */
	protected function setDefaultOptions()
	{
		if ( $this->withPjax AND ! $this->pjaxId )
			$this->pjaxId = $this->grid->id . '-pjax';
	}

	/**
	 * Set minimal width and align text in cell
	 */
	protected function setCellStyleOptions()
	{
		$this->contentOptions = ArrayHelper::merge(
			['style'=>'text-align:center; width:80px; white-space:nowrap;'],
			$this->contentOptions
		);
	}
	/**
	 * Check if optionsArray is empty and if not - fill with default values
	 *
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function checkOptionsArray()
	{
		if ( ! is_array($this->optionsArray) )
		{
			throw new InvalidConfigException('Options should be an array');
		}

		if ( empty($this->optionsArray) )
		{
			$this->optionsArray = [
				[0, Yii::t('yii', 'No'), 'warning'],
				[1, Yii::t('yii', 'Yes'), 'success'],
			];
		}
	}

	/**
	 * @return string
	 */
	protected function jsWithPjax()
	{
		$js = <<<JS
		$(document).off('click', "[data-type='grid-toggle-pjax']").on('click', "[data-type='grid-toggle-pjax']", function () {

			$.get($(this).data('url')).success(function(){
				$.pjax.reload({container: '#$this->pjaxId'});
			});
		});
JS;

		return $js;

	}

	/**
	 * @return string
	 */
	protected function jsWithoutPjax()
	{
		$js = <<<JS
		$(document).off('click', "[data-type='grid-toggle']").on('click', "[data-type='grid-toggle']", function () {

			window.location = $(this).data('url');
		});
JS;

		return $js;
	}
}