<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPayments $model
 */

$this->title = 'Create Payments';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-payments-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
