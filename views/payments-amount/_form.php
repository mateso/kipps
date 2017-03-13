<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsAmount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-amount-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payments_id')->textInput() ?>

    <?= $form->field($model, 'payment_setup_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
