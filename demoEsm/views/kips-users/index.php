<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsUsersSearch $searchModel
 */
$this->title = 'Students Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-users-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?php /* echo Html::a('Create Kips Users', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

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
                        $searchModel, 'userid', ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user` ORDER BY `firstname`")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
//            'firstname',
//            'surname',
//            'middlename',
//            'class',
           [
                'label' => 'Class',
                'attribute' => 'studentClass.education_level',
                'filter' => Html::activeDropDownList(
                        $searchModel, 'class', ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            'username',
//            'gender',
            [
                'attribute' => 'gender',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->gender == 1) {
                        $gender = 'Male';
                    } elseif ($model->gender == 2) {
                        $gender = 'Female';
                    }

                    return $gender;
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'gender', [1 => 'Male', 2 => 'Female'], ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            'phone', 
//            'email:email',
//            'password', 
//            'active', 
//            'last_login', 
//            'last_login_fail', 
//            'num_login_fail', 
//            'date_of_birth', 
//            'place_of_birth', 
//            'religion', 
//            'denomination', 
//            'tribe', 
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-users/view', 'id' => $model->userid, 'edit' => 't']), [
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
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Register Student', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>