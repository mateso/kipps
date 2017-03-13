<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYears */

$this->title = 'Update Financial Year: ' . ' ' . $model->FinancialYear;
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FinancialYear, 'url' => ['view', 'id' => $model->YearID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="financial-years-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
