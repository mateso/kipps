<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsEducationLevel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-education-level-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'education_level' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Education Level...']],
            'description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Description...']],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
