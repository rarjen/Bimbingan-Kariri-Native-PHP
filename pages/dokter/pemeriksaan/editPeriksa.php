<?php
include("../../../koneksi.php");

$id = $_GET['id'];

$obat = query("SELECT * FROM obat");

$query = "SELECT p.id, p.id_daftar_poli, p2.nama nama_pasien, p.tgl_periksa, p.catatan, p.biaya_periksa, dp.keluhan, dp.no_antrian, jp.id_dokter, d.nama, p3.nama_poli
FROM periksa p
JOIN daftar_poli dp on p.id_daftar_poli = dp.id
JOIN pasien p2 on dp.id_pasien = p2.id
JOIN jadwal_periksa jp on dp.id_jadwal = jp.id
JOIN dokter d on jp.id_dokter = d.id
JOIN poli p3 on d.id_poli = p3.id
WHERE p.id = $id";
$result = mysqli_query($mysqli, $query);

$row = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Periksa Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<body>
    <div class="container">
        <div>
            <div class="col-8 mt-5 mx-auto">
                <div class="card shadow bg-body-tertiary rounded">
                    <div class="card-header mb-3" style="background-color: #48829E;">
                        <h5 class="card-title text-white my-auto">Periksa Pasien</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive px-5soale">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <div class="col-12 text-center">
                                    <form id="editForm" method="POST" action="./updatePeriksa.php">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <div class="form-group mb-3">
                                            <label for="nama_pasien">Nama Pasien</label>
                                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="<?= $row['nama_pasien']; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keluhan">Keluhan</label>
                                            <input type="text" class="form-control" id="keluhan" name="keluhan" value="<?= $row['keluhan']; ?>" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="tgl_periksa">Tanggal Periksa</label>
                                            <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl_periksa" value="<?= $row['tgl_periksa']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="keluhan">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" style="height: 100px" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="obat">Obat</label>
                                            <select class="js-example-basic-multiple form-control" name="obat">
                                                <?php foreach ($obat as $obats) : ?>
                                                    <option value="<?= $obats['id']; ?>|<?= $obats['harga'] ?>"><?= $obats['nama_obat']; ?> - <?= $obats['kemasan']; ?> - Rp.<?= $obats['harga']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="submit" name="submit" value="Simpan" class="btn btn-primary mt-3">
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
</body>

</html>