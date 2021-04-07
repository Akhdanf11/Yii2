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

$this->title = 'Manage Account';

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
        <?php if(isset($passwordupdate)): ?>
        <div class="alert alert-primary" id="alert-update">Password di Update</div>
        <?php endif; ?>

        <?php if(isset($passwordcreate)): ?>
        <div class="alert alert-primary" id="alert-create">Password di Create</div>
        <?php endif; ?>
                <div id="pass" class="mt-4">
                    <?php $formPassword = ActiveForm::begin(['id' => 'pass-form']); ?>
                    <h2>Ganti Password</h2>
                    <hr>
                    <div class="row">
                        <div class="col-lg-1"></div>
                            <div class="col-lg-10 card p-5 my-2">
                                <h2>
                                    <span class="bio-data justify-content-between"><?= $data['nama'] ?></span>
                                    
                                </h2>
                    <hr>
                    <div class="row">
                            <div class="col-4">
                                <?= $formPassword->field($pass, 'password')->passwordInput(['class' => 'form-control'])->label("Old Password"); ?>                                
                            </div>
                            <div class="col-4">
                                <?= $formPassword->field($pass, 'password_2')->passwordInput(['class' => 'form-control'])->label("New Password"); ?>                                
                            </div>
                            <div class="col-4">
                                <?= $formPassword->field($pass, 'repeat_password')->passwordInput(['class' => 'form-control']); ?>                                
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-3"><i class="fa fa-check mr-2"></i>Simpan</button>
                            </div>
                    <?php $formPassword = ActiveForm::end(); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>



</div>
<?php if (isset($passwordcreate)) {
    $this->registerJs('
    $(document).ready(function(){

        setTimeout(() => {
            $("#alert-create").fadeOut();
            window.location.href = "index.php?r=site%2Faccount";
        }, 2000
    );

    });', \yii\web\View::POS_READY);
} ?>
<?php if (isset($passwordupdate)) {
    $this->registerJs('
    $(document).ready(function(){

        setTimeout(() => {
            $("#alert-update").fadeOut();
            window.location.href = "index.php?r=site%2Faccount";
        }, 2000
    );

    });', \yii\web\View::POS_READY);
} ?>
<!-- End of Content Wrapper -->

<!-- End of Page Wrapper -->
