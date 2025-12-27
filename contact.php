<?php include 'includes/header.php'; ?>
<div class="header-wrapper">
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
</div>

<?php
include 'config/db.php';

if(isset($_POST['send'])){
  $name    = mysqli_real_escape_string($conn, $_POST['name']);
  $email   = mysqli_real_escape_string($conn, $_POST['email']);
  $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO inquiries (name, email, phone, message)
            VALUES ('$name', '$email', '$phone', '$message')";

  if(mysqli_query($conn, $query)){
    $success = "Message sent successfully!";
  }
}
?>


<section class="contact-hero">
  <div class="overlay">
    <div class="container">
      <h1>Contact Us</h1>
      <p>We’re here to help you plan your perfect journey</p>
    </div>
  </div>
</section>

<section class="contact-section">
  <div class="container contact-flex">

<div class="contact-left">
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p>
        Feel free to contact <strong>Take Your Seat</strong> for tour inquiries,
        bookings, or any travel-related questions.
      </p>

      <ul>
        <li><strong><i class="fa-solid fa-location-dot"></i> Address:</strong> Bharatpur-1, Chitwan, Nepal</li>
        <li><strong><i class="fa-solid fa-phone"></i> Telephone:</strong> 056-12345</li>
        <li><strong><i class="fa-solid fa-phone"></i> Phone / <i class="fa-brands fa-square-whatsapp"></i> Whatsapp:</strong> +977-9764667165</li>
        <li><strong><i class="fa-solid fa-envelope"></i> Email:</strong> takeyourseat18@gmail.com</li>
        <li><strong><i class="fa-solid fa-clock"></i> Working Hours:</strong> Sun–Fri | 10:00 AM – 5:00 PM</li>
      </ul>
    </div>




        <h2 class="map-title">Find Us on Map</h2>

        <div class="map-box">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d514.1725170795428!2d84.42609521821994!3d27.69352602815289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994fbc2ee459c9d%3A0x448dfca49a2caaa1!2sTake%20Your%20Seat%20Tours%20and%20Travels%20Pvt%20Ltd!5e0!3m2!1sen!2snp!4v1766342489448!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

</div>

<div class="contact-left">
        <div class="contact-social">
          <h3>Follow Us</h3>
          <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=61577350722166" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/takeyourseat__tours/" target="_blank"aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@takeyourseat_tours" target="_blank" aria-label="YouTube"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://wa.me/9779865507624" target="_blank" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

    <!-- CONTACT FORM -->
    <div class="contact-form-box">
      <h2>Send Us a Message</h2>

      <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="phone" placeholder="Phone Number">
        <textarea name="message" placeholder="Your Message" required></textarea>

        <button type="submit" name="send">Send Message</button>
      </form>

      <?php
      if(isset($_POST['send'])){
        echo "<p class='success-msg'>Thank you! Your message has been sent.</p>";
      }
      ?>
    </div>
</div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
