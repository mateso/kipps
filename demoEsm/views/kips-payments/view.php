<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPayments $model
 */
$this->title = 'Payments For Student:-';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

//  $htmlOptions = array(
//        'class' => 'btn btn-info', 'onclick' => "window.print();return false;"
//    );
//    echo Html::button('PRINT RECEIPT', $htmlOptions);
    
 ?>

<div id="receipt-page">
<div class="kips-payments-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
            'heading' => $this->title,
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
//            'id',
//            'student_id',
            [
                'label' => 'Student Name',
                'attribute' => 'student_id',
                'value' => app\models\KipsUsers::getStudentName($model->student_id),
            ],
//            'payment_setup_id',
//            'amount_paid',
			[
                'label' => 'Amount Paid',
                'attribute' => 'amount_paid',
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
//            'receipt_number',
			[
                'label' => 'Date Submitted',
                'attribute' => 'receipt_date',
              ],
 //           'receipt_date',
            'date_paid',
            'payment_method',
			[
                'label' => 'Pay-in slip Number ',
                'attribute' => 'receipt_number',
              ],
            'description',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->id],
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => false,
    ])
    ?>


</div>

<?php
$this->title = 'Payment Status';
?>
<div id="payment-status" class="payments-amount-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $paymentTypeSearchModelDataProvider,
//       'filterModel' => $paymentTypeSearchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
//            'id',
//            'student_id',
//            [
//                'label' => 'Student',
//                'attribute' => 'student_id',
//                'value' => function ($model) {
//                    return app\models\KipsUsers::getStudentName($model->student_id);
//                },
//            ],
//            'payment_setup_id',
            [
                'label' => 'ITEM',
                'attribute' => 'payment_setup_id',
                'value' => function ($model) {
                    return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
                },
//                'filter' => Html::activeDropDownList(
//                        $paymentSearchModel, 'student_id', ArrayHelper::map(\app\models\KipsPaymentTypes::findBySql("SELECT payment_setup.`id` as id,`financial_year_id`,CONCAT(education_level.`education_level`,' - ',payment_types.`payment_type`,' - ',payment_setup.`fee_category`,' - ',payment_setup.`amount`) AS paymentSetup  FROM `payment_setup` INNER JOIN education_level ON education_level.`id`=payment_setup.`education_level` INNER JOIN payment_types ON payment_types.`id`=payment_setup.payment_type WHERE `financial_year_id`=4")->orderBy('id')->asArray()->all(), 'id', 'paymentSetup'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]
//                )
                'pageSummary' => 'Total',
            ],
             [
                'label' => 'SEMISTER 1',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
                'value' => function($model) {
                    return \app\models\KipsPaymentSetup::getStudentAmountPaid($model->payment_setup_id, $model->student_id);
                },
                'hAlign' => 'right',
                'width' => '15%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'label' => 'SEMISTER 2',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
                 'value' => function($model) {
                    return '-';
                },
//                'hAlign' => 'right',
//                'width' => '15%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
            ],
           [
                'label' => 'SEMISTER 3',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
                 'value' => function($model) {
                    return '-';
                },
//                'hAlign' => 'right',
//                'width' => '15%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
            ],
            [
                'label' => 'Balance',
                'value' => function ($model) {
                    return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->student_id,$model->id);
                },

                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '15%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
//            'description',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'header' => 'Actions',
//                'template' => '{update} {view} {delete}',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-payments/view', 'id' => $model->id, 'edit' => 't']), [
//                                    'title' => Yii::t('yii', 'Edit'),
//                        ]);
//                    },
//                            'view' => function ($url, $model) {
//
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                                    'title' => Yii::t('yii', 'View'),
//                        ]);
//                    },
//                            'delete' => function ($url, $model) {
//
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                                    'title' => Yii::t('yii', 'Delete'),
//                        ]);
//                    },
//                        ],
//                        'urlCreator' => function ($action, $model) {
//                    if ($action === 'view') {
//                        $url = Url::to(['kips-payments/view', 'id' => $model->id, 'student_id' => $model->student_id]);
//                        return $url;
//                    }
//                    if ($action === 'delete') {
//                        $url = Url::to(['kips-payments/delete', 'id' => $model->id, 'student_id' => $model->student_id]);
//                        return $url;
//                    }
//                }
//                    ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'after' => Html::a('Preview Receipt', ['preview','id' => $payment_id], ['class' => 'btn btn-info',]),
            'showFooter' => false
        ],
    ]);
    ?>

</div>

<?php
$this->title = 'Amount Paid Distribution';
?>
<div  id="trimmed-table" class="payments-amount-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
//            'id',
//            'payments_id',
//            'payment_setup_id',
            [
                'label' => 'Payment Type',
                'attribute' => 'payment_setup_id',
                'attribute' => 'paymentSetup.paymentType.payment_type',
                'pageSummary' => 'Total',
            ],
//            'amount',
            [
                'label' => 'Amount Paid',
                'attribute' => 'amount',
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 0],
                'pageSummary' => true
            ],
//            ['class' => 'kartik\grid\ActionColumn'],         
        ],
        'responsive' => true,
        'export' => false,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'showFooter' => false
        ],
    ]);
    ?>

</div>