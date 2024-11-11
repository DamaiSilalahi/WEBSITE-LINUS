<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['loggedin'])){
    http_response_code(403);
    exit;
}

$plate_number = $_SESSION['plate_number'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$stmt = $conn->prepare("UPDATE drivers SET latitude = ?, longitude = ? WHERE plate_number = ?");
$stmt->bind_param("dds", $lat, $lng, $plate_number);
$stmt->execute();
$stmt->close();
?>