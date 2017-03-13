<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\builder\Form;
?>

<div class="financial-years-form">


    <?php
    $form = \kartik\form\ActiveForm::begin();

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'FinancialYear' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Financial Year', 'maxlength' => 7]],
//            'FYStart' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Financial Year', 'maxlength' => 7]],
            'FYStart' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                'hint' => 'Enter birthday (yyyy-mm-dd)'
            ],
//            'FYEnd' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Financial Year', 'maxlength' => 7]],
            'FYEnd' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                'hint' => 'Enter birthday (yyyy-mm-dd)'
            ],
            'IsCurrent' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
//                'label' => 'IsCurrent',
                'items' => ['' => 'Please select', 1 => 'Yes', 0 => 'No'],
            ]
//            'CoAVersionID' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items'=> yii\helpers\ArrayHelper::map(app\models\CoAVersions::find()->all(), "CoAVersionID", "CoAVersionDescription"),],
//            'AdminAreaVersionID' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items'=> yii\helpers\ArrayHelper::map(app\models\AdminAreaVersions::find()->all(), "AdminAreaVersionID", "AdminAreaVersionDescription"),'options'=>['prompt'=>''] ],
//            'PriorityAreaVersionID' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => yii\helpers\ArrayHelper::map(app\models\PriorityAreaVersions::find()->all(), "PriorityAreaVersionID", "PriorityAreaVersionDescription"), 'options'=>['prompt'=>''] ],
//            'NationalTargetVersionID' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items'=>  \yii\helpers\ArrayHelper::map(app\models\GeneralLevelTaskVersions::find()->all(), "GeneralLevelTaskVersionID", "GeneralLevelTaskVersionDescription"),'options'=>['prompt'=>''] ],
        //'IsCurrent' => ['type' => Form::INPUT_CHECKBOX],
        ]
    ]);

    echo Html::submitButton("Save", ["class" => "btn btn-success"]);
    ?>
</div>
