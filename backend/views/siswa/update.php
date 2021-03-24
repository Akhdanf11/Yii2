<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Siswa */

$this->title = $model->nama;
$this->params= 'Update';
?>
<div class="siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
