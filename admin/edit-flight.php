<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM flights WHERE id=$id"));

if(isset($_POST['update'])){
  $from_city = $_POST['from_city'];
  $to_city = $_POST['to_city'];
  $description = $_POST['description'];
  $image = $data['image'];
  $group_fare = $_POST['group_fare'];
  $status = $_POST['status'];


  if(!empty($_FILES['image']['name'])){
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

  <form method="POST" enctype="multipart/form-data" class="admin-form">
        <input type="text" name="from_city" placeholder="From City" value="<?= $data['from_city'] ?>" required>
        <input type="text" name="to_city" placeholder="To City" value="<?= $data['to_city'] ?>" required>
        <!-- <input type="text" name="price" placeholder="Starting Price"> -->
        <textarea name="description" placeholder="Description"><?= $data['description'] ?></textarea>
        <label>Current Image</label> 
        <div class="current-image">
        <img src="uploads/images/flights/<?= $data['image']; ?>" alt="Current Tour Image">
        </div>

        <label>Change Image (optional)</label>
        <input type="file" name="image" accept="image/*">

        <label>Group Fare</label>
        <select name="group_fare">
          <option value="1" <?= ($data['is_group_fare']==1)?'selected':'' ?>>Yes</option>
          <option value="0" <?= ($data['is_group_fare']==0)?'selected':'' ?>>No</option>
        </select>

        <label>Status</label>
        <select name="status">
          <option value="1" <?= ($data['status']==1)?'selected':'' ?>>Active</option>
          <option value="0" <?= ($data['status']==0)?'selected':'' ?>>Inactive</option>
        </select>

        <button type="submit" name="update">Update Post</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
