<?php 
include 'includes/header.php'; 
include 'config/db.php';
?>

<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<section class="page-hero">
  <div class="overlay">
    <div class="container">
      <h1>Gallery</h1>
      <p>Explore our travel memories</p>
    </div>
  </div>
</section>

<section class="gallery-section">
  <div class="container">
    <div class="album-grid">

      <?php
      $albums = mysqli_query($conn, "SELECT * FROM gallery_albums ORDER BY created_at DESC");

      while($album = mysqli_fetch_assoc($albums)){
      ?>
        <a href="album.php?album=<?php echo $album['slug']; ?>" class="album-card">
          <img src="admin/uploads/gallery/<?php echo $album['slug']; ?>/<?php echo $album['cover_image']; ?>" alt="<?php echo $album['title']; ?>">
          <div class="album-overlay">
            <h3><?php echo $album['title']; ?></h3>
          </div>
        </a>
      <?php } ?>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
