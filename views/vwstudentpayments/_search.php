<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\VwstudentpaymentsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="vwstudentpayments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'amount_paid') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'date_paid') ?>

    <?= $form->field($model, 'receipt_date') ?>

    <?php // echo $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'receipt_number') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'student_type') ?>

    <?php // echo $form->field($model, 'transport_route') ?>

    <?php // echo $form->field($model, 'payments_id') ?>

    <?php // echo $form->field($model, 'payment_setup_id') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
