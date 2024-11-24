<?php
require '../config/db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sign_up'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        try {
            $stmt = $conn->prepare("SELECT username FROM admin WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $message = "Username sudah digunakan.";
            } else {
                $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();
                
                $message = "Akun berhasil dibuat. Silakan <a href='sign_in.php'>Sign In</a>.";
            }
        } catch (PDOException $e) {
            $message = "Kesalahan: " . $e->getMessage();
        }
    } else {
        $message = "Harap isi semua kolom.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Admin</title>
    <link rel="stylesheet" href="adminsignin.css"></style>
</head>
<body>
    <div class="imagehalf"></div>
    <div class="formloginadmin">
    <h2>Sign Up</h2>
        <form method="POST" action="">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" name="sign_up" value="Sign Up">
        </form>

        <p><?php echo $message; ?></p>
    </div>
</body>
</html>
