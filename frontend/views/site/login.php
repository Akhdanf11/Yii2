<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login Siswa';
?>
<div class="site-login">
    

    <!-- <?php var_dump(Yii::$app->request->post()) ?> -->
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-5">
            <div class="card-login" style="">
                <div class="card-header">
                <h1 class="text-center text-dark"><?= Html::encode($this->title) ?></h1>
                <hr>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'nisn')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fas fa-sign-in-alt"></i> Login', ['class' => 'btn btn-primary btn-sm-3 btn-block', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="form-group">
                        <a class="stretched-link" href="<?=Yii::getAlias('@indexURL')?>"  style="text-decoration: none;">
                            <button type="submit" class="btn btn-success btn-sm-3 btn-block"><i class="fas fa-home"></i> Kembali </button>
                        </a>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>
