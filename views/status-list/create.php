<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatusList */

$this->title = 'Create Status List';
$this->params['breadcrumbs'][] = ['label' => 'Status Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
