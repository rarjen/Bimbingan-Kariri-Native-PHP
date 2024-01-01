<?php
include("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $nama_dokter = $_POST["nama_dokter"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $poliklinik = $_POST["poliklinik"];

    // Query untuk melakukan update data obat
    $query = "UPDATE dokter SET 
        nama = ?, 
        alamat = ?, 
        no_hp = ?, 
        id_poli = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($stmt, "sssii", $nama_dokter, $alamat, $no_hp, $poliklinik, $id);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
        echo '<script>';
        echo 'alert("Data obat berhasil diubah!");';
        echo 'window.location.href = "../../../index.php";';
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }


    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($mysqli);
