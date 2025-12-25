<?php include 'includes/header.php'; ?>

<!-- HEADER -->
<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; ?>

<!-- HERO SECTION -->
<section class="home-hero">
  <div class="hero-overlay">
    <div class="container">

      <!-- HERO SEARCH BAR -->
      <div class="hero-search">
        <form action="#" method="GET">
          <input type="text" id="tourSearch" name="tour" placeholder="Search tours">

          <!--
          <select name="duration">
            <option value="">Duration</option>
            <option value="3-5">3–5 Days</option>
            <option value="6-10">6–10 Days</option>
            <option value="10+">10+ Days</option>
          </select>
          -->

          <button type="submit" disabled>
            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
          </button>
        </form>
        <div id="searchResults" class="search-results"></div>
      </div>

      <h1 class="hero-lgt">LET'S GO TOGETHER</h1>

      <div class="view-btn">
        <a href="tours.php" class="btn-primary">View Tour Packages</a>
      </div>

    </div>
  </div>
</section>

<!-- SEARCH / INTRO SECTION -->
<section class="home-intro">
  <div class="container">
    <h1>Explore Our Latest and Popular Tour Packages</h1>
    <p>
      Take Your Seat offers carefully designed tour packages focusing on comfort,
      safety, and unforgettable travel experiences.
    </p>
  </div>
</section>

<!-- POPULAR TOURS -->
<section class="home-tours">
  <div class="container">

    <div class="tour-grid">
      <?php
      $query = mysqli_query(
        $conn,
        "SELECT id, title, duration, banner_image
         FROM tours
         ORDER BY id DESC
         LIMIT 3"
      );

      while ($tour = mysqli_fetch_assoc($query)) {
      ?>
        <div class="tour-card">
          <img
            src="admin/uploads/images/tours/<?= $tour['banner_image']; ?>"
            alt="<?= htmlspecialchars($tour['title']); ?>"
          >

          <div class="tour-info">
            <h3><?= htmlspecialchars($tour['title']); ?></h3>
            <p><?= htmlspecialchars($tour['duration']); ?></p>

            <a
              href="tour-details.php?id=<?= $tour['id']; ?>"
              class="btn-primary"
            >
              View Details
            </a>
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- EXPLORE MORE BUTTON -->
    <div class="center-btn">
      <a href="tours.php" class="btn-primary-em">Explore More</a>
    </div>

  </div>
</section>

<!-- INTERNATIONAL FLIGHTS -->
<section class="home-flights">
  <div class="container">
    <h2 class="section-title-flight">International Flight Booking</h2>
    <p class="section-subtitle">
      Best airfare deals with professional ticketing assistance
    </p>

    <div class="flight-grid">

      <?php
      $flights = mysqli_query($conn, 
        "SELECT * FROM flights WHERE status = 1 ORDER BY id DESC LIMIT 3"
      );

      while($flight = mysqli_fetch_assoc($flights)){
      ?>
        <div class="flight-card">
          <img src="admin/uploads/images/flights/<?= $flight['image']; ?>" 
               alt="<?= $flight['from_city'].' to '.$flight['to_city']; ?>">

          <div class="flight-info">
            <h3>
              <?= htmlspecialchars($flight['from_city']); ?> →
              <?= htmlspecialchars($flight['to_city']); ?>
            </h3>

            <!-- Optional Description -->
            <!-- <p><?= htmlspecialchars($flight['description']); ?></p> -->

            <!-- Price -->
            <!-- <?php if($flight['price']){ ?>
              <p><strong>From:</strong> <?= $flight['price']; ?></p>
            <?php } ?> -->

            <!-- Details Page -->
            <a href="flight-details.php?id=<?= $flight['id']; ?>" 
               class="btn-primary">
              View Details
            </a>
          </div>
        </div>
      <?php } ?>
      
    </div>

    <!-- CTA -->
    <a href="flights.php" class="btn-primary-flight">
       More
    </a>
  </div>
</section>

