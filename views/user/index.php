<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UserSearch $searchModel
 */
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <!--    <div class="page-header">
                <h1><?= Html::encode($this->title) ?></h1>
        </div>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?php /* echo Html::a('Create User11', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'userid',
            'firstname',
//            'middlename',
            'surname',
            'username',
            'email:email',
            'phone',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        $class = 'label-success';
                        return '<span class="label ' . $class . '">' . 'STATUS_ACTIVE' . '</span>';
                    } else {
                        $class = 'label-danger';
                        return '<span class="label ' . $class . '">' . 'STATUS_INACTIVE' . '</span>';
                    }
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'status', [1 => 'STATUS_ACTIVE', 0 => 'STATUS_INACTIVE'], ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
//            'login_counts', 
//            ['attribute'=>'last_login_date','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'failed_login_attempts', 
//            ['attribute'=>'last_password_update_date','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']], 
//            'auth_key', 
//            'password_reset_token', 
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['user/view', 'id' => $model->userid, 'edit' => 't']), [
                                    'title' => Yii::t('yii', 'Edit'),
                        ]);
                    },
                            'assign' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-log-in"></span>', Yii::$app->urlManager->createUrl(['admin/assignment/view', 'id' => $model->userid]), [
                                    'title' => Yii::t('yii', 'Assign Roles'),
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
                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Register User', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

</div>
