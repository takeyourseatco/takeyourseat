<?php include 'includes/header.php'; ?>

<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; ?>

<section class="page-banner">
  <div class="overlay">
    <h1>Our Packages</h1>
    <p>Explore Nepal & beyond with Take Your Seat</p>
  </div>
</section>

<section class="container tour-list">

  <?php
  $result = mysqli_query($conn, "SELECT * FROM tours WHERE status = 1 ORDER BY id DESC");
  while ($row = mysqli_fetch_assoc($result)) {
  ?>
    <div class="tour-row">

      <div class="tour-img">
        <?php if ($row['is_popular'] == 1) { ?>
          <span class="popular-badge"><i class="fa-solid fa-fire"></i> Popular</span>
        <?php } ?>

        <img src="admin/uploads/images/tours/<?= $row['banner_image'] ?>"
          alt="<?= $row['title'] ?>">
      </div>

      <div class="tour-details">

        <h3><?= $row['title'] ?></h3>
        <p class="duration"><?= $row['duration'] ?> Days</p>
        <p class="desc">
          Experience the best of Nepal with this carefully designed tour package.
        </p>

        <span class="price">From: <span class="price-num"> NPR <?= $row['price'] ?> | USD $<?= $row['price_usd'] ?></span></span>

        <a href="tour-details?id=<?= $row['id'] ?>" class="btn">
          View Details
        </a>
      </div>

    </div>
  <?php } ?>

</section>


<?php include 'includes/footer.php'; ?>