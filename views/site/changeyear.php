<?php
use yii\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FinancialYears */

$this->title = 'Switch Academic Year';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">Switch Academic Year; Year in Session: <strong><?php echo $model->FinancialYear; ?></strong>; Current Academic Year (Operational) <strong> <?php echo \app\models\FinancialYears::find()->where("IsCurrent = 1")->one()->FinancialYear; ?>  </strong></div>
  <div class="panel-body">
<div class="financial-years-create">

 <div class="financial-years-form">

    
     <?php
    $form = \kartik\form\ActiveForm::begin();

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            
            'YearID' => ['type' => Form::INPUT_DROPDOWN_LIST, 'label'=>'Financial Year',  'items'=> yii\helpers\ArrayHelper::map(app\models\FinancialYears::find()->where("PeriodTypeID = 1")->all(), "YearID", "FinancialYear"), 'options'=> ['style'=>'width: 600px']],
           
        ]
    ]);

    echo Html::submitButton("Switch to Selected Academic Year", ["class" => "btn btn-success"]);
    ?>
</div>

</div>
  </div>
</div>



