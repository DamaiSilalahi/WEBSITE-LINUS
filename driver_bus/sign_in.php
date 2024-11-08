<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plate_number = $_POST['plate_number'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(query: "SELECT password FROM drivers WHERE plate_number = ?");
    $stmt->bind_param("s", $plate_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_row > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify(password: $password, hash: $hashed_password)) {
            $_SESSION['plate_number'] = $plate_number;
            $_SESSION['loggedin'] = true;
            header(header: 'Location: index.php');
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Plat nomor tidak ditemukan!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Sign In Driver Bus</title>
</head>
<body>
    <h1>Sign In Driver Bus</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post">
        <label>Plat Nomor:</label>
        <input type="text" name="plate_number" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Sign In</button>
    </form>
</body>
</html>