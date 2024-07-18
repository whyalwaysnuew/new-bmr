<?php 
    include "database/koneksi.php";

    session_start();

    if(isset($_SESSION['username'])){
        header("Location: /bmr-calculator");
        exit();
    }

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (name, username, password, is_admin)
            VALUES (
                '$name',
                '$username',
                '$password',
                0
            )";
        $result = mysqli_query($koneksi, $sql);

        echo "
            <script>
                alert('Berhasil Register!');
                document.location='login.php';
            </script>
        ";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/assets/media/icons/duotune/general/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/auth.css">
    <title>Login | BMR Calculator</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-form">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="e.g Gian Pranata" name="name" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
