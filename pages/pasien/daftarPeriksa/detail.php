<?php
include("../../../koneksi.php");

$id = $_GET['id'];

$query = "SELECT dp.id, dp.id_pasien, pl.nama_poli, d.nama, jp.hari, jp.jam_mulai, jp.jam_selesai, dp.no_antrian
FROM daftar_poli AS dp
JOIN pasien AS p ON dp.id_pasien = p.id
JOIN jadwal_periksa AS jp ON dp.id_jadwal = jp.id
JOIN dokter AS d ON jp.id_dokter = d.id
JOIN poli AS pl ON d.id_poli = pl.id
WHERE dp.id = $id;";
$result = mysqli_query($mysqli, $query);

$row = mysqli_fetch_assoc($result);
?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Detail Periksa</h5>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="obat/updateObat.php">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama_poliklinik">Nama Poliklinik</label>
                        <input type="text" class="form-control" id="nama_poliklinik" name="nama_poliklinik" value="<?= $row['nama_poli']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama_dokter">Nama Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $row['nama']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" class="form-control" id="hari" name="hari" value="<?= $row['hari']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= $row['jam_mulai']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= $row['jam_selesai']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="no_antrian">No Antrian</label>
                        <input type="text" class="form-control" id="no_antrian" name="no_antrian" value="<?= $row['no_antrian']; ?>" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>