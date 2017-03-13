<?php
namespace webvimark\extensions\GridBulkActions;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Url;
use Yii;

class GridBulkActions extends Widget
{
	/**
	 * @var array
	 */
	public $actions;

	/**
	 * @var string
	 */
	public $gridId;

	/**
	 * Default - $this->gridId . '-pjax'
	 *
	 * @var string
	 */
	public $pjaxId;

	/**
	 * @var string
	 */
	public $okButtonClass = 'btn btn-sm btn-default';

	/**
	 * @var string
	 */
	public $dropDownClass = 'form-control input-sm';

	/**
	 * @var string
	 */
	public $wrapperClass = 'form-inline';

	/**
	 * @var string
	 */
	public $promptText;

	/**
	 * @var string
	 */
	public $confirmationText;

	/**
	 * Multilingual support
	 */
	public function init()
	{
		parent::init();
		$this->registerTranslations();

		$this->promptText = $this->promptText ? $this->promptText : GridBulkActions::t('app', '--- With selected ---');
		$this->confirmationText = $this->confirmationText ? $this->confirmationText : GridBulkActions::t('app', 'Delete elements?');
	}

	/**
	 * Multilingual support
	 */
	public function registerTranslations()
	{
		$i18n = Yii::$app->i18n;
		$i18n->translations['widgets/GridBulkActions/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath' => __DIR__ . '/messages',
			'fileMap' => [
				'widgets/GridBulkActions/app' => 'app.php',
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
		return Yii::t('widgets/GridBulkActions/' . $category, $message, $params, $language);
	}

	/**
	 * @throws \yii\base\InvalidConfigException
	 * @return string
	 */
	public function run()
	{
		if ( ! $this->gridId )
		{
			throw new InvalidConfigException('Missing gridId param');
		}

		$this->setDefaultOptions();

		$this->view->registerJs($this->js());

		return $this->render('index');
	}

	/**
	 * Set default options
	 */
	protected function setDefaultOptions()
	{
		if ( ! $this->actions )
		{
			$this->actions = [
				Url::to(['bulk-activate'])=>GridBulkActions::t('app', 'Activate'),
				Url::to(['bulk-deactivate'])=>GridBulkActions::t('app', 'Deactivate'),
				'----'=>[
					Url::to(['bulk-delete'])=>GridBulkActions::t('app', 'Delete'),
				],
			];
		}

		if ( ! $this->pjaxId )
		{
			$this->pjaxId = $this->gridId . '-pjax';
		}
	}

	/**
	 * @return string
	 */
	protected function js()
	{
		$js = <<<JS

		// Select values in bulk actions list
		$(document).off('change', '[name="grid-bulk-actions"]').on('change', '[name="grid-bulk-actions"]', function () {
			var _t = $(this);
			var okButton = $(_t.data('ok-button'));

			if (_t.val()) {
				okButton.removeClass('disabled');
			}
			else {
				okButton.addClass('disabled');
			}
		});

		// Clicking OK button
		$(document).off('click', '.grid-bulk-ok-button').on('click', '.grid-bulk-ok-button', function () {
			var _t = $(this);
			var list = $(_t.data('list'));

			if (list.val().indexOf('bulk-delete') >= 0) {
				if ( ! confirm('$this->confirmationText') )
					return false;
			}

			$.post(list.val(), $(_t.data('grid') + ' [name="selection[]"]').serialize() )
				.done(function(){
					_t.addClass('disabled');
					list.val('');

					$.pjax.reload({container: _t.data('pjax')});
				});
		});
JS;

		return $js;

	}
} 
