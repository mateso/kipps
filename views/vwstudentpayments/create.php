<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Vwstudentpayments $model
 */

$this->title = 'Create Vwstudentpayments';
$this->params['breadcrumbs'][] = ['label' => 'Vwstudentpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vwstudentpayments-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
