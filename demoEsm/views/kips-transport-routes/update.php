<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsTransportRoutes $model
 */

$this->title = 'Update Transport Routes: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transport Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-transport-routes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
