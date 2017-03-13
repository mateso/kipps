<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Status List', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'status_list_id',
            'desc_en',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
