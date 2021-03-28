<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PetugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petugas';
?>
<div class="petugas-index">

    <div class="row">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-lg-3">
            <p>
                <?= Html::a('<i class="fas fa-user-plus"></i> Tambah Petugas', ['create'], ['class' => 'btn btn-success']) ?>
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

            'id_petugas',
            'username',
            // 'password:ntext',
            'nama_petugas',
            'level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
