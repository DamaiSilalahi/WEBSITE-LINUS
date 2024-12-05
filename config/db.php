<?php
$host = 'localhost';
$port = '5432';  
$user = 'postgres';  
$password = '12345';  
$dbname = 'web_linus';  

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
