<?php

use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'Kibaha Independent Pre and Primary School';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-index">

    <div class="body-content">

        <div id="intro" class="alert alert-info" role="alert" style="font-size: 1.1em">
            <h2> eSM for KIBAHA INDEPENDENT PRE AND PRIMARY SCHOOL <b>(KIPS) </b> </h2>
            <br>
            <l>Logged in as:</l>&nbsp<i><?php echo Yii::$app->user->identity->firstname . " " . Yii::$app->user->identity->surname; ?> </i> 
            <m>Academic Year: <year><?php echo Yii::$app->session->get('mfy')->FinancialYear; ?></year> </m>
            &nbsp &nbsp &nbsp
            <r>Email: <a class="btn btn-info" href="http://webmail.kibahaindependent.sc.tz"><b>INBOX</b></a> </r>
        </div>
    <?php if(yii::$app->user->can('admin') || yii::$app->user->can('accountant')){?>
        <div id="widget" class="container" align="center">
            <div id="wbox1"> 
                <h1> Financial Status </h1> 
                <h4  title="Bal=Income - Expenditure">Bal:<span style="color: <?php echo $color ?> "> 56,000,000 </span> </h4>	<!-- If negative colour red, if positive colour green -->
                <h5>Income: 45,320,000 </h5>
                <h5>Expenditure: 43,210,000 </h5>
                <ul>

                    <h3 style="color:green" title="% difference from last year surplus"> 
                        +35%
                    </h3>
                </ul>
            </div>			
            <div id="wbox2"> 
                <h1>  Sources of Income </h1>
                <?php
                $column_data = [[0 => 'Tution Fee', 1 => doubleval(2000000)], [0 => 'Transport Fee', 1 => doubleval(120000)], [0 => 'Uniform Fee', 1 => doubleval(90000)]];
                echo Highcharts::widget([
                    'options' => [
                        'chart' => ['type' => 'pie', 'height' => '295', 'plotBackgroundColor' => null,
                            'plotBorderWidth' => null,
                            'plotShadow' => false],
                        'title' => ['text' => 'Sources of Income'],
                        'tooltip' => [
                            'pointFormat' => '{series.name}:
                        <b>{point.percentage:.1f}%</b>'
                        ],
                        'plotOptions' => [
                            'pie' => [
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'dataLabels' => [
                                    'enabled' => false
                                ],
                                'showInLegend' => true
                            ]
                        ],
                        'series' => [
                            [
                                'type' => 'pie',
                                'name' => 'Percentage',
                                'data' => $column_data,
                            ]],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
            </div>

            <div id="wbox3"> 	
                <h1>  Expenditure </h1>
                <?php
                $column_data_2 = [['name' => 'Transport', 'data' => [64326900, 88922090]], ['name' => 'Internet', 'data' => [4326900, 8922090]]];
//                echo '<pre>';print_r($column_data_2);die('Michael');
                $years = [2015, 2016];
                echo Highcharts::widget([
                    'options' => [
                        'chart' => ['type' => 'column', 'height' => '295'],
                        'title' => ['text' => 'Expenditures'],
                        'xAxis' => [
                            'categories' => $years
                        ],
                        'yAxis' => [
                            'min' => 0,
                            'title' => ['text' => 'Total costs']
                        ],
                        'tooltip' => [
                            'pointFormat' => ['<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                                'shared' => true]
                        ],
                        'plotOptions' => [
                            'column' => [
                                'stacking' => 'percent'
                            ]
                        ],
                        'series' => $column_data_2,
                        'credits' => ['enabled' => false],
                        'scripts' => ['exporting'],
                    ]
                ]);
                ?>
            </div>
            <div id="wbox5"> 
                <h1> Top expenditures </h1>
                <table  cellpadding="5" cellspacing="15" class="wboxtable" border="0" style="margin-top:20px;">
                    <tbody>	
                        <?php
                        echo ' 
                <tr>
                    <td>' . 'Transport' . '</td>';
                        echo '<td>' . number_format(84326900, 2) . '%' . '</td>';
                        '</tr> 
              ';
                        echo ' 
                <tr>
                    <td>' . 'Internet' . '</td>';
                        echo '<td>' . number_format(74326900, 2) . '/=' . '</td>';
                        '</tr> 
              ';
                        echo ' 
                <tr>
                    <td>' . 'Telephone' . '</td>';
                        echo '<td>' . number_format(64326900, 2) . '/=' . '</td>';
                        '</tr> 
              ';
                        echo ' 
                <tr>
                    <td>' . 'Water' . '</td>';
                        echo '<td>' . number_format(54326900, 2) . '/=' . '</td>';
                        '</tr> 
              ';
                        echo ' 
                <tr>
                    <td>' . 'Food' . '</td>';
                        echo '<td>' . number_format(44326900, 2) . '/=' . '</td>';
                        '</tr> 
              ';
                        ?>

                    </tbody>
                </table>
            </div>	

            <div style="text-align:right">
                <?php // echo CHtml::link('ADD NOTES', 'bwa/index.php?r=reminder/create', array('class' => 'search-button'));     ?>  <span> <?php // echo CHtml::link('Change Year', '#', array('class' => 'search-button'));     ?>  </span> 
            </div>
        </div>


        <div id="trendings"  align="center">
            <h3 style="margin-right:550px;"> Creditors</h3>
            <div id="box1" class="float-left"> 
                <table  style="width:100%">
                    <tr><td>1. TiGo Tanzania</td>  <td>345,200</td><td><a href="#">Details</a></td></tr>
                    <tr><td>2. Mateso Mtani</td> <td> 453,000</td><td><a href="#">Details</a></td></tr>
                    <tr><td>3. Simbanet</td><td>1,500</td><td><a href="#">Details</a></td></tr>
                    <tr><td>4. Dawasco</td><td>43,500</td><td><a href="#">Details</a></td></tr>
                    <tr><td>5. Tanesco</td><td>32,000</td><td><a href="#">Details</a></td></tr>
                    <tr><td>6. TiGo Tanzania</td>  <td>345,200</td><td><a href="#">Details</a></td></tr>
                    <tr><td>7. Mateso Mtani</td> <td> 453,000</td><td><a href="#">Details</a></td></tr>
                    <tr><td>8. Simbanet</td><td>1,500</td><td><a href="#">Details</a></td></tr>
                    <tr><td>9. Dawasco</td><td>43,500</td><td><a href="#">Details</a></td></tr>
                    <tr><td>10. Tanesco</td><td>32,000</td><td><a href="#">Details</a></td></tr>
                </table>
            </div>
            <h3 style="margin-top:-40px;margin-right:-550px;"> Debtors </h3>
            <div id="box2" class="float-right"> 

                <table  style="width:100%">
                    <tr><td>1. Tanga Fresh</td>  <td>345,200</td><td><a href="#">Details</a></td></tr>
                    <tr><td>2. Bahati Mrefu</td> <td> 453,000</td><td><a href="#">Details</a></td></tr>
                    <tr><td>3. Neema Masumbuko</td><td>1,500</td><td><a href="#">Details</a></td></tr>
                    <tr><td>4. Tinga Tinga Arts</td><td>43,500</td><td><a href="#">Details</a></td></tr>
                </table>

            </div>
        </div>

        <div id="charts"  align="center">
            <div id="box1"> 
                <h3>  Chart 1: Income vs Expenditure over 2 years </h3>
                <?php
                $years = [2015, 2016];
                $arr_values_expenditure = [3009674006, 141079547];
                $arr_values_income = [3700033497, 266096561];
                $arr_values_balance = [690359491, 125017014];
                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'column'
                        ],
                        'title' => ['text' => 'Income vs Expenditure over 2 years'],
                        'xAxis' => [
                            'categories' => $years
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Values']
                        ],
                        'series' => [
                            ['name' => 'Expenditure', 'data' => $arr_values_expenditure],
                            ['name' => 'Income', 'data' => $arr_values_income],
                            ['name' => 'Difference', 'data' => $arr_values_balance]
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>

            </div>			
            <div id="box2"> 
                <h3>  Chart 2: Expenditure over the last 2 years </h3>
                <?php
                $years = [2015, 2016];
                $transport = [3009674006, 141079547];
                $food = [3700033497, 266096561];
                $water = [690359491, 125017014];
                $internet = [90359491, 25017014];
                $telephone = [190359491, 35017014];
                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'column'
                        ],
                        'title' => ['text' => 'Expenditure over the last 2 years'],
                        'xAxis' => [
                            'categories' => $years
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Values']
                        ],
                        'series' => [
                            ['name' => 'Transport', 'data' => $transport],
                            ['name' => 'Food', 'data' => $food],
                            ['name' => 'Water', 'data' => $water],
                            ['name' => 'Internet', 'data' => $internet],
                            ['name' => 'Telephone', 'data' => $telephone]
                        ],
                        'credits' => ['enabled' => false],
                    ]
                ]);
                ?>
            </div>
        </div>

        <div id="trial-balance" >
            <table style="width:100%">
                <h3>
                    Trial Balance as at 31 December <?php echo Yii::$app->session->get('mfy')->FinancialYear; ?></th>
                </h3>

                <tbody>
                    <tr>
                        <th>Account Title</th>
                        <th>Debit (TZS)</th> 
                        <th>Credit (TZS)</th>
                    </tr>
                    <tr>
                        <td>081. Share Capital</td>
                        <td>-</td> 
                        <td>15,000,000</td>
                    </tr>

                    <tr>
                        <td>121. Furniture & Fixture</td>
                        <td>5,000,000</td> 
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>211. Building & Infrastructure</td>
                        <td>-</td> 
                        <td>10,000,000</td>
                    </tr>

                    <tr>
                        <td>221. Creditor</td>
                        <td>5,000,000</td> 
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>231. Debtors</td>
                        <td>10,000,000</td> 
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>252. Cash</td>
                        <td>5,000,000</td> 
                        <td>-</td>
                    </tr>

                    <tr>
                        <td>321. Tuition Fees</td>
                        <td>-</td> 
                        <td>10,000,000</td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <th>310,000,000</th> 
                        <th>310,000,000</th>
                    </tr>
                </tbody>
            </table>
        </div>    
        <?php } ?>
    </div>
</div>

