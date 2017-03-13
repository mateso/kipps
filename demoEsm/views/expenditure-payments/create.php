<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditurePayments $model
 */

$this->title = 'Create Expenditure Payments';
$this->params['breadcrumbs'][] = ['label' => 'Expenditure Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-payments-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
