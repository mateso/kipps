<?php

namespace app\controllers;

use Yii;
use app\models\KipsPayments;
use app\models\KipsPaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PaymentsAmountSearch;

/**
 * KipsPaymentsController implements the CRUD actions for KipsPayments model.
 */
class KipsPaymentsController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all KipsPayments models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new KipsPaymentsSearch();
        $condition = "status = 1 AND financial_year_id = ".Yii::$app->session->get('mfy')->YearID;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(),$condition);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
    
      public function actionCancelledPayments() {
        $searchModel = new KipsPaymentsSearch();
        $condition = "status = 0 AND financial_year_id = ".Yii::$app->session->get('mfy')->YearID;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(),$condition);

        return $this->render('cancelled_payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single KipsPayments model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        //Amount Paid Distribution
        $searchModel = new PaymentsAmountSearch();
        $condition = "payments_id = " . $model->id;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

       //Payment Status
        $paymentTypeSearchModel = new \app\models\VwstudentpaymentsSearch();
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type IN (1,2)) AND student_id = " . $model->student_id;
        $paymentTypeSearchModelDataProvider = $paymentTypeSearchModel->search(Yii::$app->request->getQueryParams(), $condition);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'paymentTypeSearchModel' => $paymentTypeSearchModel, 'paymentTypeSearchModelDataProvider' => $paymentTypeSearchModelDataProvider,'payment_id' => $model->id]);
        }
    }
    
     public function actionPreview($id) {
        $model = $this->findModel($id);
        return $this->render('view-2', ['model' => $model,]);
    }

    /**
     * Creates a new KipsPayments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new KipsPayments;
        if (Yii::$app->request->post()) {

            $payment_counts = KipsPayments::find()->count();
            $receipt_number = 150000 + $payment_counts +1;    
            $duuh = Yii::$app->request->post();
            $model->load(Yii::$app->request->post());
            $model->receipt_number = $receipt_number;
            $model->financial_year_id =6;           
            $student = \app\models\KipsUsers::findOne(['userid' => $model->student_id]);
            $model->student_class = $student->class;

            if ($model->save()) {
            
                //tution_fee
                $tution_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` = 1 AND `education_level` = " . $student->class . " AND `fee_category` = " . $model->student_type)->one();
                if ($tution_fee_setup) {
                    $tution_fee_model = new \app\models\PaymentsAmount();
                    $tution_fee_model->payments_id = $model->id;
                    $tution_fee_model->payment_setup_id = $tution_fee_setup->id;
                    $tution_fee_model->amount = $duuh['KipsPayments']['tution_fee'];
                    $tution_fee_model->student_id = $student->userid;
                    $tution_fee_model->student_class = $student->class;
                    $tution_fee_model->validate();
                    $tution_fee_model->save();
                }

                //transport_fee
                if ($model->transport_route) {
                    $transport_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` = 2 AND transport_routes = " . $model->transport_route)->one();
                    if ($transport_fee_setup) {
                        $transport_fee_model = new \app\models\PaymentsAmount();
                        $transport_fee_model->payments_id = $model->id;
                        $transport_fee_model->payment_setup_id = $transport_fee_setup->id;
                        $transport_fee_model->amount = $duuh['KipsPayments']['transport_fee'];
                        $transport_fee_model->student_id = $student->userid;
                        $transport_fee_model->student_class = $student->class;
                        $transport_fee_model->save();
                    }
                }

                //graduation_fee
                $graduation_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =7")->one();
                if ($graduation_fee_setup) {
                    $graduation_fee_model = new \app\models\PaymentsAmount();
                    $graduation_fee_model->payments_id = $model->id;
                    $graduation_fee_model->payment_setup_id = $graduation_fee_setup->id;
                    $graduation_fee_model->amount = $duuh['KipsPayments']['graduation_contribution_fee'];
                    $graduation_fee_model->student_id = $student->userid;
                    $graduation_fee_model->student_class = $student->class;
                    $graduation_fee_model->save();
                }

                //uniform_fee
                if ($student->class <= 2) {
                    $uniform_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =3  AND `education_level` = " . $student->class)->one();
                } else {
                    $uniform_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =3  AND `education_level` = " . $student->class . " AND `fee_category` = " . $model->student_type)->one();
                }
                if ($uniform_fee_setup) {
                    $uniform_fee_model = new \app\models\PaymentsAmount();
                    $uniform_fee_model->payments_id = $model->id;
                    $uniform_fee_model->payment_setup_id = $uniform_fee_setup->id;
                    $uniform_fee_model->amount = $duuh['KipsPayments']['uniform_fee'];
                    $uniform_fee_model->student_id = $student->userid;
                    $uniform_fee_model->student_class = $student->class;
                    $uniform_fee_model->save();
                }

                //admission_fee
                if ($student->class <= 2) {
                    $admission_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =9  AND `education_level` = " . $student->class)->one();
                } else {
                    $admission_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =9  AND `education_level` = " . $student->class . " AND `fee_category` = " . $model->student_type)->one();
                }
                if ($admission_fee_setup) {
                    $admission_fee_model = new \app\models\PaymentsAmount();
                    $admission_fee_model->payments_id = $model->id;
                    $admission_fee_model->payment_setup_id = $admission_fee_setup->id;
                    $admission_fee_model->amount = $duuh['KipsPayments']['admission_fee'];
                    $admission_fee_model->student_id = $student->userid;
                    $admission_fee_model->student_class = $student->class;
                    $admission_fee_model->save();
                }

                //examination_fee
                if ($student->class = 5 || $student->class = 8) {
                    $examination_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =6  AND `education_level` = " . $student->class)->one();
                    if ($examination_fee_setup) {
                        $examination_fee_model = new \app\models\PaymentsAmount();
                        $examination_fee_model->payments_id = $model->id;
                        $examination_fee_model->payment_setup_id = $examination_fee_setup->id;
                        $examination_fee_model->amount = $duuh['KipsPayments']['examination_fee'];
                        $examination_fee_model->student_id = $student->userid;
                        $examination_fee_model->student_class = $student->class;
                        $examination_fee_model->save();
                    }
                }
                //remedial_fee
                if ($student->class = 8) {
                    $remedial_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =6  AND `education_level` = " . $student->class)->one();
                    if ($remedial_fee_setup) {
                        $remedial_fee_model = new \app\models\PaymentsAmount();
                        $remedial_fee_model->payments_id = $model->id;
                        $remedial_fee_model->payment_setup_id = $remedial_fee_setup->id;
                        $remedial_fee_model->amount = $duuh['KipsPayments']['remedial_class_fee'];
                        $remedial_fee_model->student_id = $student->userid;
                        $remedial_fee_model->student_class = $student->class;
                        $remedial_fee_model->save();
                    }
                }

                //study_tour_fee
                 $study_tour_fee_setup = \app\models\KipsPaymentSetup::findBySql("SELECT * FROM `payment_setup` WHERE `financial_year_id` = 6 AND `payment_type` =5 ")->one();
                if ($study_tour_fee_setup) {
                    $study_tour_fee_model = new \app\models\PaymentsAmount();
                    $study_tour_fee_model->payments_id = $model->id;
                    $study_tour_fee_model->payment_setup_id = $study_tour_fee_setup->id;
                    $study_tour_fee_model->amount = $duuh['KipsPayments']['tour_fee'];
                    $study_tour_fee_model->student_id = $student->userid;
                    $study_tour_fee_model->student_class = $student->class;
                    $study_tour_fee_model->save();
                }

               return $this->redirect(['preview', 'id' => $model->id,]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KipsPayments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }


  public function actionCancelPayment($id) {
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save();
        return $this->redirect(['index']);
    }
    /**
     * Deletes an existing KipsPayments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        \app\models\PaymentsAmount::deleteAll(['payments_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the KipsPayments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KipsPayments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KipsPayments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFeeStatement() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=1)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('fee-statement', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionTransportPayments() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=2)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('transport-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionUniformPayments() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=3)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('uniform-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionApplicationPayments() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=4)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('application-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionAdmissionPayments() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=9)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('admission-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionOtherPayments() {
        $searchModel = new KipsPaymentsSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type IN (5,6,7,8))";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('other-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

}