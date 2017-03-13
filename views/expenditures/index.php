<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\ExpendituresSearch $searchModel
 */
$this->title = 'Clean Expenditures';
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
//            ['attribute'=>'expenditure_date','format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 
//            'status', 
//            ['attribute'=>'date_created','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'who_created', 
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['expenditures/view', 'id' => $model->expenditure_id, 'edit' => 't']), [
//                                    'title' => Yii::t('yii', 'Edit'),
//                        ]);
//                    }
//                        ],
//                    ],
            
            [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {delete}',
                        'buttons' => [
                                    'view' => function ($url, $model) {

                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                            'title' => Yii::t('yii', 'View'),
                                ]);
                            },
                                    'delete' => function ($url, $model) {

                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('yii', 'Cancel'),
                                ]);
                            },
                                ],
                                'urlCreator' => function ($action, $model) {
                            if ($action === 'view') {
                                $url = Url::to(['view', 'id' => $model->expenditure_id]);
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = Url::to(['cancel-expenditure', 'id' => $model->expenditure_id]);
                                return $url;
                            }
                        }
                            ],
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
                    'type' => 'info',
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Expenditure', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>
