<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
// $this->params['breadcrumbs'][] = $this->title;
?>


<div class="wrapper">
    <div class="login_container" id="login_container">

        <div class="form-box" id="login-box">
            <h2>Please login to continue...</h2>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= Html::submitButton('Login', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>

            <p><b><a href="#">Forgotten my password</a></b></p>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/index.js"></script>
