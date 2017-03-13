<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsPaymentsSearch $searchModel
 */
$this->title = 'Admission Payments';
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
//            'student_id',
            [
                'label' => 'Student',
                'value' => function ($model) {
                    return app\models\KipsUsers::getStudentName($model->student_id);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'student_id', ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user` WHERE `user_type` = 2 AND `status` = 1 ORDER BY `firstname`")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
//            'payment_setup_id',
            [
                'label' => 'Payments For',
                'attribute' => 'payment_setup_id',
                'value' => function ($model) {
                     return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
                },

            ],
            //  [
           //     'label' => 'Receipt Number',
           //     'value' => function ($model) {
           //         return $model->payments->receipt_number;
          //      },
       //     ],

  [
                'label' => 'Class',
                'value' => 'payments.student.studentClass.education_level',
         'filter' => Html::activeDropDownList(
                        $searchModel, 'student_class', ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
              [
                'label' => 'Receipt Date',
                'value' => function ($model) {
                    return date("Y-m-d", strtotime($model->payments->transaction_date));
                },
            ],
              [
                'label' => 'Date Paid',
                'value' => function ($model) {
                    return $model->payments->date_paid;
                },
            ],
//            'payment_method',
//            'description',
         [
                'label' => 'Amount Paid',
                'attribute' => 'amount',
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
            [
                'label' => 'Balance',
                'value' => function ($model) {
                    return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id,$model->student_id,$model->payments_id);
                },
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
             
  
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => true,
                'panel' => [
                    'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
                    'type' => 'info',
                    'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>