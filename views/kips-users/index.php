<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Gender;
use app\models\StatusList;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\KipsUsersSearch $searchModel
 */
$this->title = 'Students';
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
        [
        'label' => 'Fullname',
        'attribute' => 'userid',
        'value' => function ($model) {
            return app\models\KipsUsers::getStudentName($model->userid);
        },
        'filter' => Html::activeDropDownList(
            $searchModel, 'userid', ArrayHelper::map(\app\models\KipsUsers::findBySql("SELECT `userid`,CONCAT(`firstname`,' ',`middlename`,' ',`surname`) AS fullname FROM `user` WHERE `user_type` = 2 ORDER BY `firstname`")->orderBy('userid')->asArray()->all(), 'userid', 'fullname'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
            )
        ],
        [
        'label' => 'Class',
        'attribute' => 'studentClass.education_level',
        'filter' => Html::activeDropDownList(
            $searchModel, 'class', ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
            )
        ],
        'username',
        [
        'attribute' => 'gender',
        'format' => 'html',
        'value' => function ($model) {
            return Gender::getGenderDesc($model->gender);
        },
        'filter' => Html::activeDropDownList(
            $searchModel, 'gender', ArrayHelper::map(Gender::find()->orderBy('gender_id')->asArray()->all(), 'gender_id', 'desc_en'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
            )
        ],
        [
        'attribute' => 'status',
        'label' => 'Status',
        'format' => 'html',
        'value' => function ($model) {
            return StatusList::getStatusDesc($model->status);
        },
        'filter' => Html::activeDropDownList(
            $searchModel, 'status', ArrayHelper::map(StatusList::find()->orderBy('status_list_id')->asArray()->all(), 'status_list_id', 'desc_en'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
            )
        ],
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