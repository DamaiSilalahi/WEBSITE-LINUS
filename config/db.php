<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Sesuaikan dengan konfigurasi WAMP Anda
$dbname = 'linus_realtime';

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
