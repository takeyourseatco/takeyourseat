<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';


// DELETE TOUR
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  // $query = mysqli_query($conn, "SELECT image, pdf FROM tours WHERE id=$id");
  // $data = mysqli_fetch_assoc($query);

  // if($data){
  //   @unlink("assets/images/".$data['banner_image']);
  //   @unlink("assets/pdf/".$data['pdf_file']);
  // }

  mysqli_query($conn, "DELETE FROM gallery_photos WHERE id=$id");
  header("Location: manage-albums");
}
?>

<div class="admin-content">
  <div class="manage-photos-title-box">
    <h2>Manage Photos</h2>
    <a href="add-photos" class="btn-add-new">Add New Photos</a>
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>S.N.</th>
        <th>created Date</th>
        <!-- <th>Album ID</th> -->
        <th>Image</th>
        <th>Action</th>

      </tr>
    </thead>

    <tbody>
      <?php
      $i = 1;
      $result = mysqli_query($conn, "SELECT * FROM gallery_photos WHERE album_id = " . $_GET['id'] . " ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($result)){
      ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $row['created_at'] ?></td>
        <!-- <td><?= $row['album_id'] ?></td> -->

        <?php 
        $slug = $_GET['slug'];
        ?>
        <td>
          <img src="uploads/gallery/<?= $slug ?>/<?= $row['image'] ?>" height="50">
        </td>

          </td>
        <td class="action-col-flight">
          <!-- <a href="edit-flight.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a> -->
          <a href="?delete=<?= $row['id'] ?>"
            onclick="return confirm('Delete this Photo?')"
            class="btn-delete">
            Delete
          </a>
        </td>

      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>
