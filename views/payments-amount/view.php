<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsAmount */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payments Amounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-amount-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'payments_id' => $model->payments_id, 'payment_setup_id' => $model->payment_setup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'payments_id' => $model->payments_id, 'payment_setup_id' => $model->payment_setup_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'payments_id',
            'payment_setup_id',
            'amount',
        ],
    ]) ?>

</div>
