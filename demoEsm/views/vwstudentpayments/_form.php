<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Vwstudentpayments $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="vwstudentpayments-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter ID...']], 

'student_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Student ID...']], 

'transport_route'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Transport Route...']], 

'payments_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Payments ID...']], 

'payment_setup_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Payment Setup ID...']], 

'amount_paid'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Amount Paid...']], 

'date_paid'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]], 

'amount'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Amount...']], 

'receipt_date'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]], 

'description'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Description...', 'maxlength'=>255]], 

'payment_method'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Payment Method...', 'maxlength'=>255]], 

'receipt_number'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Receipt Number...', 'maxlength'=>45]], 

'student_type'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Student Type...', 'maxlength'=>45]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
