<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYearsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="financial-years-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'YearID') ?>

    <?= $form->field($model, 'FinancialYear') ?>

    <?= $form->field($model, 'FYStart') ?>

    <?= $form->field($model, 'FYEnd') ?>

    <?= $form->field($model, 'IsCurrent') ?>

    <?php // echo $form->field($model, 'CoAVersionID') ?>

    <?php // echo $form->field($model, 'AdminAreaVersionID') ?>

    <?php // echo $form->field($model, 'PriorityAreaVersionID') ?>

    <?php // echo $form->field($model, 'NationalTargetVersionID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
