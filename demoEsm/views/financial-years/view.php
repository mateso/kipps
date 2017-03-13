<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FinancialYears */

$this->title = $model->FinancialYear;
$this->params['breadcrumbs'][] = ['label' => 'Financial Years', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="financial-years-view">  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'YearID',
            'FinancialYear',
            [
              'label'=>'Start Date',
              'value'=>date('d M, Y', strtotime($model->FYStart)),
            ],
            [
              'label'=>'Start Date',
              'value'=>date('d M, Y', strtotime($model->FYEnd)),
            ],
            [
                'attribute'=>'IsCurrent',
                'value' => $model->IsCurrent?'<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>',
                'format'=> 'raw',
            ],
           [
             'label'=>'CoAVersionID',
             'value'=>  app\models\CoAVersions::findOne($model->CoAVersionID)->CoAVersionDescription
           ],
           [
             'attribute'=>'AdminAreaVersionID',
             'value'=> app\models\AdminAreaVersions::findOne($model->AdminAreaVersionID)->AdminAreaVersionDescription,
           ],
           [
             'attribute'=>'PriorityAreaVersionID',
             'value'=> app\models\PriorityAreaVersions::findOne($model->PriorityAreaVersionID)->PriorityAreaVersionDescription,
           ],
           [
             'attribute'=>'NationalTargetVersionID',
             'value'=> app\models\GeneralLevelTaskVersions::findOne($model->NationalTargetVersionID)->GeneralLevelTaskVersionDescription,
           ],
        ],
    ]) ?>

    <p style=" float: right">
        <?= Html::a('Update', ['update', 'id' => $model->YearID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-log-in"></i>Financial Year Ceilings', ['fyceilings/index', 'YearID' => $model->YearID], ['class' => 'btn btn-success',]); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->YearID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
