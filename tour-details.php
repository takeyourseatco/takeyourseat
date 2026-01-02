<?php include 'includes/header.php'; ?>

<div class="header-wrapper">
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/navbar.php'; ?>
</div>

<?php
include 'config/db.php';

$id = $_GET['id'];
$tour = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM tours WHERE id=$id")
);

if (isset($_POST['send_inquiry'])) {
    $tour_name = mysqli_real_escape_string($conn, $_POST['tour_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO inquiries (tour_name, name, email, phone, message)
              VALUES ('$tour_name', '$name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $query)) {
        $success = "Thank you! Your inquiry has been sent.";
    }
}
?>

<section class="tour-banner"
    style="background-image: url('admin/uploads/images/tours/<?= $tour['banner_image'] ?>');">

    <div class="overlay">
        <div class="container">
            <h1><?= $tour['title'] ?></h1>
            <p><?= $tour['duration'] ?> Days</p>
        </div>
    </div>
</section>

<section class="container tour-layout">

    <div class="tour-content">

        <h2>Trip Overview</h2>
        <p><?= $tour['overview'] ?></p>

        <h2>Trip Highlights</h2>
        <ul><?= $tour['highlights'] ?></ul>

        <h2>Detailed Itinerary</h2>
        <p><?= $tour['itinerary'] ?></p>

        <h2>Cost Includes</h2>
        <ul><li><?= $tour['includes'] ?></li></ul>

        <h2>Cost Excludes</h2>
        <ul><li><?= $tour['excludes'] ?></li></ul>

    </div>

    <aside class="tour-sidebar">

        <div class="download-box">
            <h3>Trip Brochure</h3>
            <a href="admin/uploads/pdf/<?= $tour['pdf_file'] ?>" target="_blank">
                Download PDF
            </a>
        </div>

        <div class="price-box">
            <h3>Trip Cost</h3>
            <p>From: NPR <?= $tour['price'] ?></p>
        </div>

        <div class="inquiry-box">
            <h3>Trip Inquiry</h3>

            <?php if (isset($success)): ?>
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
