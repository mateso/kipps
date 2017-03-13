<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FinancialYears */

$this->title = 'Create Financial Year';
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-years-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
