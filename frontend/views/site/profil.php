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
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Classes;
use frontend\models\Skills;

$this->title = 'Profil';

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    

<!-- Page Wrapper -->
<div id="wrapper">
       


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php if(isset($profil)): ?>
            <div class="alert alert-success" id="alert-profil">Update Profil Berhasil</div>
            <?php endif; ?>
        <div class="pt-5">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 card p-lg-5 my-lg-2">
                    <small class="bio-data"></small>
                    <?php $form = ActiveForm::begin(['id' => 'bio-form']); ?>
                    <h2>
                    <img class="img-profile img-responsive rounded" src="<?= Yii::getAlias("@gambarSiswaUrl"). '/' . Yii::$app->user->identity->img?>" width="70px" height="70px">
                        <span class="bio-data justify-content-between ml-3"><?= $data['nama'] ?></span>
                        
                    </h2>
                    <hr>
                    <div class="bio">
                        <div class="row">
                        <div class="col-lg-3">
                        <div class="mb-lg-1 font-weight-bold">NISN</div>
                                        <?= $form->field($data, 'nisn')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                        </div>
                            <div class="col-lg-3">                                                                     
                                <div class="mb-1 font-weight-bold">NIS</div>
                                        <?= $form->field($data, 'nis')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-lg-1 font-weight-bold">Kelas</div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <?= Html::activeDropDownList(new Classes, 'id', ArrayHelper::map(Classes::find()->all(), 'id', 'nama'), ['class' => "form-control biodata-form", 'options' => [$data['id_kelas'] => ['selected' => 'selected']]]) ?>
                                            </div>
                                            <div class="col-lg-9">
                                                <?= Html::activeDropDownList(new Skills, 'id', ArrayHelper::map(Skills::find()->all(), 'id', 'nama'), ['class' => "form-control biodata-form", 'options' => [$data['id_jurusan'] => ['selected' => 'selected']]]) ?>
                                            </div>
                                        </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="mb-lg-1 font-weight-bold">Nama</div>
                                    <?= $form->field($data, 'nama')->textInput(['class' =>  'biodata-form form-control'])->label(false); ?>
                            </div>
                            <div class="col-6">
                            <div class="mb-lg-1 font-weight-bold">Nomor Telepon</div>
                                        <?= $form->field($data, 'no_telp')->textInput(['class' =>  'biodata-form form-control', 'id' => 'tel'])->label(false); ?>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-lg-1 font-weight-bold mt-2">Alamat</div>
                                    <?= $form->field($data, 'alamat')->textarea(['rows' => 2])->label(false); ?>
                                    <button type="submit" class="btn btn-success mt-3" id="do-update"><i class="fa fa-wrench mr-2"></i>Ubah</button>
                                </div>
                    </div>
                    <?php $form = ActiveForm::end(); ?>

                </div>
            </div>
        </div>



</div>
<!-- End of Content Wrapper -->

</div>
</div>
<!-- End of Page Wrapper -->
<?php if (isset($profil)) {
    $this->registerJs('
    $(document).ready(function(){

        setTimeout(() => {
            $("#alert-profil").fadeOut();
            window.location.href = "index.php?r=site%2Fprofil";
        }, 2000
    );

    });', \yii\web\View::POS_READY);
} ?>