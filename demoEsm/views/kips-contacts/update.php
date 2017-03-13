<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsContacts $model
 */

$this->title = 'Update Kips Contacts: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kips Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kips-contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
