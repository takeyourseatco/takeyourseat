<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$albums = mysqli_query($conn, "SELECT * FROM gallery_albums");

if(isset($_POST['upload'])){
  $album_id = $_POST['album'];

  $album = mysqli_fetch_assoc(mysqli_query(
    $conn, "SELECT slug FROM gallery_albums WHERE id=$album_id"
  ));

  $path = "uploads/gallery/".$album['slug']."/";

  foreach($_FILES['images']['name'] as $key => $img){
    move_uploaded_file($_FILES['images']['tmp_name'][$key], $path.$img);
    mysqli_query($conn, "INSERT INTO gallery_photos (album_id, image)
      VALUES ($album_id, '$img')");
  }
  header("Location: manage-photos?id=".$album_id."&slug=".$album['slug']);
}
?>

<div class="admin-content">

    <h2>Upload Photos</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">
  <select name="album" required>
    <?php while($a = mysqli_fetch_assoc($albums)){ ?>
      <option value="<?= $a['id'] ?>"><?= $a['title'] ?></option>
    <?php } ?>
  </select>

  <input type="file" name="images[]" multiple accept="image/*" required>
  <button type="submit" name="upload">Upload</button>
</form>
