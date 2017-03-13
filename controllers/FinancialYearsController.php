<?php

namespace app\controllers;

use Yii;
use app\models\FinancialYears;
use app\models\FinancialYearsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FinancialYearsController implements the CRUD actions for FinancialYears model.
 */
class FinancialYearsController extends Controller
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
     * Lists all FinancialYears models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinancialYearsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FinancialYears model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FinancialYears model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FinancialYears();

        if ($model->load(Yii::$app->request->post())) {
            $financial_year_exploded = explode("/", trim($model->FinancialYear));
            $start_year = $financial_year_exploded[0];
            $end_year = $financial_year_exploded[1];
            if(strlen($start_year) !== 4 || strlen($end_year) !== 2 ) {
               $model->addError("FinancialYear","Wrong financial year format. Typical example: 2015/16"); 
            } else {
              $start_year2digits = substr($start_year, 2,2);
              $start_year2digits = $start_year2digits + 1;
              if($start_year2digits != $end_year){
                $model->addError("FinancialYear","Wrong financial year format. Typical example: 2015/16");   
              } else {
              $model->FYStart = $start_year."-7-1";
              $model->FYEnd =  ($start_year + 1)."-6-30";
            }
            if($model->validate(NULL, false)){
             if($model->save(false)){
             return $this->redirect(['view', 'id' => $model->YearID]);
             }
            }
          } 
        }
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }
    
    
    public function actionInitiate()
    {
      return $this->render("initiate");  
    }
    
    public function actionClosing()
    {
      return $this->render("closing");  
    }

    /**
     * Updates an existing FinancialYears model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $financial_year_exploded = explode("/", trim($model->FinancialYear));
            $start_year = $financial_year_exploded[0];
            $end_year = $financial_year_exploded[1];
            if(strlen($start_year) !== 4 || strlen($end_year) !== 2 ) {
               $model->addError("FinancialYear","Wrong financial year format. Typical example: 2015/16"); 
            } else {
              $start_year2digits = substr($start_year, 2,2);
              $start_year2digits = $start_year2digits + 1;
              if($start_year2digits != $end_year){
                $model->addError("FinancialYear","Wrong financial year format. Typical example: 2015/16");   
              } else {
              $model->FYStart = $start_year."-7-1";
              $model->FYEnd =  ($start_year + 1)."-6-30";
              }
            }
            if($model->validate(NULL, false)){
            if($model->save(false)){
            return $this->redirect(['view', 'id' => $model->YearID]);
             }
            }
        } 
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing FinancialYears model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FinancialYears model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinancialYears the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FinancialYears::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
