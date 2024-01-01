<?php
include("../../../koneksi.php");

$id = $_GET['id']; //mengambil id user yang ingin diubah

//menampilkan user berdasarkan id
$data = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id = '$id'");
$row = mysqli_fetch_assoc($data);
?>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Dokter</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="pages/admin/dokter/updateDokter.php">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <div class="form-group">
                        <label for="nama_dokter">Nama Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $row['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row['alamat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $row['no_hp']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="poliklinik">Poliklinik</label>
                        <div class="form-group">
                            <label for="poliklinik">Poliklinik</label>
                            <select class="form-control" id="poliklinik" name="poliklinik" required>
                                <?php
                                $queryPoli = "SELECT * FROM poli";
                                $resultPoli = mysqli_query($mysqli, $queryPoli);
                                while ($rowPoli = mysqli_fetch_assoc($resultPoli)) {
                                    echo "<option value='{$rowPoli['id']}'>{$rowPoli['nama_poli']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>