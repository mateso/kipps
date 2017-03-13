<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\jui\Dialog;
//use kartik\datecontrol\DateControl;
use kartik\tabs\TabsX;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\StatusList;
//use yii\widgets\Pjax;
use app\models\Gender;

/**
 * @var yii\web\View $this
 * @var app\models\KipsUsers $model
 */
$this->title = $model->firstname.' '.$model->middlename.' '.$model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kips-users-index">
    <?php
    ob_start();
    ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => false,
        'hover' => true,
        'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
        'panel' => [
        'heading' => $this->title,
        'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => [
        'username',
		//            'userid',
        'firstname',
        'surname',
        'middlename',
        [
        'attribute' => 'class',
        'label' => 'Class',
        'format' => 'raw',
        'type' => DetailView::INPUT_DROPDOWN_LIST,
        'items' => ArrayHelper::map(\app\models\KipsEducationLevel::find()->orderBy('id')->asArray()->all(), 'id', 'education_level'), 'options' => ['prompt' => 'Select Education Level'],
        'value' => $model->studentClass->education_level,
        ],
        [
        'attribute' => 'gender',
        'label' => 'Gender',
        'format' => 'raw',
        'value' => Gender::getGenderDesc($model->gender),
        'items' => ArrayHelper::map(Gender::find()->orderBy('gender_id')->asArray()->all(), 'gender_id', 'desc_en'), 'options' => ['prompt' => 'Select Gender'],
        'type' => DetailView::INPUT_DROPDOWN_LIST,
        ],
        'date_of_birth',
        'place_of_birth',
//            'phone',
        'email:email',
//            'password',
//            'last_login',
//            'last_login_fail',
//            'num_login_fail',
        'religion',
        'denomination',
        'tribe',
        [
        'attribute' => 'status',
        'label' => 'Status',
        'format' => 'raw',
        'value' => StatusList::getStatusDesc($model->status),
        'items' => ArrayHelper::map(StatusList::find()->orderBy('status_list_id')->asArray()->all(), 'status_list_id', 'desc_en'), 'options' => ['prompt' => 'Select Status'],
        'type' => DetailView::INPUT_DROPDOWN_LIST,
        ],
        [
                'attribute' => 'student_type',
                'label' => 'Student Type',
                'format' => 'raw',
                'value' => $model->student_type == 2 ? "Day Student" : "Boarding Student",
                'items' => ['' => 'Please select', 2 => 'Day Student', 1 => 'Boarding Student'],
                'type' => DetailView::INPUT_DROPDOWN_LIST,
            ],
        ],
        'deleteOptions' => [
        'url' => ['delete', 'id' => $model->userid],
        'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ],
        'enableEditMode' => true,
        ])
        ?>


        <?php
        $studentDetails = ob_get_contents();
        ob_end_clean();
        ?>

        <?php
        ob_start();
        ?>
        <?php

        echo GridView::widget([
            'dataProvider' => $studentPaymentsDataProvider,
//        'filterModel' => $paymentSearchModel,
            'showPageSummary' => true,
            'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
//            'id',
//            'student_id',
//            [
//                'label' => 'Student',
//                'attribute' => 'student_id',
//                'value' => function ($model) {
//                    return app\models\KipsUsers::getStudentName($model->student_id);
//                },
//            ],
//            'payment_setup_id',
            [
            'label' => 'Payments For',
            'attribute' => 'payment_setup_id',
            'value' => function ($model) {
                return \app\models\KipsPaymentSetup::getPaymentsFor($model->payment_setup_id);
            },
//                'filter' => Html::activeDropDownList(
//                        $paymentSearchModel, 'student_id', ArrayHelper::map(\app\models\KipsPaymentTypes::findBySql("SELECT payment_setup.`id` as id,`financial_year_id`,CONCAT(education_level.`education_level`,' - ',payment_types.`payment_type`,' - ',payment_setup.`fee_category`,' - ',payment_setup.`amount`) AS paymentSetup  FROM `payment_setup` INNER JOIN education_level ON education_level.`id`=payment_setup.`education_level` INNER JOIN payment_types ON payment_types.`id`=payment_setup.payment_type WHERE `financial_year_id`=4")->orderBy('id')->asArray()->all(), 'id', 'paymentSetup'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
//                )
            'pageSummary' => 'Total',
            ],
            [
            'label' => 'SEMISTER 1',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
            'value' => function($model) {
             return \app\models\KipsPaymentSetup::getStudentAmountPaid($model->payment_setup_id, $model->student_id);
         },
         'hAlign' => 'right',
         'width' => '15%',
         'format' => ['decimal', 2],
         'pageSummary' => true
         ],
         [
         'label' => 'SEMISTER 2',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
         'value' => function($model) {
            return '-';
        },
//                'hAlign' => 'right',
//                'width' => '15%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
        ],
        [
        'label' => 'SEMISTER 3',
                //                'value' => function ($model) {
//                  return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->amount);
//                },
        'value' => function($model) {
            return '-';
        },
//                'hAlign' => 'right',
//                'width' => '15%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
        ],
        [
        'label' => 'Balance',
        'value' => function ($model) {
            return \app\models\KipsPaymentSetup::getStudentPaymentSetUpBalance($model->payment_setup_id, $model->student_id,$model->id);
        },

        'format' => 'raw',
        'hAlign' => 'right',
        'width' => '15%',
        'format' => ['decimal', 2],
        'pageSummary' => true
        ],
//            'description',
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'header' => 'Actions',
//                'template' => '{update} {view} {delete}',
//                'buttons' => [
//                    'update' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-payments/view', 'id' => $model->id, 'edit' => 't']), [
//                                    'title' => Yii::t('yii', 'Edit'),
//                        ]);
//                    },
//                            'view' => function ($url, $model) {
//
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                                    'title' => Yii::t('yii', 'View'),
//                        ]);
//                    },
//                            'delete' => function ($url, $model) {
//
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
//                                    'title' => Yii::t('yii', 'Delete'),
//                        ]);
//                    },
//                        ],
//                        'urlCreator' => function ($action, $model) {
//                    if ($action === 'view') {
//                        $url = Url::to(['kips-payments/view', 'id' => $model->id, 'student_id' => $model->student_id]);
//                        return $url;
//                    }
//                    if ($action === 'delete') {
//                        $url = Url::to(['kips-payments/delete', 'id' => $model->id, 'student_id' => $model->student_id]);
//                        return $url;
//                    }
//                }
//                    ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
        'type' => 'info',
//                    'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Payment', '#', ['class' => 'btn btn-success', 'onclick' => "$('#enter-payment').dialog('open');return true;",]),
        'showFooter' => false
        ],
        ]);

        ?>

        <?php
        $studentPayments = ob_get_contents();
        ob_end_clean();
        ?>

        <?php
        ob_start();
        ?>

        <?php
//            Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $contactsDataProvider,
//                'filterModel' => $contactsSearchModel,
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//                    'id',
            'contact_type',
//                    'student_id',
//                    [
//                        'label' => 'Student',
//                        'attribute' => 'student_id',
//                        'value' => function ($model) {
//                            return app\models\KipsUsers::getStudentName($model->student_id);
//                        },
//                    ],
//                    'contact_first_name',
//                    'contact_middle_name',
            [
            'label' => 'Contact Fullname',
            'value' => function ($model) {
               return $model->contact_first_name.'  '.$model->contact_middle_name.'  '.$model->contact_surname;
           },
           ],
//            'contact_surname', 
           'contact_occupation', 
//            'contact_religion', 
//            'contact_postal_address', 
           'contact_residential', 
//            'contact_telephone', 
           'contact_mobile_phone', 
//            'contact_office_phone', 
           [
           'class' => 'yii\grid\ActionColumn',
           'header' => 'Actions',
           'template' => '{update} {view} {delete}',
           'buttons' => [
           'update' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['kips-contacts/view', 'id' => $model->id, 'student_id' => $model->student_id, 'edit' => 't']), [
                'title' => Yii::t('yii', 'Edit'),
                ]);
        },
        'view' => function ($url, $model) {

            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                'title' => Yii::t('yii', 'View'),
                ]);
        },
        'delete' => function ($url, $model) {

            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                'title' => Yii::t('yii', 'Delete'),
                ]);
        },
        ],
        'urlCreator' => function ($action, $model) {
            if ($action === 'view') {
                $url = Url::to(['kips-contacts/view', 'id' => $model->id, 'student_id' => $model->student_id]);
                return $url;
            }
            if ($action === 'delete') {
                $url = Url::to(['kips-contacts/delete', 'id' => $model->id, 'student_id' => $model->student_id]);
                return $url;
            }
        }
        ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
        'type' => 'info',
        'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Contact', '#', ['class' => 'btn btn-success', 'onclick' => "$('#enter-contact').dialog('open');return true;",]), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
        'showFooter' => false
        ],
        ]);
//                    Pjax::end();
        ?>

        <?php
        $studentContacts = ob_get_contents();
        ob_end_clean();
        ?>

        <?php
        echo TabsX::widget([
            'items' => [
            [
            'label' => 'STUDENT DETAILS',
            'content' => $studentDetails,
            'active' => true
            ],
            [
            'label' => 'STUDENT CONTACTS',
            'content' => $studentContacts,
            'active' => false
            ],
            [
            'label' => 'STUDENT PAYMENTS',
            'content' => $studentPayments,
            'active' => false
            ],
            ],
            ]);
            ?>

        </div>

        <?php
        Dialog::begin([
            'clientOptions' => [
            'title' => 'ADD PAYMENT',
            'autoOpen' => false,
            'height' => 450,
            'width' => '80%',
            ],
            'options' => [
            'id' => 'enter-payment',
            ],
            ]);
        echo $this->render('_addPayment', array('model' => new app\models\KipsPayments()));

        Dialog::end();
        ?>

        <?php
        Dialog::begin([
            'clientOptions' => [
            'title' => 'ADD CONTACT',
            'autoOpen' => false,
            'height' => 450,
            'width' => '80%',
            ],
            'options' => [
            'id' => 'enter-contact',
            ],
            ]);
        echo $this->render('_addContact', array('model' => new \app\models\KipsContacts()));

        Dialog::end();
        ?>