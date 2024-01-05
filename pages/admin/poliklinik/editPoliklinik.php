<?php
include("../../../koneksi.php");

$id = $_GET['id']; //mengambil id user yang ingin diubah

//menampilkan user berdasarkan id
$data = mysqli_query($mysqli, "SELECT * FROM poli WHERE id = '$id'");
$row = mysqli_fetch_assoc($data);
?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Obat</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="poliklinik/updatePoliklinik.php">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama_poli">Nama Poliklinik</label>
                        <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="<?= $row['nama_poli']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $row['keterangan']; ?>" required>
                    </div>

                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>