<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Expenditures $model
 */
$this->title = $model->expenditure_description;
$this->params['breadcrumbs'][] = ['label' => 'Expenditures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditures-view">

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
//            'expenditure_id',
//            'financial_year',
//            'expenditure_type',
            [
                'attribute' => 'expenditure_type',
                'label' => 'Expenditure Type',
                'format' => 'raw',
                'value' => $model->expenditureType->expenditure_type_name,
            ],
            'expenditure_description',
            'amount',
            [
                'attribute' => 'expenditure_date',
                'format' => ['date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y'],
                'type' => DetailView::INPUT_WIDGET,
                'widgetOptions' => [
                    'class' => DateControl::classname(),
                    'type' => DateControl::FORMAT_DATE
                ]
            ],
//            'status',
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
        ],
        'deleteOptions' => [
            'url' => ['delete', 'id' => $model->expenditure_id],
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ],
        'enableEditMode' => false,
    ])
    ?>

</div>
