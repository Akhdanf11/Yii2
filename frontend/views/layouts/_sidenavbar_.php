<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
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
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Author</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Social Media:</h6>
                        <a href="https://api.whatsapp.com/send?phone=6289505707449" class="collapse-item"><i class="fab fa-whatsapp"></i> Whatsapp &raquo; </a>
                        <a href="https://www.instagram.com/akhdanfa_11/" class="collapse-item"><i class="fab fa-instagram"></i> Instagram &raquo; </a>
                        <a href="https://line.me/ti/p/sw1DVtsUgG" class="collapse-item"><i class="fab fa-line"></i> Line &raquo; </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= Url::toRoute(['/site/profil']); ?>">
                        <i class="fas fa-address-card fa-sm fa-fw mr-2"></i>
                        Profil
                    </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Call Center
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
             <a class="nav-link" href="<?= Url::toRoute(['/site/contact']); ?>">
                        <i class="fas fa-comments fa-sm fa-fw mr-2 text-gray-400"></i>
                        Contact
                    </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/logo_smk9.png" alt="">
                <p class="text-center mb-2"><strong>APP SPP</strong> adalah aplikasi pembayaran uang SPP berbasis web</p>
            </div>

        </ul>
        <!-- End of Sidebar -->
        