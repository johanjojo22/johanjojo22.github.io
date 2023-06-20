<?php

include 'config/app.php';
$nomor_telepon = "+6282273498801";
$pesan = "";

$encoded_pesan = urlencode($pesan);
$wa_url = "https://api.whatsapp.com/send?phone=" . $nomor_telepon . "&text=Halo Bapak/Ibu..." . $encoded_pesan;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="./assets/styleq.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <title>Binamarga Nias</title>
</head>
<body>
<div class="header d-flex justify-content-between px-3 py-3 bg-dark align-items-center sticky-top">
    <div class="text-white text-uppercase d-flex">
        <a href="index.php" class="d-flex justify-content-center align-items-center nav-link p-0 text-white">
            <img src="./assets/logo.png" alt="logo" width="30px">
            <h6 class="ms-3 mt-1">dinas binamarga</h6>
        </a>
        <div>
            <button id="opn" class="open-btn btn text-white" onclick="openNav()"><i class='bx bx-menu'></i></button>
            <button id="cls" class="close-btn btn text-white" onclick="closeNav()"><i class='bx bx-menu'></i></button>
        </div>
    </div>
    <div class="user-profile dropdown">
        <button class="navbar-brand dropdown-toggle text-capitalize text-white d-flex align-items-center gap-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class='bx bxs-user-circle'></i>
            <?= $_SESSION['username'] ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <div class="flex-nowrap">
        <div id="sidebar" class="navigasi">
            <div class="d-flex flex-column text-white">
                <ul class="nav mb-sm-auto mb-0" id="menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link align-middle text-dark">
                            <i class='bx bxs-dashboard'></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] == 1) : ?>
                        <li class="nav-item">
                            <a href="index.php" class="nav-link align-middle text-dark">
                                <i class='bx bxs-edit-alt' ></i> <span class="ms-1 d-none d-sm-inline">Input Data Monitoring</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="cari.php" class="nav-link align-middle text-dark">
                            <i class='bx bxs-report' ></i> <span class="ms-1 d-none d-sm-inline">Data Monitoring</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="laporan.php" class="nav-link align-middle text-dark">
                            <i class='bx bxs-report' ></i> <span class="ms-1 d-none d-sm-inline">Laporan Bulanan</span>
                        </a>
                    <?php if ($_SESSION['level'] == 1) : ?>
                        <li class="nav-item">
                            <a href="user.php" class="nav-link align-middle text-dark">
                                <i class='bx bxs-user-detail'></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="kontak text-center">
                <a href="<?php echo $wa_url; ?>" class="text-dark nav-link text-decoration-none">
                <i class='bx bxs-contact'></i> <span class="ms-1 d-none d-sm-inline">Kontak</span>
                </a>
            </div>
        </div>
    <section id="main">