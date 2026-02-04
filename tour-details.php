<?php
include 'config/db.php';

$id = $_GET['id'];
$tour = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT * FROM tours WHERE id=$id")
);

if (isset($_POST['send_inquiry'])) {

  $tour_name = mysqli_real_escape_string($conn, $_POST['tour_name']);
  $name      = mysqli_real_escape_string($conn, $_POST['name']);
  $email     = mysqli_real_escape_string($conn, $_POST['email']);
  $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
  $message   = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO inquiries (tour_name, name, email, phone, message)
            VALUES ('$tour_name', '$name', '$email', '$phone', '$message')";

  if (mysqli_query($conn, $query)) {

    require_once 'includes/fcm.php';
    sendFCMToAdmins(
      $conn,
      "New Tour Inquiry",
      "New inquiry received for " . $tour_name
    );

    header("Location: tour-details?id=$id&success=1");
    exit;
  }
}
?>

<?php include 'includes/header.php'; ?>
<div class="header-wrapper">
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
</div>


<?php
function renderList($text) {
  $items = preg_split("/\r\n|\n|\r/", trim($text));
  echo "<ul>";
  foreach ($items as $item) {
    if (!empty(trim($item))) {
      echo "<li>" . htmlspecialchars($item) . "</li>";
    }
  }
  echo "</ul>";
}
?>


<!-- BANNER -->
<section class="tour-banner"
  style="background-image: url('admin/uploads/images/tours/<?= $tour['banner_image'] ?>');">
  
  <div class="overlay">
    <div class="container">

      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="success-box" id="successBox">
          <strong>Success!</strong>
          <p>Your inquiry has been sent successfully. We’ll contact you soon.</p>
        </div>
      <?php endif; ?>

      <h1><?= $tour['title'] ?></h1>
      <p><?= $tour['duration'] ?> Days</p>

      <?php if ($tour['is_popular'] == 1): ?>
        <span class="popular-badge-detail"><i class="fa-solid fa-fire"></i> Popular</span>
      <?php endif; ?>

    </div>
  </div>


</section>


<!-- MAIN CONTENT -->
<section class="container tour-layout">

  <div class="tour-content">

    <h2 class="trip-overview">Trip Overview</h2>
    <p>
      <?= $tour['overview'] ?>
    </p>

    <h2>Trip Highlights</h2>
    <ul class="tour-highlights">
      <?php renderList($tour['highlights']); ?>
    </ul>

    <h2>Detailed Itinerary</h2>

    <div class="itinerary-list">
    <?php
    $itinerary = mysqli_query(
      $conn,
      "SELECT * FROM tour_itineraries
      WHERE tour_id = $id
      ORDER BY day_number ASC"
    );

    while ($day = mysqli_fetch_assoc($itinerary)) {
    ?>
      <div class="itinerary-day">
        <h3>Day <?= $day['day_number']; ?>: <?= htmlspecialchars($day['title']); ?></h3>
        <p><?= nl2br(htmlspecialchars($day['description'])); ?></p>
      </div>
    <?php } ?>
    </div>


    <h2>Cost Includes</h2>
    <ul>
      <?php renderList($tour['includes']); ?>
    </ul>

    <h2>Cost Excludes</h2>
    <ul>
      <?php renderList($tour['excludes']); ?>
    </ul>

  </div>

<div class="tour-sidebar">

  <div class="price-box sidebar-price">
    <h3>Trip Cost</h3>
    <p><strong>From:</strong> NPR <?= $tour['price'] ?> | USD $<?= $tour['price_usd'] ?></p>
  </div>

  <div class="download-box sidebar-download">
    <h3>Trip Brochure</h3>
    <p>Download the full itinerary and trip details.</p>

    <a href="download-pdf?file=<?= urlencode($tour['pdf_file']); ?>" class="download-btn">
      <i class="fas fa-file-pdf"></i> Download PDF
    </a>
  </div>

    <div class="inquiry-box">
      <h3>Trip Inquiry</h3>

      <?php if(isset($success)): ?>
        <p class="success"><?= $success ?></p>
      <?php endif; ?>

      <form method="POST">
        <input type="hidden" name="tour_name" value="<?= $tour['title']; ?>">

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone">

        <textarea name="message" placeholder="Your Message" required></textarea>

        <button type="submit" name="send_inquiry">Send Inquiry</button>
      </form>
    </div>


  </aside>

</section>

<?php include 'includes/footer.php'; ?>
