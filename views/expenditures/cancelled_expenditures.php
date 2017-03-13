<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExpendituresSearch $searchModel
 */
$this->title = 'Cancelled Expenditures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditures-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php /* echo Html::a('Create Expenditures', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'expenditure_id',
//            'financial_year',
//            'expenditure_type',
            [
                'label' => 'Expenditure Type',
                'attribute' => 'expenditure_type',
                'attribute' => 'expenditureType.expenditure_type_name',
            ],
            'expenditure_description',
            'amount',
//            'status', 
//            ['attribute'=>'date_created','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'who_created', 
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['cancelled-expenditures'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>

</div>
