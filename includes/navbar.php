<nav class="main-navbar">
  <div class="container nav-wrapper">

    <!-- LOGO -->
    <a href="/TakeYourSeat/index.php" class="logo">
      <!-- <img src="/TakeYourSeat/assets/images/TakeyourSeat_Logo-Color.png"> -->
    </a>

    <!-- MENU -->
    <ul class="nav-menu" id="navMenu">
      <li><a href="index.php">Home</a></li>
      <li><a href="tours.php">Tours</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="about.php">About Us</a></li>
    </ul>

    <!-- HAMBURGER -->
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="tours.php">Tours</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About Us</a></li>
      </ul>
    </div>

  </div>
</nav>

<script>
  const hamburger = document.getElementById("hamburger");
  const mobileMenu = document.getElementById("mobileMenu");

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    mobileMenu.classList.toggle("active");
  });
</script>