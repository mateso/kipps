<?php
namespace webvimark\components;


use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class StatusColumn
 *
 * For rendering attributes with dropDown filters and colored value
 *
 * @package app\webvimark\helpers
 */
class SorterColumn extends DataColumn
{
	/**
	 * @var string
	 */
	public $attribute = 'sorter';

	/**
	 * Default is $this->grid->id . "-pjax"
	 *
	 * @var string
	 */
	public $pjaxId;

	/**
	 * Button name when it's ready to sort. Default - "Sort"
	 *
	 * @var string
	 */
	public $sortButtonName = 'Sort';

	/**
	 * After sort button will be disabled for X seconds and renamed according to this param.
	 * Default - "Sorting..."
	 *
	 * @var string
	 */
	public $sortingButtonName = 'Sorting...';

	/**
	 * @var string
	 */
	public $buttonClass = 'btn btn-sm btn-primary';

	/**
	 * @var string
	 */
	public $inputClass;

	/**
	 * "filter" or "footer"
	 *
	 * @var string
	 */
	public $buttonPlace = 'filter';

	/**
	 * Url where requests will be send
	 * Default - Url::to(['grid-sort'])
	 *
	 * @var string
	 */
	public $sortUrl;


	/**
	 * Init
	 */
	public function init()
	{
		parent::init();

		$this->setDefaultOptions();
		$this->setCellStyleOptions();
		$this->initOptions();

		$this->grid->view->registerJs($this->sortButtonJs());

	}

	/**
	 * @throws \yii\base\InvalidConfigException
	 */
	protected function initOptions()
	{
		$this->{$this->buttonPlace} = Html::tag(
			'span',
			$this->sortButtonName,
			['class'=>'grid-sort-button '.$this->buttonClass]
		);

		$this->format = 'raw';

		$this->value = function($model, $key, $index, $widget)
		{
			return Html::textInput(
				$this->attribute . "[{$model->id}]",
				$model->{$this->attribute},
				[
					'style'=>'width:40px; text-align:center',
					'class'=>'grid-sort-input '.$this->inputClass,
				]
			);

		};
	}

	/**
	 * Set minimal width and align text in cell
	 */
	protected function setCellStyleOptions()
	{
		$this->contentOptions = ArrayHelper::merge(
			['style'=>'text-align:center; width:10px; white-space:nowrap;'],
			$this->contentOptions
		);

		$this->filterOptions = ArrayHelper::merge(
			['style'=>'text-align:center; width:10px; white-space:nowrap;'],
			$this->filterOptions
		);
	}

	/**
	 * Set default options
	 */
	protected function setDefaultOptions()
	{
		if ( ! $this->sortUrl )
			$this->sortUrl = Url::to(['grid-sort']);

		if ( ! $this->pjaxId )
			$this->pjaxId = $this->grid->id . '-pjax';

	}

	/**
	 * @return string
	 */
	protected function sortButtonJs()
	{
		$gridId = '#'.$this->grid->id;
		$url = $this->sortUrl;
		$sortingText = $this->sortingButtonName;
		$pjaxId = '#'.$this->pjaxId;

		$js = <<<JS
		$(document).off('click', ".grid-sort-button").on('click', ".grid-sort-button", function () {
			var _t = $(this);
			_t.addClass('disabled').html('$sortingText');

			$.post('$url', $('$gridId .grid-sort-input').serialize() )
				.done(function(){
					setTimeout(function(){
						$.pjax.reload({container: '$pjaxId'});
					}, 500);
				});
		});
JS;

		return $js;

	}
}
