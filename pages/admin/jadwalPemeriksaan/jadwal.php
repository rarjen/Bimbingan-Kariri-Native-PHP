<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jadwal Pemeriksaan</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Nama Dokter</th>
                                    <th>Nama Poliklinik</th>
                                    <th>Status Periksa</th>
                                    <th>Biaya Periksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT p.id, p.id_daftar_poli, p2.nama as nama_pasien, p.tgl_periksa, p.catatan, p.biaya_periksa, dp.keluhan, dp.no_antrian, jp.id_dokter, d.nama as nama_dokter, p3.nama_poli
                                            FROM periksa p
                                            JOIN daftar_poli dp on p.id_daftar_poli = dp.id
                                            JOIN pasien p2 on dp.id_pasien = p2.id
                                            JOIN jadwal_periksa jp on dp.id_jadwal = jp.id
                                            JOIN dokter d on jp.id_dokter = d.id
                                            JOIN poli p3 on d.id_poli = p3.id";
                                $result = mysqli_query($mysqli, $query);

                                $no = 1;

                                $rowCount = mysqli_num_rows($result);

                                if ($rowCount > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama_pasien']; ?></td>
                                            <td><?php echo $row['nama_dokter']; ?></td>
                                            <td><?php echo $row['nama_poli']; ?></td>
                                            <td><?php echo $row['tgl_periksa'] ? $row['tgl_periksa'] : "Belum periksa"; ?></td>
                                            <td><?php echo $row['biaya_periksa']; ?></td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data yang ditemukan.</td>
                                    </tr>

                                <?php
                                }
                                mysqli_close($mysqli)
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