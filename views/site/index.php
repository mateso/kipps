<?php
      
/* @var $this yii\web\View */
$this->title = 'Kibaha Independent Pre and Primary School';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
<!--        <h2>Welcome,</h2>
        <h2><span class="label label-default">Logged in as</span> : <span class="label label-primary"><?php echo Yii::$app->user->identity->firstname." ".Yii::$app->user->identity->surname; ?></span></h2>
        <h2><span class="label label-default">Financial Year</span> :  <span class="label label-primary"><?php echo Yii::$app->session->get('mfy')->FinancialYear; ?></span></h2>-->
<div class="alert alert-info" role="alert" style="font-size: 1.1em">
    Welcome to KIBAHA INDEPENDENT PRE AND PRIMARY SCHOOL <b>(KIPS) </b><br><br>
    Currently logged in as: <i><?php echo Yii::$app->user->identity->firstname." ".Yii::$app->user->identity->surname; ?> </i> <br>
    Current Academic Year is: <i><?php echo Yii::$app->session->get('mfy')->FinancialYear;  ?></i>
	<br>
	<br>
	Click here to check emails: <a class="btn btn-info" href="http://webmail.kibahaindependent.sc.tz"><b>INBOX</b></a> 
</div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>
