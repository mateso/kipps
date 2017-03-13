<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Expenditures $model
 */

$this->title = 'Update Expenditures: ' . ' ' . $model->expenditure_id;
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expenditure_id, 'url' => ['view', 'id' => $model->expenditure_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenditures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
