<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\KipsPaymentSetup;
use app\models\KipsUsers;
use app\models\KipsEducationLevel;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsUsersSearch $searchModel
 */
$this->title = 'Tution Fees Depts Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-users-index">


    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //            'userid',
            [
                'label' => 'Fullname',
                'attribute' => 'userid',
                'value' => function ($model) {
                    return app\models\KipsUsers::getStudentName($model->userid);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'userid', ArrayHelper::map(KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user` WHERE `user_type` = 2 AND `status` = 1 ORDER BY `firstname`")->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            [
                'label' => 'Class',
                'attribute' => 'studentClass.education_level',
                'filter' => Html::activeDropDownList(
                        $searchModel, 'class', ArrayHelper::map(KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            [
                'label' => 'Amount to be Paid',
                'value' => function ($model) {
                    return KipsPaymentSetup::getStudentAmountToBePaid($model->userid, Yii::$app->session->get('mfy')->YearID, 1);
                },
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
            [
                'label' => 'Total Amount Paid',
                'value' => function ($model) {
                    return KipsPaymentSetup::getStudentDeptAmountPaid($model->userid, (KipsPaymentSetup::getPaymentSetupID($model->userid, Yii::$app->session->get('mfy')->YearID, 1)));
                },
                'format' => 'raw',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
            ],
            [
                'label' => 'Balance',
                'value' => function ($model) {
                    return KipsPaymentSetup::getDebtBalance($model->userid, Yii::$app->session->get('mfy')->YearID, 1, (KipsPaymentSetup::getPaymentSetupID($model->userid, Yii::$app->session->get('mfy')->YearID, 1)));
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