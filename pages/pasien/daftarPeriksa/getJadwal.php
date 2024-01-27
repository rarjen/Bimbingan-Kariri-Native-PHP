<?php
include_once("../../../koneksi.php");

$poliId = isset($_GET['poli_id']) ? $_GET['poli_id'] : null;
$status = "AKTIF";

$queryJadwal = "SELECT jadwal_periksa.id, dokter.nama AS nama_dokter, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, jadwal_periksa.status
FROM jadwal_periksa
JOIN dokter ON jadwal_periksa.id_dokter = dokter.id
WHERE dokter.id_poli = ? AND jadwal_periksa.status = ?";

$stmt = mysqli_prepare($mysqli, $queryJadwal);

// Binding parameter
mysqli_stmt_bind_param($stmt, "is", $poliId, $status);

// Eksekusi query
mysqli_stmt_execute($stmt);
$resultJadwal = mysqli_stmt_get_result($stmt);

if ($resultJadwal && mysqli_num_rows($resultJadwal) > 0) {
    while ($rowJadwal = mysqli_fetch_assoc($resultJadwal)) {
        $namaDokter = $rowJadwal['nama_dokter'];
        $hari = $rowJadwal['hari'];
        $jamMulai = $rowJadwal['jam_mulai'];
        $jamSelesai = $rowJadwal['jam_selesai'];
        echo "<option value='{$rowJadwal['id']}'>{$namaDokter} | {$hari} | {$jamMulai} - {$jamSelesai}</option>";
    }
} else {
    // Tidak ada hasil, tampilkan opsi default atau pesan khusus
    echo "<option value='' disabled selected>Data tidak tersedia</option>";
}

// Tutup statement
mysqli_stmt_close($stmt);
