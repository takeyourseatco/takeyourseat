<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if(isset($_POST['submit'])){
  $q = mysqli_real_escape_string($conn, $_POST['question']);
  $a = mysqli_real_escape_string($conn, $_POST['answer']);
  $f = $_POST['featured'];
  $s = $_POST['status'];

  mysqli_query($conn,
    "INSERT INTO faqs (question, answer, is_featured, status)
     VALUES ('$q','$a','$f','$s')"
  );
  header("Location: manage-faqs");
}
?>

<div class="admin-content">
<h2>Add FAQ</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">

    <input type="text" name="question" placeholder="Question" required>
    <textarea name="answer" placeholder="Answer" required></textarea>

    <label>Featured</label>
    <select name="featured" required>
        <option value="0">No</option>
        <option value="1">Yes</option>
    </select>
    
    <label>Status</label>
    <select name="status" required>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <button name="submit">Add FAQ</button>
</form>

<?php include 'includes/footer.php'; ?>
