<?php
session_start();
require '../config/db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT id FROM driver_bus WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $updatePassword = $conn->prepare("UPDATE driver_bus SET password = :password WHERE email = :email");
            $updatePassword->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $updatePassword->bindParam(':email', $email, PDO::PARAM_STR);
            $updatePassword->execute();

            header('Location: sign_in.php');
            exit;
        } else {
            $error = "Email tidak ditemukan!";
        }
    } else {
        $error = "Password dan konfirmasi password tidak cocok!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Ubah Password</title>
    <link rel="stylesheet" href="">
</head>
<body>
<div class="overlay"></div>
    <div class="signin">
        <div class="content">
            <h1>Ubah Password Driver Bus</h1>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <form method="post" class="signin-form">
                <div class="inputBox">
                    <input type="text" name="email" required>
                    <i>Email</i>
                </div>
                <div class="inputBox">
                    <input type="password" name="password" required>
                    <i>Password Baru</i>
                </div>
                <div class="inputBox">
                    <input type="password" name="confirm_password" required>
                    <i>Konfirmasi Password</i>
                </div>
                <div class="links">
                    <a href="sign_in.php">Kembali ke Halaman Login</a>
                </div>
                <button type="submit">Ubah Password</button>
            </form>
        </div>
    </div>
</body>
</html>
