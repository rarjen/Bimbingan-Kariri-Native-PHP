<?php
session_start();

$id_dokter = $_SESSION['id'];

?>

<div id="seg-modal">

</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemeriksaan Pasien</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Keluhan</th>
                                    <th>Antrian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT p.id, p.id_daftar_poli, p2.nama as nama_pasien, p.tgl_periksa, p.catatan, p.biaya_periksa, dp.keluhan, dp.no_antrian, jp.id_dokter, d.nama, p3.nama_poli
                                          FROM periksa p
                                          JOIN daftar_poli dp on p.id_daftar_poli = dp.id
                                          JOIN pasien p2 on dp.id_pasien = p2.id
                                          JOIN jadwal_periksa jp on dp.id_jadwal = jp.id
                                          JOIN dokter d on jp.id_dokter = d.id
                                          JOIN poli p3 on d.id_poli = p3.id
                                          WHERE d.id = $id_dokter;";
                                $result = mysqli_query($mysqli, $query);

                                $no = 1;

                                $rowCount = mysqli_num_rows($result);

                                if ($rowCount > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nama_pasien']; ?></td>
                                            <td><?php echo $row['tgl_periksa'] ? $row['tgl_periksa'] : "Belum periksa"; ?></td>
                                            <td><?php echo $row['keluhan']; ?></td>
                                            <td><?php echo $row['no_antrian']; ?></td>
                                            <td>
                                                <?php
                                                // Tambahkan pengecekan tanggal disini
                                                if ($row['tgl_periksa'] != null) {
                                                    echo '<a href="pemeriksaan/detailPeriksa.php?id=' . $row['id'] . '" class="btn btn-sm btn-success">Detail</a>';
                                                } else {
                                                    echo '<a href="pemeriksaan/editPeriksa.php?id=' . $row['id'] . '" class="btn btn-sm btn-info">Periksa</a>';
                                                }
                                                ?>
                                            </td>
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