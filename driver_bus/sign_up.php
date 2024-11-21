<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plate_number = $_POST['plate_number'];
    $username = $_POST['username']; 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql_check = "SELECT id FROM driver_bus WHERE email = :email OR username = :username";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_check->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        $error = "Email atau Username sudah terdaftar!";
    } else {
        $stmt = $conn->prepare("INSERT INTO driver_bus (email, username, password) VALUES (:email, :username, :password)");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header('Location: sign_in.php');
        exit;
    } else {
        $error = "Terjadi kesalahan saat mendaftar!";
    }
}
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Driver Bus</title>
</head>
<body>
<div class="overlay"></div>
    <div class="signin">
    <div class="content">
    <h1>Daftar Driver Bus</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" class="signin-form">
            <div class="inputBox">
                <input type="text" name="username" required>
                <i>Username</i>
            </div>    
            <div class="inputBox">
                <input type="text" name="email" required>
                <i>Email</i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required>
                <i>Password</i>
            </div>
        <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="sign_in.php">Sign In di sini</a></p>
        </div>
    </div>
</body>
</html>