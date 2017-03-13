<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\web\IdentityInterface */
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['/user/index']];
$this->params['breadcrumbs'][] = ['label' => 'View user', 'url' => ['/user/view','id' => $model->{$idField}]];
$this->title = Yii::t('rbac-admin', 'Assign role to user :- '.Html::encode($model->{$usernameField}));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">
    <?php // echo Html::a(Yii::t('rbac-admin', 'Users'), ['index'], ['class'=>'btn btn-success']) ?>
<!--    <h1><?php // echo Yii::t('rbac-admin', 'User') ?>: <?php // echo Html::encode($model->{$usernameField}) ?></h1>-->

    <div class="col-lg-5">
        <?= Yii::t('rbac-admin', 'Avaliable') ?>:
        <?php
        echo Html::textInput('search_av', '', ['class' => 'role-search', 'data-target' => 'avaliable']) . '<br>';
        echo Html::listBox('roles', '', $avaliable, [
            'id' => 'avaliable',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
    <div class="col-lg-1">
        &nbsp;<br><br>
        <?php
        echo Html::a('>>', '#', ['class' => 'btn btn-success', 'data-action' => 'assign']) . '<br>';
        echo Html::a('<<', '#', ['class' => 'btn btn-success', 'data-action' => 'delete']) . '<br>';
        ?>
    </div>
    <div class="col-lg-5">
        <?= Yii::t('rbac-admin', 'Assigned') ?>:
        <?php
        echo Html::textInput('search_asgn', '', ['class' => 'role-search', 'data-target' => 'assigned']) . '<br>';
        echo Html::listBox('roles', '', $assigned, [
            'id' => 'assigned',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
</div>
<?php
$this->render('_script',['id'=>$model->{$idField}]);
