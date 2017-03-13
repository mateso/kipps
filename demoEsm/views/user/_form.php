<?php
use yii\helpers\Html;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\MainBudgetCeilingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php
    $form = \kartik\form\ActiveForm::begin([
                'action' => ['create'],
                'method' => 'post',
    ]);
    echo \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'tittle' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Tittle',
                'items' => ['' => 'Please select', 'Ms' => 'Ms', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Dr' => 'Dr', 'Prof' => 'Prof'],
            ],
            'firstname' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'First Name',
            ],
            'middlename' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Middle Name',
            ],
            'surname' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Surname',
            ],
            'email' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Email',
            ],
            'phone' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Phone Number',
            ],
        ]
    ]);
    
    ?>

    <?php
    echo \kartik\builder\Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'username' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'User Name',
            ],
            'password' => [
                'type' => Form::INPUT_PASSWORD,
                'label' => 'Password',
            ],
            're_password' => [
                'type' => Form::INPUT_PASSWORD,
                'label' => 'Confirm Password',
            ],
            'status' => [
                'type' => Form::INPUT_CHECKBOX,
                'label' => 'STATUS_ACTIVE?',
                'columnOptions' => ['style' => 'padding:20px;'],
            ],
        ]
    ]);
    ?>


    <div class="form-group">
<?= Html::submitButton('REGISTER USER', ['class' => 'btn btn-success', 'style' => 'margin-left: 420px']) ?>
    </div>

    <?php
    \kartik\form\ActiveForm::end();
    ?>

</div>




