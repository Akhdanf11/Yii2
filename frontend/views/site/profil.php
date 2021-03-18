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
                        <span class="bio-data justify-content-between"><?= $data['nama'] ?></span>
                        
                    </h2>
                    <hr>
                    <div class="bio">
                        <div class="row">
                        <div class="col-3">
                        <div class="mb-1 font-weight-bold">NISN</div>
                                        <?= $form->field($data, 'nisn')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                        </div>
                            <div class="col-3">                                                                     
                                <div class="mb-1 font-weight-bold">NIS</div>
                                        <?= $form->field($data, 'nis')->textInput(['class' =>  'biodata-form form-control','readonly' => 'true', 'disabled' => 'true'])->label(false); ?>
                            </div>
                            <div class="col-6">
                                <div class="mb-1 font-weight-bold">Kelas</div>
                                        <div class="row">
                                            <div class="col-3">
                                                <?= Html::activeDropDownList(new Classes, 'id', ArrayHelper::map(Classes::find()->all(), 'id', 'nama'), ['class' => "form-control biodata-form", 'options' => [$data['id_kelas'] => ['selected' => 'selected']]]) ?>
                                            </div>
                                            <div class="col-9">
                                                <?= Html::activeDropDownList(new Skills, 'id', ArrayHelper::map(Skills::find()->all(), 'id', 'nama'), ['class' => "form-control biodata-form", 'options' => [$data['id_skill'] => ['selected' => 'selected']]]) ?>
                                            </div>
                                        </div>
                            </div>
                            <div class="col-6">
                            <div class="mb-1 font-weight-bold">Nama</div>
                                    <?= $form->field($data, 'nama')->textInput(['class' =>  'biodata-form form-control'])->label(false); ?>
                                
                            </div>
                            <div class="col-6">
                            <div class="mb-1 font-weight-bold">Nomor Telepon</div>
                                        <?= $form->field($data, 'no_telp')->textInput(['class' =>  'biodata-form form-control', 'id' => 'tel'])->label(false); ?>
                            </div>


                            <div class="col-12">
                                <div class="mb-1 font-weight-bold mt-2">Alamat</div>
                                            <?= $form->field($data, 'alamat')->textInput(['class' =>  'biodata-form form-control'])->label(false); ?>
                                             
                                <button class="btn btn-warning mt-3" id="update"><i class="fa fa-wrench mr-2"></i>Ubah</button>
                                <button class="btn btn-danger mt-3" id="cancel-update"><i class="fa fa-times mr-4"></i>Batal</button>
                                <button class="btn btn-success mt-3" id="do-update"><i class="fa fa-wrench mr-2"></i>Ubah</button>
                            </div>
                    </div>
                    <?php $form = ActiveForm::end(); ?>

                </div>
                <div id="pass">
                    <?php $form = ActiveForm::begin(['id' => 'pass-form']); ?>
                            <div class="col-4">
                                <input type="text" class="form-control" id="password" placeholder="Enter Password">                                 
                            </div>
                            <div class="col-4">
                            <input type="text" class="form-control" id="password_2" placeholder="Enter New Password">                                 
                            </div>
                            <div class="col-4">
                                    <input type="text" class="form-control" id="repeat_password" placeholder="Enter Password">                                 

                            </div>
                    <?php $form = ActiveForm::end(); ?>
                        

                        <button type="submit" class="btn btn-success mt-3"><i class="fa fa-check mr-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php

$this->signup('
    let num = 1;
    $(document).ready(function(){
    $(".action-button").toggle();
    $("#pass").toggle();
    $("$.biodata-form").toggle();

    $("#password-button").click((event) => {

        event.preventDefault();
        $($password-button").html("");
        if(num % 2) {
            let icon document.createElement("i);
            Icon.setAttribute("class", "fas fa-redo mr-2");
            let label = document.createElement("span");
            label.innerHTML = "Kembali";

        document.querySelector ("#password-button").append(icon);
        document.querySelector("#password-button").append(label);

        }else{

            let icon = document.createElement(i);
            icon.setAttribute("class", "Fas fa-key mr-2");
            let label = document.createElement("span");
            label.innerHTML = "Buat / Ganti Password";
            
            document.querySelector ("#password-button").append(icon);
            document.querySelector("#password-button").append(label);
         }

        $("#pass").slideToggle();
        $("#bio").slideToggle();
        num++;
    });
    
    $("$update").click(event) => {
        event.preventDefault();
        $("$.biodata-form").toggle();
        $("$.bio-data").toggle();
        $("$.action-button").toggle();
        $("#update").toggle();

        $("$cancel-update").click(event) => {
            event.preventDefault();
            $("$.biodata-form").toggle();
            $("$.bio-data").toggle();
            $("$.action-button").toggle();
            $("#update").toggle();
        }

        $("#tel").on("keydown", () => {
            if($("#tel").val().length = 4 {
                $("#tel").val()($("#tel").val() + "-");
            }else if $("#tel").val().length = 9) {
                $("#tel").val()($("#tel").val() + "+");
            }
        });
    });', \yii\web\View::POS_READY);
?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
