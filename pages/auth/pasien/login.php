<?php
session_start();
include_once("../../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $no_ktp = $_POST["no_ktp"];
    $password = $_POST["password"];

    $queryCheckExist = "SELECT * FROM pasien WHERE no_ktp = ?";
    $stmt = mysqli_prepare($mysqli, $queryCheckExist);
    mysqli_stmt_bind_param($stmt, "s", $no_ktp);
    mysqli_stmt_execute($stmt);
    $resultCheckExist = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultCheckExist) <= 0) {
        echo "<script>alert(`Pasien belum terdaftar, silakan register!`)</script>";
        echo "<meta http-equiv='refresh' content='0; url=register.php'>";
        die();
    } else {
        $row = mysqli_fetch_assoc($resultCheckExist);

        if ($row['no_ktp'] == $no_ktp && $row['password'] == $password) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["nama"];
            $_SESSION["no_rm"] = $row["no_rm"];
            $_SESSION["akses"] = "pasien";
            echo "<script>alert(`Login Berhasil`)</script>";
            echo "<meta http-equiv='refresh' content='0; url=../../../index.php'>";
            die();
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper vh-100 d-flex flex-column justify-content-center align-items-center" style="background-color: #48829E;">
        <div class="cards border px-5 py-3 rounded-lg" style="width: 30%; background-color: white;">
            <div class="text-group my-4 d-flex flex-column justify-content-center align-items-center">
                <img src="../../../images/hospital-health-clinic-svgrepo-com.svg" style="width: 20%;" class="text-center w-25 my-3" alt="">
                <h3 class="text-center text-capitalize">Login</h3>
            </div>
            <form action="" method="POST">
                <div class="form-group my-4 gap-3">
                    <input type="text" class="w-100 px-4 py-3 my-3 rounded-lg border page-link" id="nik" placeholder="NIK" autocomplete="off" name="no_ktp" required>
                    <input type="password" class="w-100 px-4 py-3 my-3 rounded-lg border page-link" id="password" placeholder="Password" name="password" required>
                    <a href="#" class="fst-normal link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Lupa Password?</a>
                </div>
                <p class="text-secondary my-5">Gunakan akun anda yang sudah anda daftarkan sebelumnya untuk bisa melakukan login</p>
                <div class="form-group d-flex justify-content-between align-items-center">
                    <a href="../../../pages/auth/pasien/register.php" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Buat Akun</a>
                    <button type="submit" class="w-25 btn btn-block rounded-2 text-white" style="background-color: #48829E;">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3 class=" mt-3"/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0116028855.js" crossorigin="anonymous"></script>
</body>

</html>