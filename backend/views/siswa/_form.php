<?php

use frontend\models\Jurusan;
use frontend\models\Kelas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">
<hr>
    <?php $form = ActiveForm::begin(['options'=> ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                <?= $form->field($model, 'nisn')->textInput() ?>
                </div>
                <div class="col-6">
                <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-lg-6">
                <p>Kelas
                <?= Html::activeDropDownList(new Kelas, 'id', ArrayHelper::map(Kelas::find()->all(), 'id', 'nama'), ['name' => "Siswa[id_kelas]", 'class' => 'form-control ']) ?>
                </p>
                </div>

                <div class="col-lg-6">
                    <p>Jurusan
                    <?= Html::activeDropDownList(new Jurusan, 'id', ArrayHelper::map(Jurusan::find()->all(), 'id', 'nama'), ['name' => "Siswa[id_jurusan]", 'class' => 'form-control']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'nama')->textInput() ?>
        </div>
        <div class="col-lg-6">
        <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'alamat')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                <?= $form->field($model, 'no_telp')->textInput() ?>
                </div>
                <div class="col-lg-6">
                <?= $form->field($model, 'img')->fileInput()->label("Foto Siswa") ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check"></i> Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
