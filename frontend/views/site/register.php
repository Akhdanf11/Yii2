<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->params['breadcrumbs'][] = $this->title;
?>
    
<div class="site-register">

<h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nisn')->textInput() ?>
        <?= $form->field($model, 'nis')->textInput() ?>
        <?= $form->field($model, 'nama')->textInput() ?>
        <?= $form->field($model, 'alamat')->textarea() ?>
        <?= $form->field($model, 'no_telp')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
