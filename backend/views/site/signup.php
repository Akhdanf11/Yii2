<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use backend\models\Level;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Kelas;
use frontend\models\Jurusan;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Signup Admin | Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup card-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <hr>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-8">
                <?= $form->field($model, 'username')->textInput() ?>
                </div>
                <div class="col-lg-4">
                    <b>Level</b>
                <?= Html::activeDropDownList(new Level, 'id', ArrayHelper::map(Level::find()->all(), 'id', 'nama'), ['name' => "Petugas[level]", 'class' => 'form-control']) ?>
                </div>
                </div>
        </div>

        <div class="col-lg-6">  
                    <?= $form->field($model, 'nama_petugas')->textInput() ?>
                </div>

        </div>
        <div class="row">
            <div class="col-lg-6"> 
            <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-lg-6">
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>
        <div class="col-lg-6 align-right">
        <div class="row">
                <div class="col-lg-3">
                <div class="form-group">    
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-success btn-block', 'name' => 'signup-button']) ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input class="btn btn-danger btn-block" type="reset" value="Reset">
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
