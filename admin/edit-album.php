<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT * FROM gallery_albums WHERE id=$id")
);

$oldSlug = $data['slug'];

if (isset($_POST['update'])) {

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $newSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
  $cover = $data['cover_image'];
  $status = (int)$_POST['status'];

  $oldPath = "uploads/gallery/" . $oldSlug;
  $newPath = "uploads/gallery/" . $newSlug;

  /* -----------------------------
     RENAME FOLDER IF SLUG CHANGED
  ------------------------------*/
  if ($oldSlug !== $newSlug) {

    // Rename folder only if old exists
    if (is_dir($oldPath)) {
      rename($oldPath, $newPath);
    } else {
      mkdir($newPath, 0777, true);
    }
  }

  /* -----------------------------
     HANDLE COVER IMAGE UPDATE
  ------------------------------*/
  if (!empty($_FILES['cover']['name'])) {

    $newCover = time() . '_' . $_FILES['cover']['name'];

    move_uploaded_file(
      $_FILES['cover']['tmp_name'],
      $newPath . '/' . $newCover
    );

    // delete old cover image
    if (!empty($data['cover_image']) && file_exists($newPath . '/' . $data['cover_image'])) {
      unlink($newPath . '/' . $data['cover_image']);
    }

    $cover = $newCover;
  }

  /* -----------------------------
     UPDATE DATABASE
  ------------------------------*/
  mysqli_query($conn, "
    UPDATE gallery_albums SET
      title='$title',
      slug='$newSlug',
      cover_image='$cover',
      status=$status
    WHERE id=$id
  ");

  header("Location: manage-albums");
  exit;
}
?>


<div class="admin-content">
  <h2>Edit Album</h2>

  <form method="POST" enctype="multipart/form-data" class="admin-form">

    <input type="text" name="title" value="<?= $data['title'] ?>" required>

    <label>Current Cover Image</label>
    <div class="current-image">
      <img src="uploads/gallery/<?= $data['slug'] ?>/<?= $data['cover_image'] ?>">
    </div>

    <input type="file" name="cover" accept="image/*">

    <label>Status</label>
    <select name="status">
      <option value="1" <?= ($data['status']==1)?'selected':'' ?>>Active</option>
      <option value="0" <?= ($data['status']==0)?'selected':'' ?>>Inactive</option>
    </select>

    <button type="submit" name="update">Update Album</button>
  </form>
</div>


<?php include 'includes/footer.php'; ?>
