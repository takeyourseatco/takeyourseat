<?php
session_start();
include '../config/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' AND password='$password'");

  if(mysqli_num_rows($query) == 1){
      $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin'] = $admin['username'];
        header("Location: dashboard.php");
        exit();
    } else {
      $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>

  <link rel="stylesheet" href="assets/admin.css">
</head>
<body class="login-body">

<form method="POST" class="login-box">
  <h2>Admin Login</h2>

  <?php if($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>

  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button name="login">Login</button>
</form>

</body>
</html>

    
