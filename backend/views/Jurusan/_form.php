<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jurusan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurusan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
