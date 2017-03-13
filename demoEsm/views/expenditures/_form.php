<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Expenditures $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditures-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

//            'financial_year' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Financial Year...']],
            'expenditure_type' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Expenditure Type...']],
            'expenditure_type' => [
                'label' => 'Expenditure Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\ExpenditureTypes::find()->orderBy('expenditure_type_id')->asArray()->all(), 'expenditure_type_id', 'expenditure_type_name'), 'options' => ['prompt' => 'Select Expenditure Type'],
            ],
            'expenditure_description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Expenditure Description...', 'maxlength' => 255]],
            'amount' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Amount...']],
            'expenditure_date' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(), 'options' => ['type' => DateControl::FORMAT_DATE]],
//            'who_created' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Who Created...']],
//            'date_created' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(), 'options' => ['type' => DateControl::FORMAT_DATETIME]],
//            'status' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Status...', 'maxlength' => 45]],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
