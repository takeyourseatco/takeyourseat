
<?php
include 'includes/header.php';
include 'config/db.php';

if(!isset($_GET['album'])){
  header("Location: gallery.php");
  exit;
}

$slug = mysqli_real_escape_string($conn, $_GET['album']);

$album = mysqli_query($conn, "SELECT * FROM gallery_albums WHERE slug='$slug'");
$albumData = mysqli_fetch_assoc($album);

if(!$albumData){
  header("Location: gallery.php");
  exit;
}

$photos = mysqli_query($conn, "SELECT * FROM gallery_photos WHERE album_id='{$albumData['id']}'");
?>

<div class="header-wrapper">
  <?php include 'includes/topbar.php'; ?>
  <?php include 'includes/navbar.php'; ?>
</div>

<section class="page-hero" style="background-image: url('admin/uploads/gallery/<?php echo $slug; ?>/<?php echo $albumData['cover_image'] ?>');">
  <div class="overlay">
    <div class="container">
      <h1><?php echo $albumData['title']; ?></h1>
      <p>Album Photos</p>
    </div>
  </div>
</section>

<section class="gallery-section">
  <div class="container">
    <div class="photo-grid">

      <?php while($photo = mysqli_fetch_assoc($photos)){ ?>
        <div class="photo-card">
          <img src="admin/uploads/gallery/<?php echo $slug; ?>/<?php echo $photo['image']; ?>" alt="">
        </div>
      <?php } ?>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
