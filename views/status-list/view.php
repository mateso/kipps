<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StatusList */

$this->title = $model->status_list_id;
$this->params['breadcrumbs'][] = ['label' => 'Status Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->status_list_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->status_list_id], [
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
            'status_list_id',
            'desc_en',
        ],
    ]) ?>

</div>
