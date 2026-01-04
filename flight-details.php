<?php include 'includes/header.php'; ?>

<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php
include 'config/db.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM flights WHERE id = $id");
$flight = mysqli_fetch_assoc($query);

if (!$flight) {
  echo "<p>Flight not found.</p>";
  exit;
}
?>

<section class="page-banner">
  <div class="overlay">
    <h1>International Flight Booking</h1>
  </div>
</section>

<section class="flight-details-section">
  <div class="container flight-details-grid">

    <div class="flight-image">
    </div>

    <div class="flight-details">
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
