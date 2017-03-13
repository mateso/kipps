<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KipsEducationLevel $model
 */

$this->title = 'Create Education Level';
$this->params['breadcrumbs'][] = ['label' => 'Education Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-education-level-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
