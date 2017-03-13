<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Vwstudentpayments $model
 */

$this->title = 'Update Vwstudentpayments: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vwstudentpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vwstudentpayments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
