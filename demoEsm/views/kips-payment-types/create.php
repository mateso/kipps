<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentTypes $model
 */

$this->title = 'Create Payment Types' ;
$this->params['breadcrumbs'][] = ['label' => 'Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-payment-types-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
