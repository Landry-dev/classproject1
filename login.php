<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4 text-center">Login</h1>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <input type="submit" name="login" value="Login" class="btn btn-primary w-100">

                    <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p> 

                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include "conn.php";
session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM ShopKeeper WHERE UserName='$username' AND Password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}


?>