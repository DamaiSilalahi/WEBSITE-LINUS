<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['loggedin'])) {
    http_response_code(403); 
    exit;
}

$plat_nomor = $_SESSION['plat_nomor']; 
$username = $_SESSION['username']; 
$lat = $_POST['lat']; 
$lng = $_POST['lng']; 

try {
    $query = "UPDATE driver_location 
              SET latitude = :lat, longitude = :lng 
              WHERE bus_id IN (SELECT id FROM bus WHERE plat_nomor = :plat_nomor)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':lat', $lat, PDO::PARAM_STR);
    $stmt->bindParam(':lng', $lng, PDO::PARAM_STR);
    $stmt->bindParam(':plat_nomor', $plat_nomor, PDO::PARAM_STR); 

    if ($stmt->execute()) {
        $response = array(
            'plat_nomor' => $plat_nomor,
            'lat' => $lat,
            'lng' => $lng,
            'username' => $username
        );
        echo json_encode($response);
    } else {
        echo "Error updating location.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>