<?php
use yii\helpers\Html;
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Kibaha Independent Receipt</title>
	<link rel="stylesheet" href="css/style2.css" type="text/css">
</head>
<area>
	<div class="page">
		
		<div class="area">
			<div class="receipt">
				
				<div class="content">
					<div>
						<div id="logo">
						<img src="images/logo.png" alt="">
						</div>
						
						<div id="heading" class="heading">
						<b><h2>KIBAHA INDEPENDENT PRE & PRIMARY SCHOOL (K.I.P.S) </h2></b>	
						</div>
						
						<div id="contacts" class="heading">
						<h5><b>Address:</b> P.O.Box 30126, Kibaha - Pwani / <b>Mobile:</b> 0782-609222 / <b>Tel:</b> 023-2402181</h5>
						<h5><b>Web:</b> www.kibahaindependent.sc.tz / <b>eMail:</b> info@kibahaindependent.sc.tz </h5>	
						</div>

					</div>
					
						<div id="labels">
							<div id="intro">
                                                            <div id="rec_no"><h3>Receipt No: <?php echo $model->receipt_number;?></h3></div><div id="date"><h3><?php echo date('d/m/Y')?></h3></div>
						 <div id="title"> <h2>RECEIPT</h2></div>
						</div>
							
						<div id="contents">  	
						<br>
						<p>
							 	<b> Received from <i><?php echo app\models\KipsUsers::getStudentName($model->student_id); ?></i>  a sum of shillings <?php echo number_format($model->amount_paid,0);?>/= 
								The payment has been made for items as distributed below: </b>
						</p>	
							<div id="distribution">
							
							<table>
								<tr>
									<td></td>
									<td>Item</td>
									<td>Amount</td>
								</tr>
                                                                <?php 
                                                                   $payments = app\models\PaymentsAmount::findAll(['payments_id' =>$model->id]);
                                                                   $row =1;
                                                                   foreach ($payments as $payment){                                             
                                                                       echo '<tr><td>'.$row.'</td>';
                                                                       echo '<td>'.\app\models\KipsPaymentSetup::getPaymentsFor3($payment->payment_setup_id).'</td>';
                                                                       echo '<td>'.number_format($payment->amount,0).'</td>'
                                                                       . '</tr>';
                                                                      $row = $row + 1; 
                                                                   }
                                                                ?>
							</table>

							</div>
						<div id="closure"><h3>With thanks</h3></div>
						<br>
						<div id="rec_no"><h3>TSh: <?php echo number_format($model->amount_paid,0);?> /= &nbsp &nbsp	 </h3></div> <div id="sign"><b<<h3><br>_______________</h3></b></div>
						<br>
						<br>
						<div id="note"><h3>Note: All payments are non-refundable</h3></div>  <div id="state"><h3>Printed on <?php echo date('l jS \of F Y \a\\t H:i:s'); ?> (ORIGINAL)</h3></div>  <div id="signature"><h3>For KIBAHA INDEPENDENT PRE & PRIMARY SCHOOL</h3></div>
						</div>
						</div>                                    					
				</div>
			</div>
		</div>
		
	</div>
	<div id="print_button">
  <?= Html::a('<i class="glyphicon glyphicon-repeat"></i> Print Receipt', [], ['class' => 'btn btn-info', 'onclick' => 'window.print();return false',])?>
	</div>
  </area>
</html>