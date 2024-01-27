<?php
include("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $status = $_POST["status"];

    $queryCheckExist = "SELECT isUsed FROM jadwal_periksa WHERE id = '$id'";
    $resultCheckExist = mysqli_query($mysqli, $queryCheckExist);

    if ($resultCheckExist) {
        $rowCheckExist = mysqli_fetch_assoc($resultCheckExist);

        // if ($rowCheckExist['isUsed'] == 1) {
        //     echo '<script>alert("Jadwal tidak dapat diubah karena sudah digunakan.");</script>';
        //     echo "<meta http-equiv='refresh' content='0; url=../../../index.php'>";
        // } else {

        // }

        $query = "UPDATE jadwal_periksa SET
        status = ?
        WHERE id = ?";

        $stmt = mysqli_prepare($mysqli, $query);

        mysqli_stmt_bind_param($stmt, "si", $status, $id);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
            echo '<script>';
            echo 'alert("Data jadwal berhasil diubah!");';
            echo 'window.location.href = "../../../index.php";';
            echo '</script>';
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($mysqli);
}
