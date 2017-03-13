<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPayments $model
 */

$this->title = 'Update Kips Payments: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-payments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
