<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditurePayments $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expenditure-payments-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'expenditure_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Expenditure ID...']], 

'amount'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Amount...']], 

'who_created'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Who Created...']], 

'date_paid'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]], 

'date_created'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
