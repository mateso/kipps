<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-payments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'financial_year') ?>

    <?= $form->field($model, 'amount_paid') ?>
    
     <?= $form->field($model, 'receipt_number') ?>
    
     <?= $form->field($model, 'receipt_date') ?>
    
    <?= $form->field($model, 'date_paid') ?>$dirh = opendir($dirname);
    if ($dirh) {
    while (($dirElement = readdir($dirh)) !== false) {

    }
    closedir($dirh);
    }
     <?= $form->field($model, 'date_paid') ?>

    <?= $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
