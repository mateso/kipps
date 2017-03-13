<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditureTypesSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditure-types-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'expenditure_type_id') ?>

    <?= $form->field($model, 'expenditure_type_name') ?>

    <?= $form->field($model, 'expenditure_type_description') ?>

    <?= $form->field($model, 'date_created') ?>

    <?= $form->field($model, 'who_created') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
