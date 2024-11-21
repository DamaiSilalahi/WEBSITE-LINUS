<?php
require '../config/db.php';

$query = "
SELECT bs.name, c.latitude, c.longitude FROM bus_stop bs JOIN coordinates c ON bs.coordinate_id = c.id
";

$stmt = $conn->prepare($query);
$stmt->execute();

$stops = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $stops[] = $row;
}

header('Content-Type: application/json');

echo json_encode($stops);
?>