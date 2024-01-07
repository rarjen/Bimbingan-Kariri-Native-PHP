<?php
include_once '../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $id_dokter = $_SESSION[$id];
    $id_dokter = 8;
    $hari = $_POST["hari"];
    $jam_mulai = $_POST["jam_mulai"];
    $jam_selesai = $_POST["jam_selesai"];

    $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($stmt, "isss", $id_dokter, $hari, $jam_mulai, $jam_selesai);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>';
        echo 'alert("Data jadwal berhasil ditambahkan!");';
        echo 'window.location.href = "../../../index.php";';
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
