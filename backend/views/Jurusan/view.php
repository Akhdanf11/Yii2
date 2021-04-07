<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jurusan */

$this->title = $model->nama;
\yii\web\YiiAsset::register($this);
?>
<div class="jurusan-view">

<div class="row">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-3">
            <p>
                <?= Html::a('<i class="far fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                &emsp;
                <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <hr>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama:ntext',
        ],
    ]) ?>

</div>
