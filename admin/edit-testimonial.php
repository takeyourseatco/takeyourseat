<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

$id = (int)$_GET['id'];
$data = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT * FROM testimonials WHERE id=$id")
);

if(isset($_POST['update'])){

  $name    = $_POST['name'];
  $service = $_POST['service'];
  $review  = $_POST['review'];
  $rating  = (int)$_POST['rating'];
  $status  = (int)$_POST['status'];

  $stmt = $conn->prepare("
    UPDATE testimonials SET
      name = ?,
      service = ?,
      review = ?,
      rating = ?,
      status = ?
    WHERE id = ?
  ");

  $stmt->bind_param(
    "sssiii",
    $name,
    $service,
    $review,
    $rating,
    $status,
    $id
  );

  if($stmt->execute()){
    header("Location: manage-testimonials");
    exit();
  } else {
    echo "<script>alert('Update failed');</script>";
  }
}
?>

<div class="admin-content">
  <h2>Edit Testimonial</h2>

  <form method="POST" class="admin-form">

    <input type="text" name="name"
      value="<?= $data['name'] ?>"
      placeholder="Client Name" required>

    <input type="text" name="service"
      value="<?= $data['service'] ?>"
      placeholder="Service (e.g. Tour Package – Nepal)" required>

    <textarea name="review" required
      placeholder="Client Review"><?= $data['review'] ?></textarea>

    <label>Rating</label>
    <select name="rating">
      <?php for($i=5;$i>=1;$i--): ?>
        <option value="<?= $i ?>"
          <?= ($data['rating']==$i)?'selected':'' ?>>
          <?= $i ?> ★
        </option>
      <?php endfor; ?>
    </select>

    <label>Status</label>
    <select name="status">
      <option value="1" <?= $data['status']==1?'selected':'' ?>>Active</option>
      <option value="0" <?= $data['status']==0?'selected':'' ?>>Inactive</option>
    </select>

    <button name="update">Update Testimonial</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
