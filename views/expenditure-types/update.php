<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditureTypes $model
 */

$this->title = 'Update Expenditure Types: ' . ' ' . $model->expenditure_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Expenditure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expenditure_type_id, 'url' => ['view', 'id' => $model->expenditure_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenditure-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
