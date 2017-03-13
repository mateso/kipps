<?php

namespace app\controllers;

use Yii;
use app\models\KipsUsers;
use app\models\KipsUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\KipsPayments;
use app\models\KipsContacts;

/**
 * KipsUsersController implements the CRUD actions for KipsUsers model.
 */
class KipsUsersController extends Controller {

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
     * Lists all KipsUsers models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }

    /**
     * Displays a single KipsUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        $paymentSearchModel = new \app\models\KipsPaymentsSearch();
        $paymentCondition = "student_id = " . $id;
        $paymentDataProvider = $paymentSearchModel->search(Yii::$app->request->getQueryParams(), $paymentCondition);
        
        $studentPaymentsSearchModel =new \app\models\VwstudentpaymentsSearch();
        $studentPaymentsCondition =  "payment_setup_id IN (SELECT id FROM payment_setup WHERE payment_type IN (1,2) AND financial_year_id=".Yii::$app->session->get('mfy')->YearID.") AND student_id = " . $id;
        $studentPaymentsDataProvider = $studentPaymentsSearchModel->search(Yii::$app->request->getQueryParams(), $studentPaymentsCondition);

        $contactsSearchModel = new \app\models\KipsContactsSearch();
        $contactCondition = "student_id = " . $id;
        $contactsDataProvider = $contactsSearchModel->search(Yii::$app->request->getQueryParams(), $contactCondition);


        //Student Contacts
        if (isset($_POST['KipsContacts'])) {
            $studentContacts = new KipsContacts();
            $studentContacts->student_id = $id;
            $studentContacts->load(Yii::$app->request->post());
            $studentContacts->save();
        }

        //Student Payments
        if (isset($_POST['KipsPayments'])) {
            $studentPayments = new KipsPayments();
            $studentPayments->student_id = $id;
            $studentPayments->load(Yii::$app->request->post());
            $studentPayments->validate();
            $studentPayments->save();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userid]);
        } else {
            return $this->render('view', [
                'model' => $model,
                'paymentSearchModel' => $paymentSearchModel,
                'paymentDataProvider' => $paymentDataProvider,
                'contactsSearchModel' => $contactsSearchModel,
                'contactsDataProvider' => $contactsDataProvider,
                'studentPaymentsSearchModel' => $studentPaymentsSearchModel,
                'studentPaymentsDataProvider' => $studentPaymentsDataProvider,
                ]
                );
        }
    }

    /**
     * Creates a new KipsUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new KipsUsers;
        if (isset($_POST['KipsUsers'])) {
            $model->load(Yii::$app->request->post());
            $model->password = sha1($model->surname);
            if($model->class < 3){
              $last_regNo = KipsUsers::findBySql("SELECT * FROM `user` WHERE `username` LIKE 'PU%' ORDER BY username DESC")->one(); 
              $reg_number = explode('U', $last_regNo->username);
              $reg_number_format = $reg_number[1] + 1;
              if($reg_number_format < 10){
               $reg_number_format = 'PU0000'.$reg_number_format;
           }
           elseif($reg_number_format >= 10 && $reg_number_format < 100){
               $reg_number_format = 'PU000'.$reg_number_format;
           }
           elseif($reg_number_format >= 100 && $reg_number_format < 1000){
               $reg_number_format = 'PU00'.$reg_number_format;
           }
           elseif($reg_number_format >= 1000 && $reg_number_format < 10000){
               $reg_number_format = 'PU0'.$reg_number_format;
           }
           else{
               $reg_number_format = 'PU'.$reg_number_format;
           }
       }
       else{
           $last_regNo = KipsUsers::findBySql("SELECT * FROM `user` WHERE `username` LIKE 'PS%' ORDER BY username DESC")->one();
           $reg_number = explode('S', $last_regNo->username);
           $reg_number_format = $reg_number[1] + 1;
           if($reg_number_format < 10){
               $reg_number_format = 'PS0000'.$reg_number_format;
           }
           elseif($reg_number_format >= 10 && $reg_number_format < 100){
               $reg_number_format = 'PS000'.$reg_number_format;
           }
           elseif($reg_number_format >= 100 && $reg_number_format < 1000){
               $reg_number_format = 'PS00'.$reg_number_format;
           }
           elseif($reg_number_format >= 1000 && $reg_number_format < 10000){
               $reg_number_format = 'PS0'.$reg_number_format;
           }
           else{
               $reg_number_format = 'PS'.$reg_number_format;
           }

       }           
       $model->username = $reg_number_format;
       $model->user_type = 2;
       if ($model->save()) {
        return $this->redirect(['view', 'id' => $model->userid]);
    }
} else {
    return $this->render('create', [
        'model' => $model,
        ]);
}
}

    /**
     * Updates an existing KipsUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userid]);
        } else {
            return $this->render('update', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Deletes an existing KipsUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->status = '2';
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the KipsUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KipsUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KipsUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionFeesDepts() {

        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2 AND status = 1";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);
        return $this->render('feesDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }
    
    public function actionTransportDepts() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2 AND status = 1";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('transportDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }
    
    public function actionUniformDepts() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('uniformDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }
    
    public function actionApplicationDepts() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2 AND status = 1";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('applicationDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }
    
    public function actionAdmissionDepts() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2 AND status = 1";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('admissionDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }
    
    public function actionOtherDepts() {
        $searchModel = new KipsUsersSearch;
        $condition = "user_type = 2 AND status = 1";
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $condition);

        return $this->render('otherDepts', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            ]);
    }

}