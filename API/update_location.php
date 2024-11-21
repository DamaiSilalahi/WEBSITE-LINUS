<?php
require '../config/db.php';


$query = "
    SELECT c.latitude, c.longitude, br.sequence 
    FROM bus_route br
    JOIN coordinates c ON br.coordinate_id = c.id
    ORDER BY br.sequence ASC
";


$stmt = $conn->prepare($query);
$stmt->execute();


$route = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $route[] = $row;
}


header('Content-Type: application/json');


echo json_encode($route);
?>