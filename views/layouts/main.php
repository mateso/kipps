<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//use webvimark\modules\UserManagement\components\GhostMenu;
//use webvimark\modules\UserManagement\UserManagementModule;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Url::to('@web/css/print.css') ?>" media="print">  
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'KIBAHA INDEPENDENT PRE AND PRIMARY SCHOOL',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                    'style' => 'margin-left: -190px',
                ],
            ]);

            $items = [];
            //$items[] = ['label' => 'Home', 'url' => ['/site/index']];
            if (!Yii::$app->user->isGuest) {
                $items[] = ['label' => 'Switch Academic Year', 'url' => ['site/changeyear'], 'options' => ['onclick' => "$('#change_financial_year_dialog').dialog('open'); return false; "]];
                $items[] = ['label' => 'My Profile', 'url' => ['/user/my-details']];
            }
            $items[] = Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']];

            echo Nav::widget([
                'options' => [
                    'class' => 'navbar-nav navbar-right',
                    'style' => 'margin-right: -150px'
                ],
                'items' => $items,
            ]);
            NavBar::end();
            ?>
            <div class="container" style="width: 100%">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <div id="side-nav-div" style="float: left; width: 20%; padding-right: 10px;">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        echo SideNav::widget([
                            'type' => SideNav::TYPE_DEFAULT,
                            'heading' => 'Navigation',
                            'items' => [
                                [
                                    'label' => 'Home',
                                    'url' => ['/site/index'],
                                ],
                                [
                                    'label' => 'Students',
                                    'url' => ['/kips-users/index'],
                                    'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary'))
                                ],
                                [
                                    'label' => 'Payments',
                                    'items' => [
                                        [
                                            'label' => 'Clean Payments',
                                            'url' => ['/kips-payments/index'],
                                            'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                        ],
                                        [
                                            'label' => 'Cancelled Payments',
                                            'url' => ['/kips-payments/cancelled-payments'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                    ],
                                    'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant'))
                                ],
                                [
                                    'label' => 'Payment Reports',
                                    'items' =>
                                    [

                                        [
                                            'label' => 'Fees Statement',
                                            'url' => ['/payments-amount/fee-statement'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Transport Payments',
                                            'url' => ['/payments-amount/transport-payments'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Uniform Payments',
                                            'url' => ['/payments-amount/uniform-payments'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Application Payments',
                                            'url' => ['/payments-amount/application-payments'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                        ],
                                        [
                                            'label' => 'Admission Payments',
                                            'url' => ['/payments-amount/admission-payments'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Other Payments',
                                            'url' => ['/payments-amount/other-payments'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                    ],
                                    'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                ],
                                [
                                    'label' => 'Debt Reports',
                                    'items' =>
                                    [

                                        [
                                            'label' => 'Fees Debts',
                                            'url' => ['/kips-users/fees-depts'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Transport Debts',
                                            'url' => ['/kips-users/transport-depts'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Uniform Debts',
                                            'url' => ['/kips-users/uniform-depts'],
                                            'visible' => (yii::$app->user->can('/kips-payments/fee-statement') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Application Debts',
                                            'url' => ['/kips-users/application-depts'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                        ],
                                        [
                                            'label' => 'Admission Debts',
                                            'url' => ['/kips-users/admission-depts'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                        [
                                            'label' => 'Other Debts',
                                            'url' => ['/kips-users/other-depts'],
                                            'visible' => (yii::$app->user->can('/indicator-definitions/index') || yii::$app->user->can('admin') || yii::$app->user->can('accountant') || yii::$app->user->can('secretary')),
                                        ],
                                    ],
                                    'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                ],
                                [
                                    'label' => 'Expenditures',
                                    'items' => [
                                        [
                                            'label' => 'Clean Expenditures',
                                            'url' => ['/expenditures/index'],
                                            'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant')),
                                        ],
                                        [
                                            'label' => 'Cancelled Expenditures',
                                            'url' => ['/expenditures/cancelled-expenditures'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                    ],
                                    'visible' => (yii::$app->user->can('admin') || yii::$app->user->can('accountant'))
                                ],
                                [
                                    'label' => 'Setups',
                                    'items' =>
                                    [

                                        [
                                            'label' => 'Payment Settings',
                                            'url' => ['/kips-payment-setup/index'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                        [
                                            'label' => 'Payment Types',
                                            'url' => ['/kips-payment-types/index'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                        [
                                            'label' => 'Expenditure Types',
                                            'url' => ['/expenditure-types/index'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                        [
                                            'label' => 'Education Level',
                                            'url' => ['/kips-education-level/index'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                        [
                                            'label' => 'Transport Routes',
                                            'url' => ['/kips-transport-routes/index'],
                                            'visible' => (yii::$app->user->can('admin')),
                                        ],
                                    ],
                                    'visible' => (yii::$app->user->can('admin')),
                                ],
                                [
                                    'label' => 'Academic Years',
                                    'items' => [
                                        [
                                            'label' => 'Closing',
                                            'url' => ['/financial-years/closing'],
                                        ],
                                        [
                                            'label' => 'Initiating',
                                            'url' => ['/financial-years/initiate'],
                                        ],
                                        [
                                            'label' => 'Setup',
                                            'url' => ['/financial-years/index'],
                                            'visible' => (yii::$app->user->can('/financial-years/index') || yii::$app->user->can('admin')),
                                        ]
                                    ],
                                    'visible' => ((yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 3)
                                ],
                                [
                                    'label' => 'Security',
                                    'items' =>
                                    [
                                        ['label' => 'Users', 'url' => ['/user/index'], 'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 5)],
                                        ['label' => 'Roles', 'url' => ['/admin/role'], 'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 3)],
                                        ['label' => 'Permissions', 'url' => ['/admin/permission'], 'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 3)],
//                                      ['label' => 'Rules', 'url' => ['/admin/rule'],'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 5)],
                                        ['label' => 'Routes', 'url' => ['/admin/route'], 'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 3)],
//                                      ['label' => 'Menu', 'url' => ['/admin/menu'],'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 5)],
                                    ],
                                    'visible' => ((yii::$app->user->can('/user/index') || yii::$app->user->can('admin')) && Yii::$app->session->get('highest_admin_area_level') <= 5)
                                ],
                            ],
                        ]);
                    }
                    ?>
                </div>

                <div id="content-div-with-sid" style="float: left; width: 80%;">


<?= $content; ?> 
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                &emsp;&emsp;&emsp;&emsp;&emsp;  <img src="../finance/images/logo.png" alt="Logo" height="102" width="102" style="position: absolute; top: 55px; right: 2%;" >
                <p style="text-align: center">Current logged in as <?php echo Yii::$app->user->identity->firstname . " " . Yii::$app->user->identity->surname; ?>; AY in Session: <strong><?php echo Yii::$app->session->get('mfy')->FinancialYear; ?></strong> Current AY (Operational): <strong><?php echo \app\models\FinancialYears::find()->where("IsCurrent = 1")->one()->FinancialYear; ?></strong></p>


            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>