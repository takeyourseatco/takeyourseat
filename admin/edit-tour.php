<?php
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include '../config/db.php';


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tours WHERE id=$id"));

$itineraries = mysqli_query(
    $conn,
    "SELECT * FROM tour_itineraries 
     WHERE tour_id = $id 
     ORDER BY day_number ASC"
);


if (isset($_POST['update'])) {

    $title      = $_POST['title'];
    $duration   = $_POST['duration'];
    $price      = $_POST['price'];
    $price_usd = $_POST['price_usd'];
    $overview   = $_POST['overview'];
    $highlights = $_POST['highlights'];
    $includes   = $_POST['includes'];
    $excludes   = $_POST['excludes'];
    $status     = $_POST['status'];
    $is_popular = $_POST['is_popular'];


    $image   = $data['banner_image'];
    $pdfName = $data['pdf_file'];

    /* IMAGE */
    if (!empty($_FILES['image']['name'])) {
        $image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/tours/".$image);
        @unlink("uploads/images/tours/".$data['banner_image']);
    }

    /* PDF */
    if (!empty($_FILES['pdf']['name'])) {
        $pdfName = time().'_'.$_FILES['pdf']['name'];
        move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/pdf/".$pdfName);
    }

    /* UPDATE TOUR */
    $stmt = $conn->prepare("
        UPDATE tours SET
          title = ?,
          duration = ?,
          price = ?,
          price_usd = ?,
          overview = ?,
          highlights = ?,
          includes = ?,
          excludes = ?,
          banner_image = ?,
          pdf_file = ?,
          is_popular = ?,
          status = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
      "sddssssssssii",
      $title,
      $duration,
      $price,
      $price_usd,
      $overview,
      $highlights,
      $includes,
      $excludes,
      $image,
      $pdfName,
      $is_popular,
      $status,
      $id
    );


    if ($stmt->execute()) {

        /* DELETE OLD ITINERARIES */
        $conn->query("DELETE FROM tour_itineraries WHERE tour_id = $id");

        /* INSERT UPDATED ITINERARIES */
        if (!empty($_POST['day_no'])) {

            $days   = $_POST['day_no'];
            $titles = $_POST['itinerary_title'];
            $descs  = $_POST['itinerary_desc'];

            $itStmt = $conn->prepare("
                INSERT INTO tour_itineraries (tour_id, day_number, title, description)
                VALUES (?, ?, ?, ?)
            ");

            for ($i = 0; $i < count($days); $i++) {
                $itStmt->bind_param(
                    "iiss",
                    $id,
                    $days[$i],
                    $titles[$i],
                    $descs[$i]
                );
                $itStmt->execute();
            }

            $itStmt->close();
        }

        header("Location: manage-tours");
        exit();
    }
}


?>

<div class="admin-content">
  <h2>Edit Tour</h2>

  <form method="POST" enctype="multipart/form-data" class="admin-form">

    <div class="form-group">
        <input type="text" name="title" id="title" placeholder="Tour Title" value="<?= $data['title'] ?>">
        <small class="error"></small>
    </div>

    <div class="form-group">
        <input type="text" name="duration" id="duration" placeholder="Duration (e.g. 7 Days)" value="<?= $data['duration'] ?>">
        <small class="error"></small>
    </div>

    <div class="form-group">
        <input type="number" step="0.01" name="price" id="price" placeholder="Price in NPR (e.g. 85000)" value="<?= $data['price'] ?>">
        <small class="error"></small>
    </div>

    <div class="form-group">
        <input type="number" step="0.01" name="price_usd" id="price_usd" placeholder="Price in USD (e.g. 799)" value="<?= $data['price_usd']; ?>">
        <small class="error"></small>
    </div>


    <div class="form-group">
        <textarea name="overview" id="overview" placeholder="Trip Overview"><?= $data['overview'] ?></textarea>
        <small class="error"></small>
    </div>

    <div class="form-group">
        <textarea name="highlights" id="highlights" placeholder="Trip Highlights (one per line)"><?= $data['highlights'] ?></textarea>
        <small class="error"></small>
    </div>

    <label>Edit Itinerary</label>
    <div id="itinerary-wrapper">
      <?php while ($row = mysqli_fetch_assoc($itineraries)): ?>
        <div class="itinerary-item">
          <div class="form-group">
                <input type="number" name="day_no[]" placeholder="Day 1" class="day-no" value="<?= $row['day_number'] ?>">
                <small class="error"></small>
            </div>

          <div class="form-group">
                <input type="text" name="itinerary_title[]" placeholder="Title" class="it-title" value="<?= htmlspecialchars($row['title']) ?>">
                <small class="error"></small>
            </div>

          <div class="form-group">
                <textarea name="itinerary_desc[]" placeholder="Description" class="it-desc"><?= htmlspecialchars($row['description']) ?></textarea>
                <small class="error"></small>
            </div>

          <button type="button" class="remove-itinerary">Remove</button>
        </div>
      <?php endwhile; ?>
    </div>
    <button type="button" class="additinerarybtn" onclick="addItinerary()">+ Add Day</button>

    <div class="form-group">
        <textarea name="includes" id="includes" placeholder="Cost Includes"><?= $data['includes'] ?></textarea>
        <small class="error"></small>
    </div>

    <div class="form-group">
        <textarea name="excludes" id="excludes" placeholder="Cost Excludes"><?= $data['excludes'] ?></textarea>
        <small class="error"></small>
    </div>

    <div class="file_input">
      <label>Current Image</label>
      <div class="current-image">
        <img src="uploads/images/tours/<?= $data['banner_image']; ?>" alt="Current Tour Image">
      </div>
    </div>

    <div class="file_input">
      <label>Change Image (optional)</label>
      <input type="file" name="image" accept="image/*">
    </div>

    <div class="file_input">
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
      </div>
    <div class="file_input">
      <label>Replace PDF (optional)</label>
      <input type="file" name="pdf" accept="application/pdf">
    </div>

    <label>Is Popular?</label>
    <select name="is_popular">
      <option value="0" <?= ($data['is_popular']==0)?'selected':'' ?>>No</option>
      <option value="1" <?= ($data['is_popular']==1)?'selected':'' ?>>Yes</option>
    </select>


    <label>Status</label>
    <select name="status">
      <option value="1" <?= ($data['status']==1)?'selected':'' ?>>Active</option>
      <option value="0" <?= ($data['status']==0)?'selected':'' ?>>Inactive</option>
    </select>

 

    <button type="submit" name="update">Update Tour</button>

  </form>
</div>

<script>
function addItinerary() {
  const wrapper = document.getElementById('itinerary-wrapper');

  const div = document.createElement('div');
  div.className = 'itinerary-item';

  div.innerHTML = `
    <div class="form-group">
            <input type="number" name="day_no[]" placeholder="Day 1" class="day-no">
            <small class="error"></small>
        </div>

        <div class="form-group">
            <input type="text" name="itinerary_title[]" placeholder="Title" class="it-title">
            <small class="error"></small>
        </div>

        <div class="form-group">
            <textarea name="itinerary_desc[]" placeholder="Description" class="it-desc"></textarea>
            <small class="error"></small>
        </div>

    <button type="button" class="remove-itinerary">Remove</button>
  `;

  wrapper.appendChild(div);
}

document.addEventListener('click', function(e){
  if(e.target.classList.contains('remove-itinerary')){
    e.target.parentElement.remove();
  }
});
</script>

<script src="assets/js/tour-validation.js"></script>
<script src="assets/js/itinerary-validation.js"></script>

<?php include 'includes/footer.php'; ?>
