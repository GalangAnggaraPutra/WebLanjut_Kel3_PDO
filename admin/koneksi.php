<?php
try {
    $host = "localhost";
    $dbname = "tekom2a";
    $username = "root";
    $password = "";

    // Set opsi PDO
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>