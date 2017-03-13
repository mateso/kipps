<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsEducationLevel $model
 */

$this->title = 'Update Education Level: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Education Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-education-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
