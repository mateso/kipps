<?php

namespace app\controllers;

use Yii;
use app\models\PaymentsAmount;
use app\models\PaymentsAmountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsAmountController implements the CRUD actions for PaymentsAmount model.
 */
class PaymentsAmountController extends Controller
{
    public function behaviors()
    {
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
     * Lists all PaymentsAmount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsAmountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentsAmount model.
     * @param integer $id
     * @param integer $payments_id
     * @param integer $payment_setup_id
     * @return mixed
     */
    public function actionView($id, $payments_id, $payment_setup_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $payments_id, $payment_setup_id),
        ]);
    }

    /**
     * Creates a new PaymentsAmount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentsAmount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'payments_id' => $model->payments_id, 'payment_setup_id' => $model->payment_setup_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PaymentsAmount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $payments_id
     * @param integer $payment_setup_id
     * @return mixed
     */
    public function actionUpdate($id, $payments_id, $payment_setup_id)
    {
        $model = $this->findModel($id, $payments_id, $payment_setup_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'payments_id' => $model->payments_id, 'payment_setup_id' => $model->payment_setup_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PaymentsAmount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $payments_id
     * @param integer $payment_setup_id
     * @return mixed
     */
    public function actionDelete($id, $payments_id, $payment_setup_id)
    {
        $this->findModel($id, $payments_id, $payment_setup_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentsAmount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $payments_id
     * @param integer $payment_setup_id
     * @return PaymentsAmount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $payments_id, $payment_setup_id)
    {
        if (($model = PaymentsAmount::findOne(['id' => $id, 'payments_id' => $payments_id, 'payment_setup_id' => $payment_setup_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionFeeStatement() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=1) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('fee-statement', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionTransportPayments() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=2) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('transport-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionUniformPayments() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=3) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('uniform-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionApplicationPayments() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=4) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('application-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionAdmissionPayments() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type=9) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('admission-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    public function actionOtherPayments() {
        $searchModel = new PaymentsAmountSearch;
        $condition = "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type IN (5,6,7,8)) AND payments_id NOT IN (SELECT `id` FROM `payments` WHERE `status` = 0)";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('other-payments', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }
}