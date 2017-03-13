<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\KipsContactsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-contacts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contact_type') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'contact_first_name') ?>

    <?= $form->field($model, 'contact_middle_name') ?>

    <?php // echo $form->field($model, 'contact_surname') ?>

    <?php // echo $form->field($model, 'contact_occupation') ?>

    <?php // echo $form->field($model, 'contact_religion') ?>

    <?php // echo $form->field($model, 'contact_postal_address') ?>

    <?php // echo $form->field($model, 'contact_residential') ?>

    <?php // echo $form->field($model, 'contact_telephone') ?>

    <?php // echo $form->field($model, 'contact_mobile_phone') ?>

    <?php // echo $form->field($model, 'contact_office_phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
