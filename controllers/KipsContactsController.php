<?php

namespace app\controllers;

use Yii;
use app\models\KipsContacts;
use app\models\KipsContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KipsContactsController implements the CRUD actions for KipsContacts model.
 */
class KipsContactsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all KipsContacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KipsContactsSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single KipsContacts model.
     * @param integer $id
     * @param integer $student_id
     * @return mixed
     */
    public function actionView($id, $student_id)
    {
        $model = $this->findModel($id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id, 'student_id' => $model->student_id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }

    /**
     * Creates a new KipsContacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KipsContacts;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KipsContacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $student_id
     * @return mixed
     */
    public function actionUpdate($id, $student_id)
    {
        $model = $this->findModel($id, $student_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'student_id' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KipsContacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $student_id
     * @return mixed
     */
    public function actionDelete($id, $student_id)
    {
        $this->findModel($id, $student_id)->delete();

         return $this->redirect(['kips-users/view', 'id' => $student_id]);
    }

    /**
     * Finds the KipsContacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $student_id
     * @return KipsContacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $student_id)
    {
        if (($model = KipsContacts::findOne(['id' => $id, 'student_id' => $student_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}