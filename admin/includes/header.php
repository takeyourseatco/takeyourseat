
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TYS Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ADMIN CSS -->
  <link rel="stylesheet" href="/TakeYourSeat/admin/assets/css/admin.css">
</head>
<body>

<!-- TOP HEADER -->

<header class="admin-header">
  <div class="admin-header-inner">
    <h2></h2>

    <div class="admin-user">
      <!-- <span>Admin</span> -->
      <?php if (isset($_SESSION['admin'])) { ?>
        <a href="logout.php">Logout</a>
      <?php } ?>
      
    </div>
  </div>
</header>
