<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';   
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>


<div class="pt-5">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 card p-5 my-2">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <p>
                        Jika anda punya keluhan mohon isi form dibawah.
                    </p>
                    <hr>
                    <div class="bio">
                        <div class="row">
                            <div class="col-12">
                                <?= $form->field($model, 'body')->textarea(['rows' => 6])->label("Keluhan") ?>
                            <div class="form-group">
                                <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>
                            </div>
                    </div>
                    <?php $form = ActiveForm::end(); ?>

                </div>
            </div>
        </div>
        </div>



</div>