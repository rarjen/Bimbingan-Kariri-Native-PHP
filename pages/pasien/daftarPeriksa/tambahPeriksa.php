<?php
session_start();
include("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function getLatestQueue($mysqli, $id_jadwal)
    {
        $queryLatestQueue = mysqli_query($mysqli, "SELECT MAX(no_antrian) as max_queue FROM daftar_poli WHERE id_jadwal = $id_jadwal");
        $resultLatestQueue = mysqli_fetch_assoc($queryLatestQueue);
        $latestQueue = $resultLatestQueue['max_queue'];
        return $latestQueue;
    }

    $id_pasien = $_SESSION["id"];
    $id_jadwal = $_POST["jadwal"];
    $keluhan = $_POST["keluhan"];
    $no_antrian = getLatestQueue($mysqli, $id_jadwal);

    // Query untuk menambahkan data dokter ke dalam tabel
    $query = "INSERT INTO dokter (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = mysqli_prepare($mysqli, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "iisi", $id_pasien, $id_jadwal, $keluhan, $no_antrian);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
        echo '<script>';
        echo "<script>alert(`Berhasil Daftar Poli`)</script>";
        echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($mysqli);
