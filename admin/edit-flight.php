<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM flights WHERE id=$id"));

if (isset($_POST['update'])) {

  if (
    !isset($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
  ) {
    die("CSRF validation failed.");
  }

  $from_city = $_POST['from_city'];
  $to_city = $_POST['to_city'];
  $description = $_POST['description'];
  $image = $data['image'];
  $group_fare = $_POST['group_fare'];
  $status = $_POST['status'];


  if (!empty($_FILES['image']['name'])) {
    $newImage = time() . $_FILES['image']['name'];
    move_uploaded_file(
      $_FILES['image']['tmp_name'],
      "uploads/images/flights/" . $newImage
    );

    // delete old image
    @unlink("uploads/images/flights/" . $data['image']);
    $image = $newImage;
  }

  mysqli_query($conn, "
    UPDATE flights SET
    from_city='$from_city',
    to_city='$to_city',
    description='$description',
    image='$image',
    is_group_fare='$group_fare',
    status='$status'
    WHERE id=$id
  ");

  header("Location: manage-flights");
}
?>

<div class="admin-content">
  <h2>Edit Flight Post</h2>

  <form method="POST" enctype="multipart/form-data" class="admin-form validate-form">

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="form-group">
      <input type="text" name="from_city" placeholder="From City" value="<?= $data['from_city'] ?>" data-validate="city">
      <small class="error"></small>
    </div>

    <div class="form-group">
      <input type="text" name="to_city" placeholder="To City" value="<?= $data['to_city'] ?>" data-validate="city">
      <small class="error"></small>
    </div>

    <!-- <input type="text" name="price" placeholder="Starting Price"> -->
    <div class="form-group">
      <textarea name="description" placeholder="Description" data-validate="text20"><?= $data['description'] ?></textarea>
      <small class="error"></small>
    </div>


    <label>Current Image</label>
    <div class="current-image">
      <img src="uploads/images/flights/<?= $data['image']; ?>" alt="Current Tour Image">
    </div>

    <div class="file_input">
      <label>Change Image (optional)</label>
      <input type="file" name="image" accept="image/*">
    </div>

    <label>Group Fare</label>
    <select name="group_fare">
      <option value="1" <?= ($data['is_group_fare'] == 1) ? 'selected' : '' ?>>Yes</option>
      <option value="0" <?= ($data['is_group_fare'] == 0) ? 'selected' : '' ?>>No</option>
    </select>

    <label>Status</label>
    <select name="status">
      <option value="1" <?= ($data['status'] == 1) ? 'selected' : '' ?>>Active</option>
      <option value="0" <?= ($data['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
    </select>

    <button type="submit" name="update">Update Post</button>
  </form>
</div>

<script src="assets/js/form-validator.js"></script>
<?php include 'includes/footer.php'; ?>