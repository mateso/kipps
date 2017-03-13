<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FinancialYearsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Academic Years';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-years-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'YearID',
            'FinancialYear',
            'FYStart',
            'FYEnd',
            [
                'label' => 'Current',
                'value' => function($model) {
                    return $model->IsCurrent ? '<span class="glyphicon glyphicon-ok"></span>' : '<span class="glyphicon glyphicon-remove"></span>';
                },
                'format' => 'raw',
            ],
            // 'CoAVersionID',
            // 'AdminAreaVersionID',
            // 'PriorityAreaVersionID',
            // 'NationalTargetVersionID',
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
                    'type' => 'info',
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
    ]); ?>

</div>
