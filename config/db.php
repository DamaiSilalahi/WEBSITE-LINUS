<?php
$host = 'localhost';
$port = '2309';  // Port default PostgreSQL
$user = 'postgres';  // Ganti dengan username PostgreSQL Anda
$password = 'Intel007';  // Ganti dengan password PostgreSQL Anda
$dbname = 'linus_realtime';  // Nama database PostgreSQL Anda

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    // Set atribut untuk menangani error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
