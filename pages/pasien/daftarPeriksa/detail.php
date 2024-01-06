<?php

include_once("../../../koneksi.php");

$urlParts = explode('/', $_SERVER['REQUEST_URI']);
$id = end($urlParts);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="p-2">
        <h5>Detail Pendaftaran Poli</h5>
        <div class="card">
            <div class="card-header mb-3" style="background-color: #48829E;">
                <h5 class="card-title text-white">Detail</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <tbody>
                        <?php
                        $query = "SELECT dp.id, dp.id_pasien, pl.nama_poli, d.nama, jp.hari, jp.jam_mulai, jp.jam_selesai, dp.no_antrian
                                    FROM daftar_poli AS dp
                                    JOIN pasien AS p ON dp.id_pasien = p.id
                                    JOIN jadwal_periksa AS jp ON dp.id_jadwal = jp.id
                                    JOIN dokter AS d ON jp.id_dokter = d.id
                                    JOIN poli AS pl ON d.id_poli = pl.id
                                    WHERE dp.id = $id;";
                        $result = mysqli_query($mysqli, $query);

                        $row = mysqli_fetch_assoc($result);

                        if ($row) {

                        ?>
                            <div class="col-12 text-center">
                                <h6>Nama Poliklinik</h6>
                                <p><?= $row['nama_poli']; ?></p>
                                <hr>
                                <h6>Nama Dokter</h6>
                                <p><?= $row['nama']; ?></p>
                                <hr>
                                <h6>Hari</h6>
                                <p><?= $row['hari']; ?></p>
                                <hr>
                                <h6>Jam Mulai</h6>
                                <p><?= $row['jam_mulai']; ?></p>
                                <hr>
                                <h6>Jam Selesai</h6>
                                <p><?= $row['jam_selesai']; ?></p>
                                <hr>
                                <h6>No Antrian</h6>
                                <p><?= $row['no_antrian']; ?></p>
                            </div>
                        <?php
                        } else {
                            // Data tidak ditemukan atau terjadi kesalahan
                            echo "Data tidak ditemukan atau terjadi kesalahan.";
                        }
                        mysqli_close($mysqli);
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>