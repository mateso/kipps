<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentSetup $model
 */

$this->title = 'Create Payment Setup';
$this->params['breadcrumbs'][] = ['label' => 'Payment Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-payment-setup-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
