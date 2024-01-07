<?php
session_start();

$no_rm = $_SESSION['no_rm'];
$id_pasien = $_SESSION['id'];
?>

<div class="d-flex">
    <div class="col-4">
        <div class="card border rounded-lg" style="background-color: white; overflow: hidden;">
            <div class="card-header" style="background-color: #48829E;">
                <h3 class="card-title text-white">Daftar Poliklinik</h3>
            </div>
            <form action="daftarPeriksa/tambahPeriksa.php" method="POST" class="py-2 px-3">
                <input type="hidden" value="<?= $id_pasien; ?>" name="id_pasien">
                <div class="form-group my-2">
                    <label for="no_rm">Nomor Rekam Medis</label>
                    <input class="w-100 px-4 rounded-lg border page-link text-dark" type="text" name="no_rm" id="no_rm" placeholder="202312-001" value="<?= $no_rm; ?>" disabled required>
                </div>
                <div class="form-group my-2">
                    <label for="no_rm">Pilih Poliklinik</label>
                    <select class="form-control" id="poliklinik" name="poliklinik" required">
                        <?php
                        $queryPoli = "SELECT * FROM poli";
                        "SELECT MAX(no_antrian) as max_queue FROM daftar_poli WHERE id_jadwal = $id_jadwal";
                        $resultPoli = mysqli_query($mysqli, $queryPoli);
                        while ($rowPoli = mysqli_fetch_assoc($resultPoli)) {
                            echo "<option value='{$rowPoli['id']}'>{$rowPoli['nama_poli']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="no_rm">Pilih Jadwal</label>
                    <select class="form-control" id="jadwal" name="jadwal">
                        <option selected>Open this select menu</option>
                    </select>
                </div>
                <div class="form-floating">
                    <label for="keluhan">Keluhan</label>
                    <textarea class="form-control" placeholder="Tuliskan keluhan anda" id="keluhan" name="keluhan" style="height: 100px"></textarea>
                </div>
                <div class="mt-3 form-group d-flex justify-content-end align-items-center">
                    <button style="background-color: #48829E;" type="submit" class="w-auto px-4 btn btn-block rounded-2 text-white">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-8">
        <div class="card">
            <div class="card-header" style="background-color: #48829E;">
                <h3 class="card-title text-white">Riwayat Pendaftaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Poliklinik</th>
                            <th>Dokter</th>
                            <th>Hari</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Antrian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT dp.id, dp.id_pasien, pl.nama_poli, d.nama, jp.hari, jp.jam_mulai, jp.jam_selesai, dp.no_antrian
                                  FROM daftar_poli AS dp
                                  JOIN pasien AS p ON dp.id_pasien = p.id
                                  JOIN jadwal_periksa AS jp ON dp.id_jadwal = jp.id
                                  JOIN dokter AS d ON jp.id_dokter = d.id
                                  JOIN poli AS pl ON d.id_poli = pl.id
                                  WHERE dp.id_pasien = $id_pasien;";
                        $result = mysqli_query($mysqli, $query);
                        $no = 1;

                        // Menghitung jumlah baris
                        $rowCount = mysqli_num_rows($result);

                        if ($rowCount > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_poli']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['hari']; ?></td>
                                    <td><?= $row['jam_mulai']; ?></td>
                                    <td><?= $row['jam_selesai']; ?></td>
                                    <td><?= $row['no_antrian']; ?></td>
                                    <td>
                                        <a href="daftarPeriksa/detail.php/<?= $row["id"]; ?>">
                                            <button type='button' class='btn btn-sm btn-info edit-btn'>Detail</button>
                                        </a>
                                    </td>
                                </tr>

                            <?php
                            }
                        } else {
                            // Jika tidak ada data
                            ?>

                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data yang ditemukan.</td>
                            </tr>

                        <?php
                        }
                        mysqli_close($mysqli);
                        ?>

                    </tbody>
                    <script>
                    </script>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>