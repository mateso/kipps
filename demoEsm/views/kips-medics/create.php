<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsMedics $model
 */

$this->title = 'Create Kips Medics';
$this->params['breadcrumbs'][] = ['label' => 'Kips Medics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-medics-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
