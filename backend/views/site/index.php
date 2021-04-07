<?php

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron text-capitalize">
        <h1>Selamat datang</h1>

        <p class="lead text-capitalize">
        <span class="bio-data justify-content-between ml-3">
        <?= Yii::$app->user->identity->nama_petugas?>
        </span>
        Kamu telah masuk ke <b>APP SPP</b></p>
    </div>

    <div class="body-content">

        <div class="row">

        <div class="col-lg-3"></div>

            <div class="col-lg-3">
                <h2><a href="https://api.whatsapp.com/send?phone=<?= Yii::$app->user->identity->whatsapp?>" class="nav-link"><i class="fab fa-whatsapp-square"></i> Whatsapp &raquo; </a></h2>
            </div>
            <div class="col-lg-3">
            <h2><a href="https://www.instagram.com/<?= Yii::$app->user->identity->instagram?>/" class="nav-link"><i class="fab fa-instagram-square"></i> Instagram &raquo; </a></h2>
            </div>
        </div>

    </div>
</div>
