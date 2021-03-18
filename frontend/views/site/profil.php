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

$this->title = 'Profil';
$this->params['breadcrumbs'][] = $this->title;

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
        <div class="pt-5">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 card p-5 my-2">
                    <small class="bio-data"></small>
                    <?php $form = ActiveForm::begin(['id' => 'bio-form']); ?>
                    <h2>
                        <span class="bio-data"><?= $data['nama'] ?></span>
                        <?= $form->field($data, 'nama')->textInput(['class' =>  'biodata-form form-control'])->label(false); ?>
                    </h2>
                    <hr>
                    <div class="bio">
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-1 font-weight-bold">NISN</div>
                                    <small class="bio-data">
                                        - <?= $data['nisn'] != "" ? $data['nisn'] : "Belum di Isi" ?>
                                    </small>
                                        <?= $form->field($data, 'nisn')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                                
                                <div class="mb-1 font-weight-bold">NIS</div>
                                    <small class="bio-data">
                                        - <?= $data['nis'] != "" ? $data['nis'] : "Belum di Isi" ?>
                                    </small>
                                        <?= $form->field($data, 'nis')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>

                                <div class="mb-1 font-weight-bold">Kelas</div>
                                    <small class="bio-data">
                                        - <?= $myClass['kelas'] != "" ? $myClass['kelas'] . "" . $mySkill['alias'] : "belum di Isi" ?>
                                    </small>
                                        <div class="row">
                                            <div class="col-3">
                                                <?= Html::activeDropDownList(new Classes, 'id', ArrayHelper::map(Classes::find()->all(), 'id', 'class'), ['class' => "form-control biodata-form", 'options' => [$data['id_skill'] => ['selected' => 'selected']]]) ?>
                                            </div>
                                        </div>

                                <div class="mb-1 font-weight-bold">Nomor Telepon</div>
                                    <small class="bio-data">
                                        - <?= $data['no_telp'] != "" ? $data['no_telp'] : "Belum di Isi" ?>
                                    </small>
                                        <?= $form->field($data, 'no_telp')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                            
                            
                            
                            
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
