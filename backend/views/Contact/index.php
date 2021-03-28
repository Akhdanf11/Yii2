<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

<div class="row">
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
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

            // 'id',
            'nisn',
            'keluhan:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
