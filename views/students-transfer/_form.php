<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\StudentsTransfer $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="students-transfer-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter ID...']], 

'userid'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Userid...']], 

'YearID'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Year ID...']], 

'transfer_type'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Transfer Type...']], 

'semester'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Semester...']], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
