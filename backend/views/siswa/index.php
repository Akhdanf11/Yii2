<?php

use yii\bootstrap\Html as BootstrapHtml;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Siswa';
?>
<div class="siswa-index">

    <div class="row">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-3">
            <p>
                <?= Html::a('<i class="fas fa-user-plus"></i> Tambah Siswa', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>  
    </div>
    <div class="row">
        <div class="col-lg-11">
            <hr>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nisn',
            'nis',
            'nama:ntext',
            //'id_jurusan',
            'alamat:ntext',
            'no_telp',
            // [
            //     'label' => 'Foto Siswa',
            //     'attribute' =>'img',
            //     'format' => ['image', ['width' => '100', 'height' => '100']],
            //     'value' => Yii::getAlias('@gambarSiswaUrl'). '/' . $model->img,
            // ],
            //'id_spp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
