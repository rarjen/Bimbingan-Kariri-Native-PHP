<?php
include '../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Query untuk menambahkan data obat ke dalam tabel
    $query = "INSERT INTO poli (nama_poli, keterangan) VALUES (?, ?)";

    $stmt = mysqli_prepare($mysqli, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "ss", $nama_poli, $keterangan);

    // if ($koneksi->query($query) === TRUE) {
    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
        // header("Location: ../../index.php");
        // exit();
        echo '<script>';
        echo 'alert("Data poliklinik berhasil ditambahkan!");';
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
