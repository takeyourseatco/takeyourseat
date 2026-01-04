<?php include 'includes/header.php'; ?>
<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; ?>

<!-- HERO -->
<section class="page-hero">
  <div class="overlay">
    <div class="container">
      <h1>Flight Bookings</h1>
      <p>Explore our international flight routes</p>
    </div>
  </div>
</section>

<!-- FLIGHTS LIST -->
<section class="home-flights">
  <div class="container">

    <h2 class="section-title-flight">Available Flights</h2>
    <p class="section-subtitle">
      Best airfare deals with professional assistance
    </p>

    <div class="flight-grid">

      <?php
      $query = mysqli_query(
        $conn,
        "SELECT * FROM flights ORDER BY id DESC"
      );

      if(mysqli_num_rows($query) > 0){
        while($flight = mysqli_fetch_assoc($query)){
      ?>
          <div class="flight-card">
            <img src="admin/uploads/images/flights/<?= $flight['image']; ?>" alt="">

            <div class="flight-info">
              <!-- <h3><?= htmlspecialchars($flight['title']); ?></h3> -->
              <!-- <p><?= htmlspecialchars($flight['route']); ?></p> -->
               <h3>
                <?= htmlspecialchars($flight['from_city']); ?> →
                <?= htmlspecialchars($flight['to_city']); ?>
                </h3>

              <a href="flight-details.php?id=<?= $flight['id']; ?>" class="btn-primary">
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
