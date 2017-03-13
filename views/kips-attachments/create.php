<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsAttachments $model
 */

$this->title = 'Create Kips Attachments';
$this->params['breadcrumbs'][] = ['label' => 'Kips Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-attachments-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
