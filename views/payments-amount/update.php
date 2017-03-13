<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsAmount */

$this->title = 'Update Payments Amount: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payments Amounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'payments_id' => $model->payments_id, 'payment_setup_id' => $model->payment_setup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payments-amount-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
