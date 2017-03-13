<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentsAmountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments Amounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-amount-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payments Amount', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'payments_id',
            'payment_setup_id',
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
