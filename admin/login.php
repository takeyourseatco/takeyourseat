<?php
session_start();
include '../config/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $query = mysqli_query(
    $conn,
    "SELECT * FROM admins WHERE username='$username' LIMIT 1"
  );

  if (mysqli_num_rows($query) === 1) {

    $admin = mysqli_fetch_assoc($query);

    if (password_verify($password, $admin['password'])) {

      $_SESSION['admin'] = $admin['username'];
      header("Location: dashboard");
      exit;
    } else {
      $_SESSION['login_error'] = "Invalid username or password";
    }
  } else {
    $_SESSION['login_error'] = "Invalid username or password";
  }

  header("Location: login");
  exit;
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

    <?php
    $error = $_SESSION['login_error'] ?? '';
    unset($_SESSION['login_error']);
    ?>

    <?php if ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login">Login</button>
  </form>

</body>

</html>