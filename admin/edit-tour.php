<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tours WHERE id=$id"));

if (isset($_POST['update'])) {

  $title      = $_POST['title'];
  $duration   = $_POST['duration'];
  $price      = $_POST['price'];
  $overview   = $_POST['overview'];
  $highlights = $_POST['highlights'];
  $itinerary  = $_POST['itinerary'];
  $includes   = $_POST['includes'];
  $excludes   = $_POST['excludes'];
  $status     = $_POST['status'];

  $image   = $data['banner_image'];
  $pdfName = $data['pdf_file'];

  /* IMAGE UPLOAD */
  if (!empty($_FILES['image']['name'])) {
    $image = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/tours/" . $image);
    @unlink("uploads/images/tours/" . $data['banner_image']);
  }

  /* PDF UPLOAD */
  if (!empty($_FILES['pdf']['name'])) {
    $pdfName = time() . '_' . $_FILES['pdf']['name'];
    move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/pdf/" . $pdfName);
  }

  /* PREPARED STATEMENT */
  $stmt = $conn->prepare("
    UPDATE tours SET
      title = ?,
      duration = ?,
      price = ?,
      overview = ?,
      highlights = ?,
      itinerary = ?,
      includes = ?,
      excludes = ?,
      banner_image = ?,
      pdf_file = ?,
      status = ?
    WHERE id = ?
  ");

  $stmt->bind_param(
    "ssssssssssii",
    $title,
    $duration,
    $price,
    $overview,
    $highlights,
    $itinerary,
    $includes,
    $excludes,
    $image,
    $pdfName,
    $status,
    $id
  );

  if ($stmt->execute()) {
    header("Location: manage-tours.php");
    exit();
  } else {
    echo "<script>alert('Update failed');</script>";
  }
}

?>

<div class="admin-content">
  <h2>Edit Tour</h2>

  <form method="POST" enctype="multipart/form-data" class="admin-form">

    <input type="text" name="title" placeholder="Tour Title" value="<?= $data['title'] ?>" required>
    <input type="text" name="duration" placeholder="Duration (e.g. 7 Days)" value="<?= $data['duration'] ?>" required>
    <input type="text" name="price" placeholder="Price (e.g. NPR 85,000)" value="<?= $data['price'] ?>" required>

    <textarea name="overview" placeholder="Trip Overview" required><?= $data['overview'] ?></textarea>
    <textarea name="highlights" placeholder="Trip Highlights (one per line)" required><?= $data['highlights'] ?></textarea>
    <textarea name="itinerary" placeholder="Detailed Itinerary" required><?= $data['itinerary'] ?></textarea>
    <textarea name="includes" placeholder="Cost Includes" required><?= $data['includes'] ?></textarea>
    <textarea name="excludes" placeholder="Cost Excludes" required><?= $data['excludes'] ?></textarea>

    <label>Current Image</label>
    <div class="current-image">
      <img src="uploads/images/tours/<?= $data['banner_image']; ?>" alt="Current Tour Image">
    </div>

    <label>Change Image (optional)</label>
    <input type="file" name="image" accept="image/*">

    <label>Trip PDF</label>
     <?php if(!empty($data['pdf_file'])): ?>
        <a href="uploads/pdf/<?php echo $data['pdf_file']; ?>" 
          target="_blank"
          class="btn-secondary">
            View Current PDF
        </a>
        <p><?php echo $data['pdf_file']; ?></p>
      <?php else: ?>
        <p>No PDF uploaded</p>
      <?php endif; ?>

    <label>Replace PDF (optional)</label>
    <input type="file" name="pdf" accept="application/pdf">

    <label>Status</label>
    <select name="status">
      <option value="1" <?= ($data['status']==1)?'selected':'' ?>>Active</option>
      <option value="0" <?= ($data['status']==0)?'selected':'' ?>>Inactive</option>
    </select>

 

    <button type="submit" name="update">Update Tour</button>

  </form>
</div>

<?php include 'includes/footer.php'; ?>
