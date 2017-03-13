<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsUsers $model
 */

$this->title = 'Register New Student';
$this->params['breadcrumbs'][] = ['label' => 'Student Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-users-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
