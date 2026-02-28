<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Validate ID is a valid integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid FAQ ID.");
}

// Use prepared statement to fetch FAQ
$stmt = $conn->prepare("SELECT * FROM faqs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("FAQ not found.");
}

$faq = $result->fetch_assoc();
$stmt->close();

$error = '';
$success = '';

if (isset($_POST['update'])) {

  // CSRF validation
  if (
    !isset($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
  ) {
    die("CSRF validation failed.");
  }

  // Input validation
  $question = trim($_POST['question']);
  $answer = trim($_POST['answer']);
  
  if (empty($question)) {
    $error = "Question is required.";
  } elseif (strlen($question) > 1000) {
    $error = "Question is too long.";
  } elseif (empty($answer)) {
    $error = "Answer is required.";
  } elseif (strlen($answer) > 5000) {
    $error = "Answer is too long.";
  } else {
    // Cast to integers for safety
    $is_featured = intval($_POST['is_featured']);
    $status = intval($_POST['status']);
    
    // Use prepared statement for update
    $stmt = $conn->prepare("UPDATE faqs SET question = ?, answer = ?, is_featured = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $question, $answer, $is_featured, $status, $id);
    
    if ($stmt->execute()) {
      // Regenerate CSRF token after successful update
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      $success = "FAQ updated successfully!";
      
      // Refresh FAQ data
      $stmt = $conn->prepare("SELECT * FROM faqs WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $faq = $result->fetch_assoc();
      $stmt->close();
    } else {
      $error = "Error updating FAQ: " . $conn->error;
    }
  }
}
?>

<div class="admin-content">
  <h2>Edit FAQ</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  
  <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="admin-form validate-form">

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="form-group">
      <input type="text" name="question" value="<?= htmlspecialchars($faq['question']) ?>" data-validate="text10" required>
      <small class="error"></small>
    </div>

    <div class="form-group">
      <textarea name="answer" data-validate="text10" required><?= htmlspecialchars($faq['answer']) ?></textarea>
      <small class="error"></small>
    </div>


    <label>Featured</label>
    <select name="is_featured">
      <option value="0" <?= ($faq['is_featured'] == 0) ? 'selected' : '' ?>>No</option>
      <option value="1" <?= ($faq['is_featured'] == 1) ? 'selected' : '' ?>>Yes</option>
    </select>

    <label>Status</label>
    <select name="status">
      <option value="1" <?= ($faq['status'] == 1) ? 'selected' : '' ?>>Active</option>
      <option value="0" <?= ($faq['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
    </select>

    <button name="update">Update FAQ</button>
  </form>

  <script src="assets/js/form-validator.js"></script>
  <?php include 'includes/footer.php'; ?>
