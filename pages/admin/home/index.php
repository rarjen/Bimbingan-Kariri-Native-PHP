<?php
include("../../../koneksi.php");

function queryTotal($mysqli, $tableName): string
{
    $data = mysqli_query($mysqli, "SELECT COUNT(*) AS total_data FROM $tableName");
    $result = mysqli_fetch_assoc($data);
    $totalData = $result['total_data'];
    return $totalData;
}
?>

<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-solid fa-users" style="color: #ffffff;"></i></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pasien</span>
                            <span class="info-box-number">
                                <?= queryTotal($mysqli, "pasien"); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
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

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-solid fa-tablets"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Obat</span>
                            <span class="info-box-number"><?= queryTotal($mysqli, "obat"); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-solid fa-clock" style="color: #ffffff"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jadwal Pemeriksaan</span>
                            <span class="info-box-number"><?= queryTotal($mysqli, "jadwal_periksa"); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
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