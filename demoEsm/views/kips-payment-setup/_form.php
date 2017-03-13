<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentSetup $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-payment-setup-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
//            'education_level_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Education Level ID...']],
            'payment_type' => [
                'label' => 'Payment Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsPaymentTypes::find()->orderBy('id')->asArray()->all(), 'id', 'payment_type'), 'options' => ['prompt' => 'Select Payment Type'],
            ],
            'transport_routes' => [
                'label' => 'Transport Route',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsTransportRoutes::find()->orderBy('id')->asArray()->all(), 'id', 'area_covered'), 'options' => ['prompt' => 'Select Transport Route'],
                 'columnOptions' => ['id' => 'transport_routes-id']
            ],
            'education_level' => [
                'label' => 'Education Level',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), 'options' => ['prompt' => 'Select Education Level'],
                'columnOptions' => ['id' => 'education_level-id']
            ],
        ]
    ]);
    ?>
    <?php
    echo \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'fee_category' => [
                'label' => 'Fee Category',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => $model->getFeeCategory(),
            ],
            'required' => [
                'type' => Form::INPUT_CHECKBOX,
                'label' => 'Required?',
                'items' => [ 1 => 'Yes', 0 => 'No'],
                'columnOptions' => ['style' => 'padding:20px;'],
            ],
            'installment' => [
                'label' => 'Installment',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => $model->getInstallments(),
            ],
            'status' => [
                'type' => Form::INPUT_CHECKBOX,
                'label' => 'Active?',
                'items' => [ 1 => 'Yes', 0 => 'No'],
                'columnOptions' => ['style' => 'padding:20px;'],
            ],
        ]
    ]);
    ?>
    <?php
    echo \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
            'amount' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Amount...']],
            'start_date' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                'hint' => 'Enter birthday (yyyy-mm-dd)'
            ],
            'due_date' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                'hint' => 'Enter birthday (yyyy-mm-dd)'
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
