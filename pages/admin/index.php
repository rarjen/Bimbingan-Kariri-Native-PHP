<?php
// Mulai sesi
session_start();

// Cek apakah sesi username sudah diset atau tidak
if (isset($_SESSION['login'])) {
    $_SESSION['login'] = true;
} else {
    echo "<meta http-equiv='refresh' content='0; url=../../index.php'>";
    die();
}

$nama = $_SESSION['username'];
$akses = $_SESSION['akses'];
$login = $_SESSION['login'];
$id = $_SESSION['id'];

if ($akses != "admin") {
    echo "<meta http-equiv='refresh' content='0; url=../../index.php'>";
    die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Poliklinik | OKA</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar  -->
        <?php include("../../components/navbar.php") ?>

        <!-- Main Sidebar Container -->
        <?php include("../../components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div id="content"></div>
            </div>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include("../../components/footer.php") ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/admin/dist/js/adminlte.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').load('./home/index.php')
            $('.menu').click(function(e) {
                e.preventDefault();
                var menu = $(this).attr('id');
                if (menu == "menuHome") {
                    $('.nav-link').removeClass('active')
                    $(this).addClass('active')
                    $('#content').load('./home/index.php');
                } else if (menu == "menuObat") {
                    $('.nav-link').removeClass('active');
                    $(this).addClass('active');
                    $('#content').load('./obat/index.php', function() {
                        $(document).ready(function() {
                            $('.edit-btn').on('click', function() {
                                var dataId = $(this).data('obatid'); // obatid didapat dari id yang dikirimkan melalui tombol edit
                                $('#seg-modal').load(`./obat/editObat.php?id=${dataId}`, function() {
                                    $('#myModal').modal('show');
                                });
                            });
                        });
                    });
                } else if (menu == "menuDokter") {
                    $('.nav-link').removeClass('active')
                    $(this).addClass('active')
                    $('#content').load('./dokter/index.php', function() {
                        $(document).ready(function() {
                            $('.edit-btn').on('click', function() {
                                var dataId = $(this).data('obatid'); // obatid didapat dari id yang dikirimkan melalui tombol edit
                                $('#seg-modal').load(`./dokter/editDokter.php?id=${dataId}`, function() {
                                    $('#myModal').modal('show');
                                });
                            });
                        });
                    });
                } else if (menu == "menuPasien") {
                    $('.nav-link').removeClass('active')
                    $(this).addClass('active')
                    $('#content').load('./pasien/index.php');
                } else if (menu == "menuJadwal") {
                    $('.nav-link').removeClass('active')
                    $(this).addClass('active')
                    $('#content').load('./jadwalPemeriksaan/index.php');
                } else if (menu == "menuPoliklinik") {
                    $('.nav-link').removeClass('active')
                    $(this).addClass('active')
                    $('#content').load('./poliklinik/index.php', function() {
                        $(document).ready(function() {
                            $('.edit-btn').on('click', function() {
                                var dataId = $(this).data('obatid'); // obatid didapat dari id yang dikirimkan melalui tombol edit
                                $('#seg-modal').load(`./poliklinik/editPoliklinik.php?id=${dataId}`, function() {
                                    $('#myModal').modal('show');
                                });
                            });
                        });
                    });
                }
            })
        })
    </script>

</body>

</html>