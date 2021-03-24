<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Siswa */

$this->title = 'Create Siswa';
?>
<div class="siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
