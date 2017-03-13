<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\StudentsTransfer $model
 */

$this->title = 'Update Students Transfer: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="students-transfer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
