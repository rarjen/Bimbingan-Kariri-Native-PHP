<?php
$nama = $_SESSION["username"];
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Poliklinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?= $nama; ?></a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active menu" id="menuHome">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/admin/obat/index.php" class="nav-link menu" id="menuObat">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/admin/dokter/index.php" class="nav-link menu" id="menuDokter">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/admin/pasien/index.php" class="nav-link menu" id="menuPasien">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/admin/obat/index.php" class="nav-link menu" id="menuJadwal">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal Pemeriksaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/admin/poliklinik/index.php" class="nav-link menu" id="menuPoliklinik">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Poliklinik</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>