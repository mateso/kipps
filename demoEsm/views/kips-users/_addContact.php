<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsContacts $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-contacts-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [


            'contact_first_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact First Name...', 'maxlength' => 255]],
            'contact_surname' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Surname...', 'maxlength' => 255]],
            'contact_middle_name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Middle Name...', 'maxlength' => 255]],
            'contact_type' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Type...']],
             'contact_type' => [
                'label' => 'Contact Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select Contact Type','Mother' => 'Mother','Father' => 'Father','Gurdian' => 'Gurdian'],
            ],
            'contact_occupation' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Occupation...', 'maxlength' => 255]],
            'contact_religion' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Religion...', 'maxlength' => 255]],
            'contact_postal_address' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Postal Address...', 'maxlength' => 255]],
            'contact_residential' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Residential...', 'maxlength' => 255]],
            'contact_telephone' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Telephone...', 'maxlength' => 255]],
            'contact_mobile_phone' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Mobile Phone...', 'maxlength' => 255]],
            'contact_office_phone' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Contact Office Phone...', 'maxlength' => 255]],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
