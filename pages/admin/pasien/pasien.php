<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pasien</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>NIK</th>
                                    <th>No Hp</th>
                                    <th>No RM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM pasien";
                                $result = mysqli_query($mysqli, $query);
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['alamat'] ?></td>
                                        <td><?php echo $row['no_ktp'] ?></td>
                                        <td><?php echo $row['no_hp'] ?></td>
                                        <td><?php echo $row['no_rm'] ?></td>
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