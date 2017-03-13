<?php
/**
 * @var View $this
 */
?>
<?php
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\helpers\Html;
use yii\web\View;

?>
<div class="form-inline pull-right">
	<?php if ( $this->context->enableClearFilters ): ?>

		<span style="display: none" id="<?= ltrim($this->context->gridId, '#') ?>-clear-filters-btn" class="btn btn-sm btn-default">
			<?= GridPageSize::t('app', 'Clear filters') ?>
		</span>
	<?php endif; ?>


	<?= $this->context->text ?>

	<?= Html::dropDownList(
		'grid-page-size', \Yii::$app->request->cookies->getValue('_grid_page_size', 20),
		$this->context->dropDownOptions,
		['class'=>'form-control input-sm']
	) ?>
</div>