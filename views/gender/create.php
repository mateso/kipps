<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Gender $model
 */

$this->title = 'Create Gender';
$this->params['breadcrumbs'][] = ['label' => 'Genders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gender-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
