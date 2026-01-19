<?php include 'includes/header.php'; ?>
<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; ?>

<!-- HERO -->
<!-- <section class="page-hero services-hero">
  <div class="overlay">
    <div class="container">
      <h1>Our Services</h1>
      <p>Complete travel solutions under one roof</p>
    </div>
  </div>
</section> -->

<section class="page-banner">
  <div class="overlay">
    <h1>Our Services</h1>
    <p>Complete travel solutions under one roof</p>
  </div>
</section>

<!-- SERVICES OVERVIEW -->
<section class="services-overview">
  <div class="container">
    <h2 class="section-title-wwo">What We Offer</h2>

    <div class="services-grid">

      <div class="service-card">
        <span>🛫</span>
        <h3>Flight Ticketing</h3>
        <p>International & domestic flight booking assistance.</p>
      </div>

      <div class="service-card">
        <span>🗺️</span>
        <h3>Tour Packages</h3>
        <p>Domestic & international tour packages tailored for you.</p>
      </div>

      <div class="service-card">
        <span>⛰️</span>
        <h3>Trek Packages</h3>
        <p>Everest, Annapurna & many more trekking adventures.</p>
      </div>

      <div class="service-card">
        <span>📄</span>
        <h3>Visa Services</h3>
        <p>Professional visa consultation & documentation support.</p>
      </div>

      <div class="service-card">
        <span>🚍</span>
        <h3>Bus Ticketing</h3>
        <p>Easy bus ticketing for domestic & international destinations.</p>
      </div>

      <div class="service-card">
        <span>🏕️</span>
        <h3>Camping & Equipments</h3>
        <p>Camping trips and rental of quality camping gear.</p>
      </div>

      <div class="service-card">
        <span>🧗</span>
        <h3>Adventure Activities</h3>
        <p>Bungee Jumping, Rafting, paragliding & more.</p>
      </div>

      <div class="service-card">
        <span>🦌</span>
        <h3>Wildlife Activities</h3>
        <p>Jungle safari, wildlife tours & nature experiences.</p>
      </div>

    </div>
  </div>
</section>

<!-- DETAILED SERVICES (ZIG-ZAG DESIGN) -->
<section class="service-details">
  <div class="container">

    <div class="service-row ">
      <div class="service-image">
        <img src="assets/images/services/london.jpg" alt="Flight Booking">
      </div>
      <div class="service-content">
        <h3>🛫 International Flight Booking</h3>
        <p>
          Professional air ticketing services with best fare options
          and flexible travel planning.
        </p>
      </div>
    </div>

    <div class="service-row reverse">
      <div class="service-image">
        <img src="assets/images/services/tours.jpg" alt="Tour Packages">
      </div>
      <div class="service-content">
        <h3>🗺️ Tour Packages</h3>
        <p>
          Domestic and international tour packages designed for comfort,
          adventure, and unforgettable experiences.
        </p>
      </div>
    </div>

    <div class="service-row">
      <div class="service-image">
        <img src="assets/images/services/trekking.jpg" alt="Himalayan Trekking">
      </div>
      <div class="service-content">
        <h3>⛰️ Trek Packages</h3>
        <p>
          Guided trekking adventures to Everest, Annapurna,
          Langtang and more.
        </p>
      </div>
    </div>
  
    <div class="service-row reverse">
      <div class="service-image">
        <img src="assets/images/services/visa.jpg" alt="Visa Services">
      </div>
      <div class="service-content">
        <h3>📄 Visa Services</h3>
        <p>
          Complete visa assistance including documentation,
          application, and interview preparation.
        </p>
      </div>
    </div>

    <div class="service-row">
      <div class="service-image">
        <img src="assets/images/services/bus.jpg" alt="Bus Ticketing">
      </div>
      <div class="service-content">
        <h3>🚍 Bus Ticketing</h3>
        <p>
          Easy and reliable bus ticketing services across
          major destinations in Nepal and internationally.
        </p>
      </div>
    </div>

    <div class="service-row reverse">
      <div class="service-image">
        <img src="assets/images/services/camping.jpg" alt="Adventure Activities">
      </div>
      <div class="service-content">
        <h3>🏕️ Camping & Equipments</h3>
        <p>
          Camping trips and rental of quality camping gear.
        </p>
      </div>
    </div>

    <div class="service-row ">
      <div class="service-image">
        <img src="assets/images/services/adventure.jpg" alt="Adventure Activities">
      </div>
      <div class="service-content">
        <h3>🧗 Adventure Activities</h3>
        <p>
          Thrilling adventure experiences including bungee jumping, rafting,
          paragliding & more.
        </p>
      </div>
    </div>

    <div class="service-row reverse">
      <div class="service-image">
        <img src="assets/images/services/wildlife.jpg" alt="Adventure Activities">
      </div>
      <div class="service-content">
        <h3>🦌 Wildlife Activities</h3>
        <p>
          Jungle safari, wildlife tours & nature experiences.
        </p>
      </div>
    </div>

  </div>
</section>


<!-- CTA -->
<section class="service-cta">
  <div class="container">
    <h2>Need Help Planning Your Trip?</h2>
    <p>Our team is ready to assist you with personalized travel solutions.</p>
    <a href="contact.php" class="btn-primary">Contact Us</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>