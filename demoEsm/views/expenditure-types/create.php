<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditureTypes $model
 */

$this->title = 'Create Expenditure Type';
$this->params['breadcrumbs'][] = ['label' => 'Expenditure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-types-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
