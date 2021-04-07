<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Siswa */

$this->title = $model->nama;
\yii\web\YiiAsset::register($this);
?>
<div class="siswa-view">

    <div class="row">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-3">
            <p>
                <?= Html::a('<i class="far fa-edit"></i> Update', ['update', 'id' => $model->nisn], ['class' => 'btn btn-primary']) ?>
                &emsp;
                <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->nisn], [
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
            'nisn',
            'nis',
            'nama:ntext',
            // 'password:ntext',
            // 'id_kelas',
            // 'id_jurusan',
            'alamat:ntext',
            'no_telp',
            // 'id_spp',    
            [
                    'label' => 'Foto Siswa',
                    'attribute' =>'img',
                    'format' => ['image', ['width' => '100', 'height' => '100']],
                    'value' => Yii::getAlias('@gambarSiswaUrl'). '/' . $model->img,
                ],
        ],
    ]) ?>


</div>
