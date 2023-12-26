<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Poliklinik | OKA</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../../assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../assets/admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include("../../../koneksi.php") ?>

        <!-- Navbar  -->
        <?php include("../../../components/navbar.php") ?>

        <!-- Main Sidebar Container -->
        <?php include("../../../components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <?php include("dokter.php") ?>
            </div>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="../../../assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Poliklinik</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../../assets/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                                    <a href="../../../index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../obat/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Obat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dokter</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/obat/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pasien</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/obat/index.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal Pemeriksaan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../poliklinik/index.php" class="nav-link">
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
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include("../../../components/footer.php") ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../../assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../assets/admin/dist/js/adminlte.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var dataId = $(this).data('obatid'); // obatid didapat dari id yang dikirimkan melalui tombol edit
                $('#seg-modal').load(`editDokter.php?id=${dataId}`, function() {
                    $('#myModal').modal('show');
                });
            });
        });
    </script>
</body>

</html>