<?php include 'includes/header.php'; ?>
<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; ?>

<!-- HERO -->
<!-- <section class="page-hero">
  <div class="overlay">
    <div class="container">
      <h1>Flight Bookings</h1>
      <p>Explore our international flight routes</p>
    </div>
  </div>
</section> -->

<section class="page-banner">
  <div class="overlay">
    <h1>Flight Bookings</h1>
    <p>Explore our international flight routes with best airfare deals with professional assistance</p>
  </div>
</section>

<!-- FLIGHTS LIST -->
<section class="home-flights">
  <div class="container">

    <h2 class="section-title-flight">Available Flights</h2>
    <!-- <p class="section-subtitle">
      Best airfare deals with professional assistance
    </p> -->

    <div class="flight-grid">

      <?php
      $query = mysqli_query(
        $conn,
        "SELECT * FROM flights WHERE status = 1 ORDER BY id DESC"
      );

      if (mysqli_num_rows($query) > 0) {
        while ($flight = mysqli_fetch_assoc($query)) {
      ?>
          <div class="flight-card">
            <div class="flight-card-img">

              <?php if ($flight['is_group_fare'] == 1): ?>
                <span class="group-fare-badge">
                  <i class="fa-solid fa-users"></i> Group Fare
                </span>
              <?php endif; ?>

              <img src="admin/uploads/images/flights/<?= $flight['image']; ?>" alt="<?= htmlspecialchars($flight['from_city'] . ' to ' . $flight['to_city']); ?>">

            </div>

            <div class="flight-info">
              <!-- <h3><?= htmlspecialchars($flight['title']); ?></h3> -->
              <!-- <p><?= htmlspecialchars($flight['route']); ?></p> -->
              <h3>
                <?= htmlspecialchars($flight['from_city']); ?> →
                <?= htmlspecialchars($flight['to_city']); ?>
              </h3>

              <a href="flight-details?id=<?= $flight['id']; ?>" class="btn-primary">
                View Details
              </a>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p style='text-align:center;'>No flights available at the moment.</p>";
      }
      ?>

    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>