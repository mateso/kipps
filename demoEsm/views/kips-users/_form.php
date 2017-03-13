<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\KipsUsers $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-users-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [

            'firstname' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter First Name...']],
            'middlename' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Middlename...']],
            'surname' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Surname...']],
            'class' => [
                'label' => 'Class',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), 'options' => ['prompt' => 'Select Education Level'],
            ],
//            'username' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter User Name...']],
            'gender' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Gender',
                'items' => ['' => 'Please select', 1 => 'Male', 2 => 'Female'],
            ],
//            'phone' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Phone Number...']],
            'email' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Email...']],
            'active' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Active',
                'items' => ['' => 'Please select', 1 => 'Yes', 0 => 'No'],
            ],
            'date_of_birth' => [
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => '\kartik\widgets\DatePicker',
                'options' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],
                'hint' => 'Enter birthday (yyyy-mm-dd)'
            ],
            'place_of_birth' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Place Of Birth...']],
            'religion' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Religion...']],
            'denomination' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Denomination...']],
            'tribe' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Tribe...']],
            'student_type' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Student Type',
                'items' => ['' => 'Please select', 1 => 'Day Student', 2 => 'Boarding Student'],
            ],
            'transport_route' => [
                'label' => 'Transport Route',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsTransportRoutes::find()->orderBy('id')->asArray()->all(), 'id', 'area_covered'), 'options' => ['prompt' => 'Transport Route'],
                'columnOptions' => ['id' => 'transport_routes-id']
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
