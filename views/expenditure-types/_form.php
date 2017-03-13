<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditureTypes $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditure-types-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'expenditure_type_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Expenditure Type Name...', 'maxlength' => 255]],
//            'date_created' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(), 'options' => ['type' => DateControl::FORMAT_DATETIME]],
//            'who_created' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Who Created...']],
//            'status' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Status...']],
            'expenditure_type_description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Expenditure Type Description...', 'maxlength' => 255]],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
