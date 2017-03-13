<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentSetup $model
 */

$this->title = 'Update Payment Setup: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Payment Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-payment-setup-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
