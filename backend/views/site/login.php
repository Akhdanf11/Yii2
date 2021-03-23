<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
        <!-- <?php var_dump(Yii::$app->request->post()) ?> -->
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-5">
            <div class="card-login" style="margin-top: 5%;background-color:#FFFF;padding:30px;opacity: 85%;border-radius: 25px;">
                <div class="card-header">
                <h1 class="text-center text-dark"><?= Html::encode($this->title) ?></h1>
                <hr>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                </div>
        </div>
    </div>
</div>