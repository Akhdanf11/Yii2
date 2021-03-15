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
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="col-lg-6">
            
                <?= $form->field($model, 'nisn')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'nis')->textInput() ?>

                <?= $form->field($model, 'nama')->textInput() ?>

                <?= $form->field($model, 'no_telp')->textInput() ?>

                <div class="form-group">    
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
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

            <?= $form->field($model, 'alamat')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
