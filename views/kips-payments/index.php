<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsPaymentsSearch $searchModel
 */
$this->title = 'Student Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-payments-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>
        <?php /* echo Html::a('Create Kips Payments', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //   'id',
            [
                'label' => 'Student',
                'attribute' => 'student_id',
                'value' => function ($model) {
                    return app\models\KipsUsers::getStudentName($model->student_id);
                },
               'filter' => Html::activeDropDownList(
                        $searchModel, 'student_id', ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user`  WHERE `user_type` = 2 AND `status` = 1 ORDER BY `firstname`")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'ALL')]
                )
            ],


//            'receipt_number',
    //        'receipt_date',
               [
                'attribute' => 'receipt_date',
                'value' => function ($model) {
                    return $model->receipt_date;
                },
               'filter' => Html::activeDropDownList(
                        $searchModel, 'receipt_date', ['-01-' => 'January', '-02-' => 'February', '-03-' => 'March','-04-' => 'April','-05-' => 'May','-06-' => 'June','-07-' => 'July','-08-' => 'August','-09-' => 'September','-10-' => 'October','-11-' => 'November','-12-' => 'December'], ['class' => 'form-control', 'prompt' => Yii::t('app', 'ALL')]
                )
            ],
            [
                'label' => 'Amount Paid',
                'attribute' => 'amount_paid',
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
             //   'pageSummary' => true
            ],
       //     'date_paid',
             [
                'attribute' => 'date_paid',
                'value' => function ($model) {
                    return $model->date_paid;
                },
               'filter' => Html::activeDropDownList(
                        $searchModel, 'date_paid', ['-01-' => 'January', '-02-' => 'February', '-03-' => 'March','-04-' => 'April','-05-' => 'May','-06-' => 'June','-07-' => 'July','-08-' => 'August','-09-' => 'September','-10-' => 'October','-11-' => 'November','-12-' => 'December'], ['class' => 'form-control', 'prompt' => Yii::t('app', 'ALL')]
                )
            ],
              [
                'label' => 'Payment Method',
                'attribute' => 'payment_method',
                'value' => function ($model) {
                    return $model->payment_method;
                },
               'filter' => Html::activeDropDownList(
                        $searchModel, 'payment_method', ['CRDB Bank' => 'CRDB Bank', 'NMB Bank' => 'NMB Bank', 'Accountant' => 'Accountant'], ['class' => 'form-control', 'prompt' => Yii::t('app', 'ALL')]
                )
            ],
            //'student_id',
             [
                'label' => 'Class',
                'attribute' => 'student_class',
                'value' => function ($model) {
                    return $model->studentClass->education_level;
                },
               'filter' => Html::activeDropDownList(
                        $searchModel, 'student_class', ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->ALL(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'ALL')]
                )
            ],
            'description',
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
                                $url = Url::to(['view', 'id' => $model->id]);
                                return $url;
                            }
                            if ($action === 'delete') {
                                $url = Url::to(['cancel-payment', 'id' => $model->id]);
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
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Payment', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>