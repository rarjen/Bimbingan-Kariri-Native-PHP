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
                <form action="obat/tambahObat.php" method="POST">
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                    </div>
                    <div class="form-group">
                        <label for="kemasan">Kemasan</label>
                        <input type="text" class="form-control" id="kemasan" name="kemasan" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="seg-modal">

</div>


<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manajemen Data Obat</h3>

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
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM obat";
                                $result = mysqli_query($mysqli, $query);
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_obat']; ?></td>
                                        <td><?php echo $row['kemasan'] ?></td>
                                        <td><?php echo $row['harga'] ?></td>
                                        <td>
                                            <button type='button' class='btn btn-sm btn-warning edit-btn' data-obatid='<?php echo $row['id']; ?>'>Edit</button>
                                            <a href='obat/hapusObat.php?id=<?php echo $row['id']; ?>' class='btn btn-sm btn-danger' onclick='return confirm("Anda yakin ingin hapus?");'>Hapus</a>
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