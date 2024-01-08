<?php
include("../../../koneksi.php");

$hargaPeriksaDokter = 150000;
$totalBiayaObat = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $id_detail_periksa = $_POST["id_detail_periksa"];
    $tgl_periksa = $_POST["tgl_periksa"];
    $catatan = $_POST["catatan"];

    $obatData = explode('|', $_POST["obat"]);
    $idObat = $obatData[0];
    $hargaObat = $obatData[1];

    $biayaPeriksa = $hargaPeriksaDokter + $hargaObat;

    $query = "UPDATE periksa SET 
        tgl_periksa = ?, 
        catatan = ?,
        biaya_periksa = ?
        WHERE id = ?";

    $stmt = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($stmt, "ssii", $tgl_periksa, $catatan, $biayaPeriksa, $id);

    if (mysqli_stmt_execute($stmt)) {

        $queryCreateDetailPeriksa = "UPDATE detail_periksa SET id_obat = ? WHERE id_periksa = ?";
        $stmtDetailPeriksa = mysqli_prepare($mysqli, $queryCreateDetailPeriksa);

        // Mengikat parameter
        mysqli_stmt_bind_param($stmtDetailPeriksa, "ii", $idObat, $id);

        // Menjalankan kueri
        if (mysqli_stmt_execute($stmtDetailPeriksa)) {
            echo '<script>';
            echo 'alert("Periksa berhasil!");';
            echo 'window.location.href = "../../../index.php";';
            echo '</script>';
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan error
            echo "Error: " . $queryCreateDetailPeriksa . "<br>" . mysqli_error($mysqli);
        }
        mysqli_stmt_close($stmtDetailPeriksa);
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
