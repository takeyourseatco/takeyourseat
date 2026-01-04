<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php
include 'includes/header.php';
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

    <!-- LEFT IMAGE -->
    <div class="flight-image">
      <img src="admin/uploads/images/flights/<?php echo $flight['image']; ?>" alt="">
    </div>

    <!-- RIGHT CONTENT -->
    <div class="flight-details">
      <!-- <h1><?php echo $flight['title']; ?></h1> -->

      <ul class="flight-info-list">
        <li><strong>From:</strong> <?php echo $flight['from_city']; ?></li>
        <li><strong>To:</strong> <?php echo $flight['to_city']; ?></li>
        <!-- <li><strong>Airline:</strong> <?php echo $flight['airline']; ?></li> -->
        <!-- <li><strong>Travel Date:</strong> <?php echo $flight['travel_date']; ?></li> -->
        <!-- <li><strong>Price:</strong> <?php echo $flight['price']; ?></li> -->
      </ul>

      <p class="flight-desc">
        <?php echo nl2br($flight['description']); ?>
      </p>

      <a href="contact.php" class="btn-primary">
        Contact for Booking
      </a>
    </div>

  </div>
</section>
<?php include 'includes/footer.php'; ?>
