<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsPaymentSetupSearch $searchModel
 */
$this->title = 'Payment Setups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-payment-setup-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php /* echo Html::a('Create Kips Payment Setup', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //  'id',
            [
                'label' => 'Education Level',
                'attribute' => 'educationLevel.education_level',
            ],
            [
                'label' => 'Payment Level',
                'attribute' => 'paymentType.payment_type',
            ],
            'amount',
            'fee_category',
            [
                'attribute' => 'installment',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->installment == 1) {
                        $installment = 'First Installment';
                    } elseif ($model->installment == 2) {
                        $installment = 'Second Installment';
                    } elseif ($model->installment == 3) {
                        $installment = 'Third Installment';
                    }

                    return $installment;
                },
//                'filter' => Html::activeDropDownList(
//                        $searchModel, 'status', $arrayStatus, ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
//                )
            ],
            ['attribute' => 'start_date', 'format' => ['date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']],
            ['attribute' => 'due_date', 'format' => ['date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']],
            'status',
            'required',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-payment-setup/view', 'id' => $model->id, 'edit' => 't']), [
                                    'title' => Yii::t('yii', 'Edit'),
                        ]);
                    }
                        ],
                    ],
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
                    'type' => 'info',
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Payment Setup', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>
