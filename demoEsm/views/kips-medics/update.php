<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsMedics $model
 */

$this->title = 'Update Kips Medics: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Medics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-medics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
