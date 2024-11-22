<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: sign_in.php');
    exit;
}

$username = $_SESSION['username'];

try {
    $stmt = $conn->prepare("DELETE FROM driver_location WHERE driver_id IN (SELECT id FROM driver_bus WHERE username = :username)");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    session_destroy();

    header('Location: sign_in.php');
    exit;
} catch (PDOException $e) {
    echo "Kesalahan: " . $e->getMessage();
}
?>
?>