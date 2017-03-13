<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ExpendituresSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditures-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'expenditure_id') ?>

    <?= $form->field($model, 'financial_year') ?>

    <?= $form->field($model, 'expenditure_type') ?>

    <?= $form->field($model, 'expenditure_description') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'expenditure_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'who_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
