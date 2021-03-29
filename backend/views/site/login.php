<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login Admin | Petugas';
?>
<div class="site-login">
        <!-- <?php var_dump(Yii::$app->request->post()) ?> -->
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-7">
            <div class="card-login" style="margin-left:5%;margin-top: 5%;background-color:#FFFF;padding:30px;opacity: 90%;border-radius: 25px;">
                <div class="card-header">
                <h1 class="text-center text-dark"><?= Html::encode($this->title) ?></h1>
                <hr>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-8">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        </div>
                    </div>
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