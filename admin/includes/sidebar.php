
<aside class="admin-sidebar">
  <h2>TYS Admin</h2>

<?php if (isset($_SESSION['admin'])) { ?>
  <ul class="sidebar-menu">
    <li>
      <a href="dashboard.php">Dashboard</a>
    </li>

    <!-- TOURS DROPDOWN -->
    <li class="has-submenu">
      <a href="">Tours ▾</a>
      <ul class="submenu">
        <li><a href="add-tour.php">Add Tour</a></li>
        <li><a href="manage-tours.php">Manage Tours</a></li>
      </ul>
    </li>

    

    <li class="has-submenu">
      <a href="">Flights ▾</a>
      <ul class="submenu">
        <li><a href="add-flight-post.php">Add Flight</a></li>
        <li><a href="manage-flights.php">Manage Flights</a></li>
      </ul>
    </li>

    <li class="has-submenu">
      <a href="">Gallery ▾</a>
      <ul class="submenu">
        <li><a href="add-album.php">Add Album</a></li>
        <li><a href="add-photos.php">Add Photos</a></li>
        <li><a href="manage-albums.php">Manage</a></li>
      </ul>
    </li>

    <li>
      <a href="inquiries.php">Inquiries</a>
    </li>

    <li>
      <a href="logout.php">Logout</a>
    </li>
  </ul>
  <?php } else { ?>
    <ul class="sidebar-menu">
    <li>
      <a href="dashboard.php">Dashboard</a>
    </li>

    <!-- TOURS DROPDOWN -->
    <li class="has-submenu">
      <a href="">Tours ▾</a>
      <ul class="submenu">
        <li><a href="add-tour.php">Add Tour</a></li>
        <li><a href="manage-tours.php">Manage Tours</a></li>
      </ul>
    </li>

    <li>
      <a href="inquiries.php">Inquiries</a>
    </li>

  </ul>
  <?php } ?>
</aside>

