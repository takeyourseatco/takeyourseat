<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if(isset($_POST['create_album'])){
  $title = $_POST['title'];
  $slug  = strtolower(str_replace(' ', '-', $title));

  $folder = "uploads/gallery/$slug";
  if(!is_dir($folder)){
    mkdir($folder, 0777, true);
  }

  $cover = $_FILES['cover']['name'];
  move_uploaded_file($_FILES['cover']['tmp_name'], "$folder/$cover");

  mysqli_query($conn, "INSERT INTO gallery_albums (title, slug, cover_image)
    VALUES ('$title', '$slug', '$cover')");

  header("Location: manage-albums");
}
?>

<div class="admin-content">

    <h2>Add Album</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">
  <input type="text" name="title" placeholder="Album Title" required>
  <input type="file" name="cover" accept="image/*" required>
  <button type="submit" name="create_album">Create Album</button>

</form>
</div>
