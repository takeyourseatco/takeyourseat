<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';

$id = $_GET['id'];
$faq = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT * FROM faqs WHERE id=$id")
);

if(isset($_POST['update'])){
  $q = mysqli_real_escape_string($conn, $_POST['question']);
  $a = mysqli_real_escape_string($conn, $_POST['answer']);
  $f = $_POST['is_featured'];
  $s = $_POST['status'];

  mysqli_query($conn,
    "UPDATE faqs SET
     question='$q', answer='$a', is_featured='$f', status='$s'
     WHERE id=$id"
  );
  header("Location: manage-faqs");
}
?>

<div class="admin-content">
  <h2>Edit FAQ</h2>

  <form method="POST" enctype="multipart/form-data" class="admin-form validate-form">
    
    <div class="form-group">
      <input type="text" name="question" value="<?= htmlspecialchars($faq['question']) ?>" data-validate="text10">
      <small class="error"></small>
    </div>

    <div class="form-group">
      <textarea name="answer" data-validate="text10"><?= htmlspecialchars($faq['answer']) ?></textarea>
      <small class="error"></small>
    </div>

    
    <label>Featured</label>
    <select name="is_featured">
      <option value="0" <?= ($faq['is_featured']==0)?'selected':'' ?>>No</option>
      <option value="1" <?= ($faq['is_featured']==1)?'selected':'' ?>>Yes</option>
    </select>

    <label>Status</label>
    <select name="status">
        <option value="1" <?= $faq['status'] ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= !$faq['status'] ? 'selected' : '' ?>>Inactive</option>
    </select>

    <button name="update">Update FAQ</button>
</form>

<script src="assets/js/form-validator.js"></script>
<?php include 'includes/footer.php'; ?>
