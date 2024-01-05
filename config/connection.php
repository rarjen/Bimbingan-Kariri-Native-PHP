<?php
require __DIR__ . "/routes.php";

$dbHost = "localhost:3308";
$databaseName = "bk_medic";
$dataBaseUsername = "root";
$databasePassword = "";

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$databaseName", $dataBaseUsername, $databasePassword);
} catch (PDOException $error) {
    die("Database connection failed: " . $error);
}

$connection = mysqli_connect($dbHost, $dataBaseUsername, $databasePassword, $databaseName);

function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function updateDokter($data)
{
    global $connection;

    $id = $data["id"];
    $nama = mysqli_real_escape_string($connection, $data["nama"]);
    $alamat = mysqli_real_escape_string($connection, $data["alamat"]);
    $no_hp = mysqli_real_escape_string($connection, $data["no_hp"]);

    $query = "UPDATE dokter SET nama = '$nama', alamat = '$alamat', no_hp = '$no_hp' WHERE id = $id ";

    if (mysqli_query($connection, $query)) {
        return mysqli_affected_rows($connection); // Return the number of affected rows
    } else {
        // Handle the error
        echo "Error updating record: " . mysqli_error($connection);
        return -1; // Or any other error indicator
    }
}

// Jadwal Periksa Sisi Dokter
function createJadwalPeriksa($data)
{
    try {
        global $connection;

        $id_dokter = $data["id_dokter"];
        $hari = mysqli_real_escape_string($connection, $data["hari"]);
        $jam_mulai = mysqli_real_escape_string($connection, $data["jam_mulai"]);
        $jam_selesai = mysqli_real_escape_string($connection, $data["jam_selesai"]);

        $query = "INSERT INTO jadwal_periksa VALUES ('', '$id_dokter', '$hari', '$jam_mulai', '$jam_selesai')";

        if (mysqli_query($connection, $query)) {
            return mysqli_affected_rows($connection); // Return the number of affected rows
        } else {
            // Handle the error
            echo "Error updating record: " . mysqli_error($connection);
            return -1; // Or any other error indicator
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
}

function updateJadwalPeriksa($data, $id)
{
    try {
        global $connection;

        $hari = mysqli_real_escape_string($connection, $data["hari"]);
        $jam_mulai = mysqli_real_escape_string($connection, $data["jam_mulai"]);
        $jam_selesai = mysqli_real_escape_string($connection, $data["jam_selesai"]);

        $query = "UPDATE jadwal_periksa SET hari = '$hari', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai' WHERE id = $id ";

        if (mysqli_query($connection, $query)) {
            return mysqli_affected_rows($connection); // Return the number of affected rows
        } else {
            // Handle the error
            echo "Error updating record: " . mysqli_error($connection);
            return -1; // Or any other error indicator
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
        die();
    }
}

function destroyJadwalPeriksa($id)
{
    try {
        global $connection;

        $query = "DELETE FROM jadwal_periksa WHERE id = $id";

        if (mysqli_query($connection, $query)) {
            return mysqli_affected_rows($connection); // Return the number of affected rows
        } else {
            // Handle the error
            echo "Error updating record: " . mysqli_error($connection);
            return -1; // Or any other error indicator
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
}

function createPeriksa($data)
{
    global $connection;
    // ambil data dari tiap elemen dalam form
    $tgl_periksa = htmlspecialchars($data["tgl_periksa"]);
    $catatan = htmlspecialchars($data["catatan"]);


    // query insert data
    $query = "INSERT INTO periksa
                VALUES
                ('', '$tgl_periksa','$catatan');
            ";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function createDetailPeriksa($data)
{
    global $connection;
    // ambil data dari tiap elemen dalam form
    $tgl_periksa = htmlspecialchars($data["tgl_periksa"]);
    $catatan = htmlspecialchars($data["catatan"]);


    // query insert data
    $query = "INSERT INTO detail_periksa
                VALUES
                ('', '$tgl_periksa','$catatan');
            ";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function registerPoli($data)
{
    global $pdo;

    try {
        $id_pasien = $data["id_pasien"];
        $id_jadwal = $data["id_jadwal"];
        $keluhan = $data["keluhan"];
        $no_antrian = getLatestQueue($id_jadwal, $pdo) + 1;
        $status_periksa = 0;

        $query = "INSERT INTO daftar_poli VALUES (NULL, :id_pasien, :id_jadwal, :keluhan, :no_antrian, :status_periksa)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_pasien', $id_pasien);
        $stmt->bindParam(':id_jadwal', $id_jadwal);
        $stmt->bindParam(':keluhan', $keluhan);
        $stmt->bindParam(':no_antrian', $no_antrian);
        $stmt->bindParam(':status_periksa', $status_periksa);


        if ($stmt->execute()) {
            return $stmt->rowCount(); // Return the number of affected rows
        } else {
            // Handle the error
            echo "Error updating record: " . $stmt->errorInfo()[2];
            return -1; // Or any other error indicator
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }
}

function getLatestQueue($id_jadwal, $pdo)
{
    // Ambil nomor antrian terbaru untuk jadwal tertentu
    $latestNoAntrian = $pdo->prepare("SELECT MAX(no_antrian) as max_no_antrian FROM daftar_poli WHERE id_jadwal = :id_jadwal");
    $latestNoAntrian->bindParam(':id_jadwal', $id_jadwal);
    $latestNoAntrian->execute();

    $row = $latestNoAntrian->fetch();
    return $row['max_no_antrian'] ? $row['max_no_antrian'] : 0;
}
