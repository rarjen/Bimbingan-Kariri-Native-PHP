<!-- Modal Tambah Data Obat -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah data obat disini -->
                <form action="poliklinik/tambahPoliklinik.php" method="POST">
                    <div class="form-group">
                        <label for="nama_poli">Nama Poliklinik</label>
                        <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="seg-modal">

</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manajemen Data Poliklinik</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Poli</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM poli";
                                $result = mysqli_query($mysqli, $query);
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_poli']; ?></td>
                                        <td><?php echo $row['keterangan'] ?></td>
                                        <td>
                                            <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid='<?php echo $row['id']; ?>'>Edit</button>
                                            <a href='poliklinik/hapusPoliklinik.php?id=<?php echo $row['id']; ?>' class='btn btn-sm btn-danger' onclick='return confirm("Anda yakin ingin hapus?");'>Hapus</a>
                                        </td>
                                    </tr>
                                <?php } // Add this closing bracket
                                mysqli_close($mysqli);
                                ?>
                            </tbody>
                            <script>
                            </script>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->