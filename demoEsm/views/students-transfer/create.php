<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\StudentsTransfer $model
 */

$this->title = 'Create Students Transfer';
$this->params['breadcrumbs'][] = ['label' => 'Students Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-transfer-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
