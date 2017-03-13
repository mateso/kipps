<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsUsers $model
 */

$this->title = 'Update Kips Users: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
