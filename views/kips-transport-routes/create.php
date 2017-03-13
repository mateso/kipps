<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsTransportRoutes $model
 */

$this->title = 'Create Transport Route';
$this->params['breadcrumbs'][] = ['label' => 'Transport Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-transport-routes-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
