<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPayments $model
 * @var yii\widgets\ActiveForm $form
 */
?>


<div class="kips-payments-form">
     <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
            'student_id' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => \kartik\select2\Select2::className(), 'options' => [
                    'data' => \yii\helpers\ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user` WHERE user_type = 2 and status= 1")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), 'options' => ['prompt' => 'Select Student'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]],
            'student_type' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Student Type',
                'items' => ['' => 'Please select', 2 => 'Day Student', 1 => 'Boarding Student'],
            ],
            'transport_route' => [
                'label' => 'Transport Route',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsTransportRoutes::find()->orderBy('id')->asArray()->all(), 'id', 'area_covered'), 'options' => ['prompt' => 'No Transport Route Selected'],
                'columnOptions' => ['id' => 'transport_route-id']
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
            'amount_paid' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Pay-in slip Amount...']],
            'receipt_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Pay-in slip Number...']],
            'receipt_date' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d'
                    ],
                ],
                'hint' => 'Enter Receipt Date (yyyy-mm-dd)'
            ],
            'date_paid' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d'
                    ],
                ],
                'hint' => 'Enter Date Paid (yyyy-mm-dd)'
            ],
            'payment_method' => [
                'label' => 'Payment Method',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select Payment Method', 'CRDB Bank' => 'CRDB Bank', 'NMB Bank' => 'NMB Bank', 'Accountant' => 'Accountant'],
            ],
            'admission_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Admission Fee Amount...']],
            'tution_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Tution Fee Amount...']],           
            'uniform_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Uniform Fee Amount...']],
            'examination_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Examination Fee Amount...']],
            'remedial_class_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Remedial Class Fee Amount...']],           
            'graduation_contribution_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Graduation Fee Amount...']],
            'tour_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Tour Fee Amount...']],
//          'application_fee' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Application Fee Amount...']],
            'transport_fee' => 
                 ['type' => Form::INPUT_TEXT, 
                     'options' => ['placeholder' => 'Enter Transport Fee Amount...'],
                     'columnOptions' => ['id' => 'transport_fee-id']
                 ],
			'description' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Enter Description...']],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-left: 400px']);
    ActiveForm::end();
    ?>      

</div>