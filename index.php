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

<!-- POPULAR TOURS -->
<section class="home-tours">
  <div class="container">

    <h2 class="section-title">Explore Our Latest and Popular Packages</h2>
    <p class="section-subtitle">Take Your Seat offers carefully designed packages focusing on comfort, safety, and unforgettable travel experiences.</p>


    <!-- SLIDER WRAPPER -->
    <div class="tour-slider-wrapper">

      <!-- LEFT BUTTON -->
      <button class="slider-btn prev" onclick="slideTours(-1)">
        <i class="fas fa-chevron-left"></i>
      </button>

      <!-- SLIDER -->
      <div class="tour-slider" id="tourSlider">
        <?php
        $query = mysqli_query(
          $conn,
          "SELECT * FROM tours WHERE status = 1 ORDER BY id DESC"
        );

        while ($tour = mysqli_fetch_assoc($query)) {
        ?>
          <div class="tour-card">
            <img src="admin/uploads/images/tours/<?= $tour['banner_image']; ?>" alt="<?= htmlspecialchars($tour['title']); ?>">

            <div class="tour-info">
              <h3><?= htmlspecialchars($tour['title']); ?></h3>
              <p>NPR <?= htmlspecialchars($tour['price']); ?></p>
            </div>

            <div class="tour-card-btn">
              <a href="tour-details.php?id=<?= $tour['id']; ?>">View Details</a>
            </div>
          </div>
        <?php } ?>
      </div>

      <!-- RIGHT BUTTON -->
      <button class="slider-btn next" onclick="slideTours(1)">
        <i class="fas fa-chevron-right"></i>
      </button>

    </div>

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

<!-- SERVICES -->
<section class="services">
  <div class="container">

    <h2 class="section-title">Our Services</h2>

    <div class="services-grid">

      <div class="service-card">
        <span>🏔️</span>
        <h3>Tour Packages</h3>
        <p>Domestic & international tour packages tailored for you.</p>
        <!-- <a href="/tours" class="service-link">Explore Tours</a> -->
      </div>

      <div class="service-card">
        <span>✈️</span>
        <h3>Flight Ticketing</h3>
        <p>International & domestic flight booking assistance.</p>
        <!-- <a href="/pages/contact.php" class="service-link">Contact Us</a> -->
      </div>

      <div class="service-card">
        <span>🛂</span>
        <h3>Visa Services</h3>
        <p>Professional visa consultation & documentation support.</p>
        <!-- <a href="/pages/contact.php" class="service-link">Contact Us</a> -->
      </div>

      <div class="service-card">
        <span>🚌</span>
        <h3>Bus Ticketing</h3>
        <p>Easy bus ticketing for domestic destinations.</p>
        <!-- <a href="/pages/contact.php" class="service-link">Contact Us</a> -->
      </div>

      <div class="service-card">
        <span>🥾</span>
        <h3>Himalayan Trekking</h3>
        <p>Everest, Annapurna & Langtang trekking adventures.</p>
        <!-- <a href="/pages/contact.php" class="service-link">Inquire Now</a> -->
      </div>

      <div class="service-card">
        <span>🏕️</span>
        <h3>Camping & Equipment</h3>
        <p>Camping trips and rental of quality camping gear.</p>
      </div>

      <div class="service-card">
        <span>🧗</span>
        <h3>Adventure Activities</h3>
        <p>Rafting, paragliding, jungle safari & more.</p>
        <!-- <a href="/pages/contact.php" class="service-link">Contact Us</a> -->
      </div>

    </div>
  </div>
</section>

<!-- CLIENT STATISTICS -->
<section class="stats-section">
  <div class="container">

    <h2 class="section-title">Our Achievements</h2>
    <p class="section-subtitle">Numbers that reflect our journey</p>

    <div class="stats-grid">

      <div class="stat-box">
        <h3 class="counter" data-target="5000">0</h3>
        <p>Happy Clients</p>
      </div>

      <div class="stat-box">
        <h3 class="counter" data-target="1500">0</h3>
        <p>Flights Issued</p>
      </div>

      <div class="stat-box">
        <h3 class="counter" data-target="1200">0</h3>
        <p>Tour Packages</p>
      </div>

      <div class="stat-box">
        <h3 class="counter" data-target="20">0</h3>
        <p>Visas Issued</p>
      </div>

      <div class="stat-box">
        <h3 class="counter" data-target="500">0</h3>
        <p>Bus Tickets Issued</p>
      </div>

    </div>
  </div>
</section>

<!-- AIRLINE PARTNERS -->
<section class="airline-partners">
  <h2 class="section-title">Our Airline Partners</h2>
  <p class="section-subtitle">Numbers that reflect our journey</p>

  <div class="marquee">
    <div class="marquee-track">
      <img src="assets/images/airlines/qatar.png" alt="">
      <img src="assets/images/airlines/emirates.png" alt="">
      <img src="assets/images/airlines/nepalairlines.png" alt="">
      <img src="assets/images/airlines/flydubai.png" alt="">
      <img src="assets/images/airlines/airindia.png" alt="">
      <img src="assets/images/airlines/turkish.png" alt="">
      <img src="assets/images/airlines/airasia.png" alt="">
      <img src="assets/images/airlines/indigo.png" alt="">
      <img src="assets/images/airlines/thaiairways.png" alt="">


      <!-- duplicate -->
      <img src="assets/images/airlines/qatar.png" alt="">
      <img src="assets/images/airlines/emirates.png" alt="">
      <img src="assets/images/airlines/nepalairlines.png" alt="">
      <img src="assets/images/airlines/flydubai.png" alt="">
      <img src="assets/images/airlines/airindia.png" alt="">
      <img src="assets/images/airlines/turkish.png" alt="">
      <img src="assets/images/airlines/airasia.png" alt="">
      <img src="assets/images/airlines/indigo.png" alt="">
      <img src="assets/images/airlines/thaiairways.png" alt="">
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials">
  <div class="container">

    <h2 class="section-title">What Our Clients Say</h2>
    <p class="section-subtitle">
      Real experiences from travelers who trusted Take Your Seat
    </p>

    <div class="testimonial-slider-wrapper">

      <button class="slider-btn prev" onclick="slideTestimonial(-1)" id="testimonialprevBtn">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="testimonial-viewport">
        <div class="testimonial-track" id="testimonialTrack">

          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="review">Amazing service! Our Nepal tour was perfectly organized.</p>
            <h4>Rahul Sharma</h4>
            <span>Tour Package – Nepal</span>
          </div>

          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="review">Very professional flight booking service.</p>
            <h4>Sunita Karki</h4>
            <span>Flight Ticketing</span>
          </div>

          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="review">Visa process was smooth and well guided.</p>
            <h4>Ajay Singh</h4>
            <span>Visa Service</span>
          </div>

          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="review">Best travel company in Nepal. Highly recommended.</p>
            <h4>Ramesh Adhikari</h4>
            <span>Tour & Flights</span>
          </div>

          <div class="testimonial-card">
            <div class="stars">★★★★★</div>
            <p class="review">Quick response and friendly support team.</p>
            <h4>Pooja Shrestha</h4>
            <span>Visa & Flights</span>
          </div>

        </div>
      </div>

      <button class="slider-btn next" onclick="slideTestimonial(1)" id="testimonialnextBtn">
        <i class="fas fa-chevron-right"></i>
      </button>

    </div>

  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="why-us">
  <div class="container">

    <h2 class="section-title white">Why Choose Take Your Seat?</h2>

    <div class="why-grid">

      <div class="why-box">
        <span class="why-icon">🌍</span>
        <h3>Local Expertise</h3>
        <p>Experienced team with deep local knowledge.</p>
      </div>

      <div class="why-box">
        <span class="why-icon">💰</span>
        <h3>Affordable Pricing</h3>
        <p>Best value packages without compromising quality.</p>
      </div>

      <div class="why-box">
        <span class="why-icon">⭐</span>
        <h3>Trusted Service</h3>
        <p>Customer satisfaction and safety first.</p>
      </div>

      <div class="why-box">
        <span class="why-icon">📞</span>
        <h3>24/7 Support</h3>
        <p>We are always available for our travelers.</p>
      </div>

    </div>
  </div>
</section>

<!-- DESTINATIONS -->
<!-- <section class="destinations">
  <div class="container">

    <h2 class="section-title">Top Destinations</h2>

    <div class="destination-grid">
      <div class="destination-card">Nepal</div>
      <div class="destination-card">India</div>
      <div class="destination-card">Dubai</div>
      <div class="destination-card">Thailand</div>
    </div>

  </div>
</section> -->


<!-- HAPPY CLIENTS -->
<section class="happy-clients">
  <h2 class="section-title">Our Happy Clients</h2>
  <p class="section-subtitle">Numbers that reflect our journey</p>

  <div class="client-marquee">
    <div class="client-marquee-track">
      <!-- Client logos -->
      <img src="admin/uploads/images/clients/balkumari.jpg" alt="Client 1">
      <img src="admin/uploads/images/clients/boston.png" alt="Client 2">
      <img src="admin/uploads/images/clients/cmt.png" alt="Client 3">
      <img src="admin/uploads/images/clients/doko-namlo.jpeg" alt="Client 4">

      <!-- duplicate for seamless loop -->
      <img src="admin/uploads/images/clients/balkumari.jpg" alt="Client 1">
      <img src="admin/uploads/images/clients/boston.png" alt="Client 2">
      <img src="admin/uploads/images/clients/cmt.png" alt="Client 3">
      <img src="admin/uploads/images/clients/doko-namlo.jpeg" alt="Client 4">
    </div>
  </div>
</section>

<!-- CTA -->
<section class="home-cta">
  <div class="cta-overlay">
    <div class="container">
      <h2>Ready to Plan Your Trip?</h2>
      <p>Let us help you create unforgettable travel experiences.</p>
      <a href="contact.php" class="btn-primary">Contact Us Now</a>
    </div>
  </div>
</section>

<script src="assets/js/search-tours.js"></script>
<script src="assets/js/tour-slider.js"></script>
<script src="assets/js/statistics.js"></script>
<script src="assets/js/airlines-slider.js"></script>
<script src="assets/js/clients-slider.js"></script>
<script src="assets/js/clients-slider.js"></script>
<script src="assets/js/testimonial-slider.js"></script>

<?php include 'includes/footer.php'; ?>

