<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\KipsPayments $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="kips-payments-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [ 
             'amount_paid' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Amount Paid...']],
            'payment_setup_id' => [
                'label' => 'Payment For',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\KipsPaymentTypes::find()->orderBy('id')->asArray()->all(), 'id', 'payment_type'), 'options' => ['prompt' => 'Payment For'],
            ],           
            'receipt_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Receipt Number...']],
//            'receipt_date' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(), 'options' => ['type' => DateControl::FORMAT_DATE,]],
            'receipt_date' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Receipt Date...']],
            'date_paid' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Date Paid...']],
//            'date_paid' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DateControl::classname(), 'options' => ['type' => DateControl::FORMAT_DATE,]],
            'payment_method' => [
                'label' => 'Payment Method',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select Payment Method','CRDB Bank' => 'CRDB Bank','NMB Bank' => 'NMB Bank','Accountant' => 'Accountant'],
            ],
            'description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter Description...']],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
