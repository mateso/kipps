<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\ExpenditureTypes $model
 */

$this->title = $model->expenditure_type_name;
$this->params['breadcrumbs'][] = ['label' => 'Expenditure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-types-view">

    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
//            'expenditure_type_id',
            'expenditure_type_name',
            'expenditure_type_description',
//            [
//                'attribute'=>'date_created',
//                'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
//                'type'=>DetailView::INPUT_WIDGET,
//                'widgetOptions'=> [
//                    'class'=>DateControl::classname(),
//                    'type'=>DateControl::FORMAT_DATETIME
//                ]
//            ],
//            'who_created',
//            'status',
        ],
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->expenditure_type_id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>true,
    ]) ?>

</div>
