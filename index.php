<?php
session_start();

$show = false;
$redirect = null;

if (isset($_SESSION['login'])) {
    $show = true;
    $redirect = $_SESSION['akses'];
}

if ($show) {
    include_once "./components/homePage.php";
} else {
    include_once "./components/homePage.php";
}
