<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSave() {

        $post = Yii::$app->request->post();
        $model = \app\models\Names::find()->where("id = " . $post['pk'])->one();


        $model->name = $post['value'];
        $model->save();

        //return   \yii\helpers\Json::encode(['status'=>'error','msg'=>'Field cannot be blank']);
    }

    public function actionIndex() {
     
        if (!\Yii::$app->user->isGuest) {
            return $this->render('index');
        }
        else{
            return $this->redirect(['/site/login']);
        }
    }
    
    public function actionChangeyear(){
        
        $model = \app\models\FinancialYears::findOne(Yii::$app->session->get(mfy)->YearID);
       if ($model->load(Yii::$app->request->post())) {
              
            Yii::$app->session->set('mfy', \app\models\FinancialYears::findOne($model->YearID));  
            return $this->redirect(['index']);
        }
     
        return $this->render('changeyear',[
            'model'=>$model
                ]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $my_details_array = [];
            Yii::$app->session->set('my_details', $my_details_array);
            Yii::$app->session->set('mfy', \app\models\FinancialYears::find()->where("IsCurrent = 1")->one());           
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/site/login']);
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionReports() {

        return $this->render('reports2');
    }

}
