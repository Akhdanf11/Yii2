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
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- Page Wrapper -->
<div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
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
                                <?= $formPassword->field($pass, 'password')->passwordInput(['class' => 'form-control']); ?>                                
                            </div>
                            <div class="col-4">
                                <?= $formPassword->field($pass, 'password_2')->passwordInput(['class' => 'form-control']); ?>                                
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
<!-- End of Content Wrapper -->

<!-- End of Page Wrapper -->
