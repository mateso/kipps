<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditurePaymentsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditure-payments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'expenditure_payment_id') ?>

    <?= $form->field($model, 'expenditure_id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'date_paid') ?>

    <?= $form->field($model, 'who_created') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
