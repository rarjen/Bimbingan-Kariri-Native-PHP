<?php
$dbHost = "localhost:3308";
$databaseName = "bk_medic";
$dataBaseUsername = "root";
$databasePassword = "";


$mysqli = mysqli_connect(
    $dbHost,
    $dataBaseUsername,
    $databasePassword,
    $databaseName
);

if (!$mysqli) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
