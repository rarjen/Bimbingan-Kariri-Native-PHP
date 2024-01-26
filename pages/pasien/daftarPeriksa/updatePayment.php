<?php
include("../../../koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Add your update query here
    $updateQuery = "UPDATE periksa SET status_payment = 'WAITING' WHERE id = $id";
    $updateResult = mysqli_query($mysqli, $updateQuery);

    if ($updateResult) {
        echo json_encode(['success' => true, 'message' => 'Pembayaran sukses, harap tunggu konfirmasi.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Pembayaran tidak dapat diproses, silakan coba ulang.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
