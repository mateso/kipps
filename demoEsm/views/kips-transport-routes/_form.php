<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsTransportRoutes $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-transport-routes-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

//            'id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter ID...']],
            'route_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Route Number...']],
            'area_covered' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Area Covered...', 'maxlength' => 255]],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
