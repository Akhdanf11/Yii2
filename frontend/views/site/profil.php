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

            <!-- Page Heading -->
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
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
