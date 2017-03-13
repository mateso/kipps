<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsContacts $model
 */

$this->title = $model->contact_type;
$this->params['breadcrumbs'][] = ['label' => 'Back to Student', 'url' => ['kips-users/view', 'id' => $model->student_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kips-contacts-view">


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
           // 'id',
            'contact_type',
           // 'student_id',
            'contact_first_name',
            'contact_middle_name',
            'contact_surname',
            'contact_occupation',
            'contact_religion',
            'contact_postal_address',
            'contact_residential',
            'contact_telephone',
            'contact_mobile_phone',
            'contact_office_phone',
        ],
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>true,
    ]) ?>

</div>