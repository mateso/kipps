<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPaymentTypes $model
 */

$this->title = 'Update Kips Payment Types: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-payment-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
