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
$this->title = 'Uniform Payments';
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
                'attribute' => 'student_id',
                'value' => function ($model) {
                    return app\models\KipsUsers::getStudentName($model->student_id);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'student_id', ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user`")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
//            'payment_setup_id',
            [
                'label' => 'Payments For',
                'attribute' => 'payment_setup_id',
                'value' => function ($model) {
                    return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
                },
//                'filter' => Html::activeDropDownList(
//                        $searchModel, 'student_id', ArrayHelper::map(\app\models\KipsPaymentTypes::findBySql("SELECT payment_setup.`id` as id,`financial_year_id`,CONCAT(education_level.`education_level`,' - ',payment_types.`payment_type`,' - ',payment_setup.`fee_category`,' - ',payment_setup.`amount`) AS paymentSetup  FROM `payment_setup` INNER JOIN education_level ON education_level.`id`=payment_setup.`education_level` INNER JOIN payment_types ON payment_types.`id`=payment_setup.payment_type WHERE `financial_year_id`=4")->orderBy('id')->asArray()->all(), 'id', 'paymentSetup'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
//                )
            ],
            'receipt_number',
            'receipt_date',
            'date_paid',
//            'payment_method',
//            'description',
                        [
                'label' => 'Amount Paid',
                'attribute' => 'amount_paid',
//              'value' => function ($model) {
//                    return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
//                },
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
            [
                'label' => 'Amount Paid',
                'attribute' => 'amount_paid',
                //             'value' => function ($model) {
//                    return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
//                },
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
             [
                'label' => 'Class',
                'value' => 'student.studentClass.education_level',
                'filter' => Html::activeDropDownList(
                        $searchModel, 'student_id', ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-payments/view', 'id' => $model->id, 'edit' => 't']), [
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
                    'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>