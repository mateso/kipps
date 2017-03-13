<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */
$this->title = 'Manage user:- '.$model->firstname . ' ' . $model->middlename . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
//            'userid',
            'firstname',
            'middlename',
            'surname',
            'username',       
            'email:email',
            'phone',
            [
                'label' => 'Status',
                'value' => $model->status == 1 ? "ACTIVE" : "INACTIVE"
            ],
            'login_counts',
//            [
//                'attribute' => 'last_login_date',
//                'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
//                'type' => DetailView::INPUT_WIDGET,
//                'widgetOptions' => [
//                    'class' => DateControl::classname(),
//                    'type' => DateControl::FORMAT_DATETIME
//                ]
//            ],
            'failed_login_attempts',
//            [
//                'attribute' => 'last_password_update_date',
//                'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
//                'type' => DetailView::INPUT_WIDGET,
//                'widgetOptions' => [
//                    'class' => DateControl::classname(),
//                    'type' => DateControl::FORMAT_DATETIME
//                ]
//            ],
//            'auth_key',
//            'password_reset_token',
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->userid],
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => true,
    ])
    ?>
    <?= Html::a('<i class="glyphicon glyphicon-log-in"></i>Roles', ['admin/assignment/view', 'id' => $model->userid], ['class' => 'btn btn-primary', 'style' => 'float:right;margin-right:5px;']); ?>
</div>
