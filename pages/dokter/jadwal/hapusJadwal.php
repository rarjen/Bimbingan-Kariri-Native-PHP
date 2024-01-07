<?php
include '../../../koneksi.php';
$id = $_GET['id'];

// Query untuk mengecek nilai isUsed
$queryCheckExist = "SELECT isUsed FROM jadwal_periksa WHERE id = '$id'";
$resultCheckExist = mysqli_query($mysqli, $queryCheckExist);

// Memeriksa apakah query berhasil dijalankan
if ($resultCheckExist) {
    $rowCheckExist = mysqli_fetch_assoc($resultCheckExist);

    // Memeriksa nilai isUsed
    if ($rowCheckExist['isUsed'] == 1) {
        // Jika isUsed = 1, jadwal tidak dapat dihapus
        echo '<script>alert("Jadwal tidak dapat dihapus karena sudah digunakan.");</script>';
        echo "<meta http-equiv='refresh' content='0; url=../../../index.php'>";
        exit();
    } else {
        // Jika isUsed = 0, lanjutkan dengan proses penghapusan
        $queryDelete = "DELETE FROM jadwal_periksa WHERE id = '$id'";
        $resultDelete = mysqli_query($mysqli, $queryDelete);

        if ($resultDelete) {
            echo '<script>alert("Jadwal berhasil dihapus.");</script>';
        } else {
            echo "Error: " . $queryDelete . "<br>" . mysqli_error($mysqli);
        }

        // Redirect ke halaman index setelah penghapusan
        echo "<meta http-equiv='refresh' content='0; url=../../../index.php'>";
        exit();
    }
} else {
    echo "Error: " . $queryCheckExist . "<br>" . mysqli_error($mysqli);
}

// Tutup koneksi
mysqli_close($mysqli);
