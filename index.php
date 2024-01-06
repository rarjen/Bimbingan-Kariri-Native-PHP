<?php
session_start();

$show = false;
$redirect = null;

if (isset($_SESSION['login'])) {
    $show = true;
    $redirect = $_SESSION['akses'];

    if ($redirect == "admin") {
        echo "<meta http-equiv='refresh' content='0; url=pages/admin/index.php'>";
    } else if ($redirect == "pasien") {
        echo "<meta http-equiv='refresh' content='0; url=pages/pasien/index.php'>";
    } else {
        echo "<meta http-equiv='refresh' content='0; url=pages/dokter/index.php'>";
    }
}

if ($show) {
    include_once "./components/homePage.php";
} else {
    include_once "./components/homePage.php";
}
