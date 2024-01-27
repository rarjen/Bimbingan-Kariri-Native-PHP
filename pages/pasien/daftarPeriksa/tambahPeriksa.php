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
    $no_antrian = getLatestQueue($mysqli, $id_jadwal) + 1;
    $isUsed = 1;

    // Query untuk menambahkan data dokter ke dalam tabel
    $query = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = mysqli_prepare($mysqli, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "iisi", $id_pasien, $id_jadwal, $keluhan, $no_antrian);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Mendapatkan id terakhir yang dimasukkan
        $id_daftar_poli = mysqli_insert_id($mysqli);

        // Query untuk menambahkan data ke dalam tabel periksa
        $queryPeriksa = "INSERT INTO periksa (id_daftar_poli) VALUES (?)";
        $stmtPeriksa = mysqli_prepare($mysqli, $queryPeriksa);

        // Menyimpan data ke dalam tabel periksa
        mysqli_stmt_bind_param($stmtPeriksa, "i", $id_daftar_poli);

        $queryUpdate = "UPDATE jadwal_periksa SET
        isUsed = ?
        WHERE id = $id_jadwal";

        $stmtUpdate = mysqli_prepare($mysqli, $queryUpdate);

        // Update isUsed
        mysqli_stmt_bind_param($stmtUpdate, "i", $isUsed);

        // Mengganti nilai $ dengan nilai sesuai kebutuhan Anda
        // Eksekusi query periksa
        if (mysqli_stmt_execute($stmtPeriksa)) {
            echo '<script>';
            echo "<script>alert(`Berhasil Daftar Poli dan Pemeriksaan`)</script>";
            echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
            echo '</script>';
            exit();
        } else {
            // Jika terjadi kesalahan pada query periksa
            echo "Error: " . $queryPeriksa . "<br>" . mysqli_error($mysqli);
        }

        // Tutup statement periksa
        mysqli_stmt_close($stmtPeriksa);
    } else {
        // Jika terjadi kesalahan pada query daftar_poli
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    // Tutup statement daftar_poli
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($mysqli);
