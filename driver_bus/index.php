<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: sign_in.php');
    exit;
}

// Ambil plat nomor dari session
$plate_number = $_SESSION['plate_number'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Driver</title>
    <script>
        const ws = new WebSocket('ws://localhost:8080/bus-location');

        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const data = JSON.stringify({
                        plate_number: "<?php echo $plate_number; ?>",
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    });

                    ws.send(data);  // Kirim koordinat via WebSocket
                });
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        // Kirim lokasi setiap 10 detik
        setInterval(updateLocation, 10000);
    </script>

    </head>
<body>
    <h1>Selamat Datang, <?php echo htmlspecialchars($plate_number); ?></h1>
    <p>Lokasi Anda akan diperbarui secara otomatis setiap 10 detik.</p>
    <a href="sign_out.php">Sign Out</a>
</body>
</html>