<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Kelas;
use frontend\models\Jurusan;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup card-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <hr>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="col-lg-6">
            
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'nisn')->textInput(['autofocus' => true ,'autocomplete' => 'off'])->label('Nisn') ?>
                    </div>
                    <div class="col-lg-6">
                    <?= $form->field($model, 'nis')->textInput() ?>
                    </div>
                </div>
                

                <?= $form->field($model, 'nama')->textInput() ?>
                
        </div>

        <div class="col-lg-6">  
            <div class="row">
                 
                <div class="col-lg-6">
                    <b>Kelas</b>
                    <?= Html::activeDropDownList(new Kelas, 'id', ArrayHelper::map(Kelas::find()->all(), 'id', 'nama'), ['name' => "Siswa[id_kelas]", 'class' => 'form-control']) ?>
                </div>

                <div class="col-lg-6">
                    <b>Jurusan</b>
                    <?= Html::activeDropDownList(new Jurusan, 'id', ArrayHelper::map(Jurusan::find()->all(), 'id', 'nama'), ['name' => "Siswa[id_jurusan]", 'class' => 'form-control']) ?>
                </div>

            </div>
            
            <br>
            <div class="row">
                <?= $form->field($model, 'no_telp')->textInput() ?>

            </div>

        </div>
        <div class="col-lg-12">
        <?= $form->field($model, 'alamat')->textInput() ?>
        </div>

        <div class="col-lg-6">
        
        <?= $form->field($model, 'password')->passwordInput() ?>
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
            <div class="col-lg-6">
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
