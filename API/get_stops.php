<?php
require '../config/db.php';

$query = "SELECT name, latitude, longitude FROM bus_stops";
$result = $conn->query($query);

$stops = [];

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc())
    {
        $stops[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($stops);
?>