<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditurePayments $model
 */

$this->title = 'Update Expenditure Payments: ' . ' ' . $model->expenditure_payment_id;
$this->params['breadcrumbs'][] = ['label' => 'Expenditure Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expenditure_payment_id, 'url' => ['view', 'id' => $model->expenditure_payment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenditure-payments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
