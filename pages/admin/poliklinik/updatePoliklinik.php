<?php

include("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Query untuk melakukan update data obat
    $query = "UPDATE poli SET 
        nama_poli = ?, 
        keterangan = ?
        WHERE id = ?";

    // Persiapkan statement
    $stmt = mysqli_prepare($mysqli, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "ssi", $nama_poli, $keterangan, $id);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
        echo '<script>';
        echo 'alert("Data poli berhasil diubah!");';
        echo 'window.location.href = "../../../index.php";';
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
