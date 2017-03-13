<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentSetupSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-payment-setup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'education_level') ?>

    <?= $form->field($model, 'payment_type') ?>

    <?= $form->field($model, 'amount') ?>

     <?= $form->field($model, 'start_date') ?>
    
    <?= $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
