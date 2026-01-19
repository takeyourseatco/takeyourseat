<footer class="site-footer">
  <div class="container footer-grid">

    <!-- ABOUT -->
    <div class="footer-box">
      <div class="footer-box-logo">
        <a href="index.php" class="logo">
          <img src="assets/images/logo/Take your Seat Logo- White.png" alt="Take Your Seat Logo">
          <!-- <div class="footer-lgt">
            <p>"LET'S GO TOGETHER"</p>
          </div> -->
        </a>
      </div>
    </div>

    <!-- QUICK LINKS -->
    <div class="footer-box">
      <h3>Quick Links</h3>
      <ul>
        <!-- <li><a href="index.php">Home</a></li> -->
        <li><a href="tours.php">Tour Packages</a></li>
        <li><a href="services.php">Our Services</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="about.php">About Us</a></li>
      </ul>
    </div>

    <!-- TOURS -->
    <div class="footer-box">
      <h3>Popular Tours</h3>
      <ul>
        <?php
        $tourQuery = mysqli_query(
          $conn,
          "SELECT id, title 
            FROM tours 
            WHERE status = 1 AND is_popular = 1 
            ORDER BY id DESC 
            LIMIT 5"
        );

        while ($tour = mysqli_fetch_assoc($tourQuery)) {
        ?>
          <li>
            <a href="tour-details.php?id=<?= $tour['id']; ?>">
              <?= htmlspecialchars($tour['title']); ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>


    <!-- CONTACT -->
    <div class="footer-box">
      <h3>Contact Info</h3>
      <div class="footer-contacts">
        <p><i class="fa-solid fa-location-dot"></i> Bharatpur-1, Chitwan, Nepal</p>
        <p><i class="fa-solid fa-phone"></i> +977-9764667165</p>
        <p><i class="fa-solid fa-envelope"></i> takeyourseat18@gmail.com</p>
      </div>
      <!-- SOCIAL ICONS -->
      <div class="footer-social">
        <a href="https://www.facebook.com/profile.php?id=61577350722166" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/takeyourseat__tours/" target="_blank"aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="https://www.tiktok.com/@takeyourseat_tours" target="_blank" aria-label="YouTube"><i class="fa-brands fa-tiktok"></i></a>
        <a href="https://wa.me/9779865507624" target="_blank" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>


  </div>

  <!-- COPYRIGHT -->
  <div class="footer-bottom">
    <p>© <?php echo date("Y"); ?> Take Your Seat. All Rights Reserved.</p>
  </div>
</footer>


</body>
</html>