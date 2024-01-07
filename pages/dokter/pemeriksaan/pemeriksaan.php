<div id="seg-modal">

</div>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">List Pemeriksaan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Jadwal</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jadwal</h3>
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
                                            WHERE d.id = 8;";
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
                                                <a href="pemeriksaan/editPeriksa.php/<?= $row["id"]; ?>">
                                                    <button type='button' class='btn btn-sm btn-info edit-btn'>Periksa</button>
                                                </a>
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