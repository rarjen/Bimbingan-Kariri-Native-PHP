<?php

session_start();

$id_dokter = $_SESSION["id"];

include("../../../koneksi.php");

function queryTotal($mysqli, $tableName): string
{
    $data = mysqli_query($mysqli, "SELECT COUNT(*) AS total_data FROM $tableName");
    $result = mysqli_fetch_assoc($data);
    $totalData = $result['total_data'];
    return $totalData;
}

function queryPeriksa($mysqli, $tableName, $id)
{
    $queryDetail = "SELECT COUNT(*) AS jumlah_data
    FROM $tableName p
    JOIN daftar_poli dp ON p.id_daftar_poli = dp.id
    JOIN pasien p2 ON dp.id_pasien = p2.id
    JOIN jadwal_periksa jp ON dp.id_jadwal = jp.id
    JOIN dokter d ON jp.id_dokter = d.id
    JOIN poli p3 ON d.id_poli = p3.id
    WHERE d.id = $id";

    $data = mysqli_query($mysqli, $queryDetail);

    if ($data) {
        $result = mysqli_fetch_assoc($data);
        $totalData = $result['jumlah_data'];
        return $totalData;
    } else {
        // Tambahkan penanganan kesalahan jika query gagal
        echo "Error: " . mysqli_error($mysqli);
        return false;
    }
}

function queryJadwal($mysqli, $tableName, $id)
{
    $queryDetail = "SELECT COUNT(*) AS jumlah_data
                    FROM $tableName t
                    WHERE t.id_dokter = $id";

    $data = mysqli_query($mysqli, $queryDetail);

    if ($data) {
        $result = mysqli_fetch_assoc($data);
        $totalData = $result['jumlah_data'];
        return $totalData;
    } else {
        // Tambahkan penanganan kesalahan jika query gagal
        echo "Error: " . mysqli_error($mysqli);
        return false;
    }
}

?>

<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-solid fa-stethoscope" style="color: #ffffff;"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Dokter</span>
                            <span class="info-box-number"><?= queryTotal($mysqli, "dokter"); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-solid fa-clock" style="color: #ffffff"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pemeriksaan Saya</span>
                            <span class="info-box-number"><?= queryPeriksa($mysqli, "periksa", $id_dokter); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-solid fa-calendar" style="color: #ffffff;"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jadwal Saya</span>
                            <span class="info-box-number"><?= queryJadwal($mysqli, "jadwal_periksa", $id_dokter); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-solid fa-hospital" style="color: #ffffff;"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Poliklinik</span>
                            <span class="info-box-number"><?= queryTotal($mysqli, "poli"); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->