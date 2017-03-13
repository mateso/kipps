<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusList */

$this->title = 'Update Status List: ' . ' ' . $model->status_list_id;
$this->params['breadcrumbs'][] = ['label' => 'Status Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->status_list_id, 'url' => ['view', 'id' => $model->status_list_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
