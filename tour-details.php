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
        <!-- Tour content will be added here -->
    </div>

    <aside class="tour-sidebar">
        <!-- Sidebar content will be added here -->
    </aside>

</section>

<?php include 'includes/footer.php'; ?>
