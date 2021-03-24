<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use backend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <img src="img/logo_smk9.png" alt="" height="50px" width="55px" class="ml-2">
        <h4 class="text-primary font-bold ml-2">APP SPP</h4>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <?php if(Yii::$app->user->identity->level == 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/site/index']); ?>">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/petugas/index']); ?>">PETUGAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/siswa/index']); ?>">SISWA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/jurusan/index']); ?>">JURUSAN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/contact/index']); ?>">CONTACT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/site/pembayaran']); ?>">PEMBAYARAN</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link text-gray-800 font-bold" href="<?= Url::toRoute(['/site/pembayaran']); ?>">PEMBAYARAN</a>
            </li>
            <?php endif; ?>
        

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= Yii::$app->user->identity->nama_petugas?>  </span>
                    <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= Url::toRoute(['/site/account']); ?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Account
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <?php
    // NavBar::begin([
    //     'brandLabel' => Yii::$app->name,
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         'class' => 'navbar-inverse navbar-fixed-top',
    //     ],
    // ]);
    ?>
    <?php
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'About', 'url' => ['/site/about']],
    //     ['label' => 'Contact', 'url' => ['/site/contact']],
    // ];
    // if (Yii::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    // } else {
    //     $menuItems = [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         ['label' => 'About', 'url' => ['/site/about']],
    //         ['label' => 'Contact', 'url' => ['/site/contact']],
    //     ];

        // $menuItems[] = '<li>'
        //     . Html::beginForm(['/site/logout'], 'post')
            // . Html::submitButton(
            //     'Logout (' . Yii::$app->user->identity->nama . ')',
            //     ['class' => 'btn btn-link logout']
            // )
            
        //     . Html::endForm()
        //     . '</li>';
    // }
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => $menuItems,
    // ]);
    // NavBar::end();
    ?>