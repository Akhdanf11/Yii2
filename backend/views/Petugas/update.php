<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Petugas */

$this->title = 'Update Petugas: ' . $model->nama_petugas;
?>
<div class="petugas-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
