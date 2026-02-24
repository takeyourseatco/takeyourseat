<?php include 'includes/header.php'; ?>

<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<?php include 'config/db.php'; 
  $type = $_GET['type'] ?? '';
?>

<section class="page-banner">
  <div class="overlay">
    <?php if ($type) : ?>
      <h1>Our <?php echo ucfirst($type); ?> Packages</h1>
    <?php else : ?>
      <h1>Our All Packages</h1>
    <?php endif; ?>
    <p>Explore Nepal & beyond with Take Your Seat</p>
  </div>
</section>

<section class="container tour-list">

  <?php
    
    $sql = "SELECT * FROM tours WHERE status = 1";

    if ($type) {
        $sql .= " AND type = ?";
        $sql .= " ORDER BY id DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $type);
    } else {
        $sql .= " ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

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

        <?php if (!$type && in_array($row['type'], ['domestic','international'])): ?>
          <span class="type-badge">
              <i class="fa-solid 
              <?= $row['type'] === 'domestic' ? 'fa-house' : 'fa-earth-americas' ?>"></i>
              <?= ucfirst($row['type']) ?>
          </span>
        <?php endif; ?>

        <h3><?= $row['title'] ?></h3>
        <p class="duration"><?= $row['duration'] ?></p>
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