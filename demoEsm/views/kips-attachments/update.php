<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsAttachments $model
 */

$this->title = 'Update Attachments: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-attachments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
