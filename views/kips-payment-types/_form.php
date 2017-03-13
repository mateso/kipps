<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentTypes $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-payment-types-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'payment_type' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Payment Type...']],
            'description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Description...']],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
