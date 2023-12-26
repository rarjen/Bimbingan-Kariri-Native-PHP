<?php
include '../../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_dokter = $_POST["nama_dokter"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $poliklinik = $_POST["poliklinik"];

    // Query untuk menambahkan data dokter ke dalam tabel
    $query = "INSERT INTO dokter (nama, alamat, no_hp, id_poli) VALUES (?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = mysqli_prepare($mysqli, $query);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "sssi", $nama_dokter, $alamat, $no_hp, $poliklinik);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
        echo '<script>
    ';
        echo 'alert("Data dokter berhasil ditambahkan!");';
        echo 'window.location.href = "./index.php";';
        echo '
</script>';
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
