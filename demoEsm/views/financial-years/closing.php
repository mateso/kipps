<?php
use yii\helpers\Html;
$this->title = 'Closing Financial Year '.\app\models\FinancialYears::find()->where("IsCurrent = 1")->one()->FinancialYear;
$this->params['breadcrumbs'][] = $this->title

?>

<div class="panel panel-default">
    <div class="panel-heading">Closing Academic Year: <strong><?php echo \app\models\FinancialYears::find()->where("IsCurrent = 1")->one()->FinancialYear; ?></strong>;  </div>
  <div class="panel-body">
<div class="financial-years-create">

    <h1><?= Html::encode($this->title) ?></h1>

 <div class="financial-years-form">

    <button class="btn btn-primary" type="button">
   <span class="glyphicon glyphicon-off"></span> Close Financial Year
</button>
  </div>

</div>
  </div>
</div>

