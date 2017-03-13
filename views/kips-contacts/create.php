<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsContacts $model
 */

$this->title = 'Create Kips Contacts';
$this->params['breadcrumbs'][] = ['label' => 'Kips Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-contacts-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
