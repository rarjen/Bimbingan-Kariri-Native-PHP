<?php
include("../../../koneksi.php");

$id = $_GET['id']; //mengambil id user yang ingin diubah

//menampilkan user berdasarkan id
$data = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa WHERE id = '$id'");
$row = mysqli_fetch_assoc($data);
?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="jadwal/updateJadwal.php">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select class="form-control" id="hari" name="hari" required disabled>
                            <option value="Senin" <?php if ($row['hari'] == 'Senin') echo 'selected'; ?>>Senin</option>
                            <option value="Selasa" <?php if ($row['hari'] == 'Selasa') echo 'selected'; ?>>Selasa</option>
                            <option value="Rabu" <?php if ($row['hari'] == 'Rabu') echo 'selected'; ?>>Rabu</option>
                            <option value="Kamis" <?php if ($row['hari'] == 'Kamis') echo 'selected'; ?>>Kamis</option>
                            <option value="Jumat" <?php if ($row['hari'] == 'Jumat') echo 'selected'; ?>>Jumat</option>
                            <option value="Sabtu" <?php if ($row['hari'] == 'Sabtu') echo 'selected'; ?>>Sabtu</option>
                            <option value="Minggu" <?php if ($row['hari'] == 'Minggu') echo 'selected'; ?>>Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= $row['jam_mulai']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= $row['jam_selesai']; ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="status">status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="AKTIF" <?php if ($row['status'] == 'AKTIF') echo 'selected'; ?>>AKTIF</option>
                            <option value="TIDAK AKTIF" <?php if ($row['status'] == 'TIDAK AKTIF') echo 'selected'; ?>>TIDAK AKTIF</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>