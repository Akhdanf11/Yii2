<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-check"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?= Yii::$app->name ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <?php if(Yii::$app->user->identity->level == 'admin'): ?>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cruds
            </div>

            <!-- Nav Item Menu -->
            <li class="nav-item">
                <a class="nav-link text-light-800 font-bold" href="<?= Url::toRoute(['/petugas/index']); ?>"><i class="fas fa-users-cog"></i>
                <span>Petugas</span></a>
            </li>

            <!-- Nav Item - Siswa -->
            <li class="nav-item">
                <a class="nav-link text-light-800 font-bold" href="<?= Url::toRoute(['/siswa/index']); ?>"><i class="fas fa-user-graduate"></i>
                <span>Siswa</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link text-light-800 font-bold" href="<?= Url::toRoute(['/jurusan/index']); ?>"><i class="fas fa-chalkboard-teacher"></i>
                <span>Jurusan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Message
            </div>

            <li class="nav-item">
                <a class="nav-link text-light-800 font-bold" href="<?= Url::toRoute(['/contact/index']); ?>"><i class="fas fa-comment"></i>
                <span>Contact</span></a>
            </li>

            <?php else: ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Message
            </div>

            <li class="nav-item">
                <a class="nav-link text-light-800 font-bold" href="<?= Url::toRoute(['/contact/index']); ?>"><i class="fas fa-comment"></i>
                <span>Contact</span></a>
            </li>

            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/logo_smk9.png" alt="">
                <p class="text-center mb-2"><strong>APP SPP</strong> adalah aplikasi pembayaran uang SPP berbasis web</p>
            </div>

        </ul>
        <!-- End of Sidebar -->
        