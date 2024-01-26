<?php
include("../../../koneksi.php");

$id = $_GET['id'];

$query = "SELECT p.id, p.tgl_periksa, p.catatan, p.biaya_periksa, p.payment_status, dp.keluhan, d.nama as nama_dokter, p3.nama_poli, dp2.id_obat, o.nama_obat, o.kemasan, o.harga as harga_obat 
FROM periksa p
JOIN daftar_poli dp on p.id_daftar_poli = dp.id
JOIN pasien p2 on dp.id_pasien = p2.id
JOIN jadwal_periksa jp on dp.id_jadwal = jp.id
JOIN dokter d on jp.id_dokter = d.id
JOIN poli p3 on d.id_poli = p3.id
join detail_periksa dp2 on dp2.id_periksa = p.id
join obat o on dp2.id_obat = o.id 
WHERE p.id = $id";
$result = mysqli_query($mysqli, $query);

$row = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biaya & Detail Pemeriksaan Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div>
            <div class="col-8 mt-5 mx-auto">
                <div class="card shadow bg-body-tertiary rounded">
                    <div class="card-header mb-3" style="background-color: #48829E;">
                        <h5 class="card-title text-white my-auto">Biaya & Detail Pemeriksaan Dokter</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive px-5soale">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <div class="col-12 text-center">
                                    <form id="editForm" method="POST" action="./updatePayment.php">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="form-group mb-3">
                                            <label for="nama_dokter">Nama Dokter</label>
                                            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $row['nama_dokter'] ? $row['nama_dokter'] : "none"; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama_poli">Poliklinik</label>
                                            <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="<?= $row['nama_poli']; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keluhan">Keluhan Pasien</label>
                                            <input type="text" class="form-control" id="keluhan" name="keluhan" value="<?= $row['keluhan']; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tgl_periksa">Tanggal Periksa</label>
                                            <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl_periksa" value="<?= $row['tgl_periksa']; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="catatan">Catatan Dokter</label>
                                            <textarea class="form-control" id="catatan" name="catatan" style="height: 100px" disabled><?= $row['catatan']; ?></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nama_obat">Obat</label>
                                            <textarea class="form-control" id="catatan" name="catatan" style="height: 100px" disabled><?= $row['nama_obat']; ?> | <?= $row['kemasan']; ?></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="biaya_periksa">Rincian Biaya Periksa</label>
                                            <textarea class="form-control" name="catatan" style="height: 100px" disabled>
                                            <?php echo "\n" . 'Biaya Periksa Dokter: Rp 150000' . "\n" .
                                                'Harga Obat: Rp' . $row['harga_obat'] . "\n" .
                                                'Total: Rp ' . $row['biaya_periksa'] . "\n";
                                            ?>
                                            </textarea>
                                        </div>

                                        <?php
                                        // Check the payment_status and display buttons accordingly
                                        if ($row['payment_status'] === 'PAID') {
                                            echo '<button id="cetakBtn" class="btn btn-success mt-3" onclick="printReceipt()">Cetak</button>';
                                            echo '<script>document.getElementById("bayarBtn").style.display = "none";</script>';
                                        } else {
                                            echo '<input type="submit" name="submit" id="bayarBtn" value="Bayar" class="btn btn-info mt-3">';
                                            echo '<script>document.getElementById("cetakBtn").style.display = "none";</script>';
                                        }
                                        ?>

                                    </form>
                                </div>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function printReceipt() {
            // Add the logic for printing the receipt here
            // You can use window.print() or any other printing mechanism
            // For simplicity, a placeholder alert is used
            alert("Printing Receipt...");
        }
    </script>
</body>

</html>