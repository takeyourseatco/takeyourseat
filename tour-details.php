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

    </aside>

</section>

<?php include 'includes/footer.php'; ?>
