<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plate_number = $_POST['plate_number'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO drivers (plate_number, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $plate_number, $password);

    if ($stmt->execute()) {
        header('Location: sign_in.php');
    } else {
        $eror = "Plat nomor sudah terdaftar!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Driver Bus</title>
</head>
<body>
    <h1>Daftar Driver Bus</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post">
        <label>Plat Nomor:</label>
        <input type="text" name="plate_number" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="sign_in.php">Sign In di sini</a></p>
</body>
</html>