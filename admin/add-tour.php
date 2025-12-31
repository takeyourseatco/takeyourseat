<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if (isset($_POST['submit'])) {

    $title       = $_POST['title'];
    $duration    = $_POST['duration'];
    $price       = $_POST['price'];
    $overview    = $_POST['overview'];
    $highlights  = $_POST['highlights'];
    $itinerary   = $_POST['itinerary'];
    $includes    = $_POST['includes'];
    $excludes    = $_POST['excludes'];
    $status      = $_POST['status'];

    /* IMAGE UPLOAD */
    $banner = time() . '_' . $_FILES['banner']['name'];
    $banner_tmp = $_FILES['banner']['tmp_name'];
    move_uploaded_file($banner_tmp, "uploads/images/tours/" . $banner);

    /* PDF UPLOAD */
    $pdf = '';
    if (!empty($_FILES['pdf']['name'])) {
        $pdf = time() . '_' . $_FILES['pdf']['name'];
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        move_uploaded_file($pdf_tmp, "uploads/pdf/" . $pdf);
    }

    /* PREPARED STATEMENT */
    $stmt = $conn->prepare("
        INSERT INTO tours
        (title, duration, price, overview, highlights, itinerary, includes, excludes, banner_image, pdf_file, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssdsssssssi",
        $title,
        $duration,
        $price,
        $overview,
        $highlights,
        $itinerary,
        $includes,
        $excludes,
        $banner,
        $pdf,
        $status
    );

    if ($stmt->execute()) {
        echo "<script>alert('Tour Added Successfully'); window.location.href='manage-tours.php';</script>";
    } else {
        echo "<script>alert('Error Adding Tour');</script>";
    }

    $stmt->close();
}
?>

<div class="admin-content">
<h2>Add New Tour</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">

    <input type="text" name="title" placeholder="Tour Title" required>
    <input type="text" name="duration" placeholder="Duration (e.g. 7 Days)" required>
    <input type="number" step="0.01" name="price" placeholder="Price (e.g. 85000)" required>

    <textarea name="overview" placeholder="Trip Overview" required></textarea>
    <textarea name="highlights" placeholder="Trip Highlights (one per line)" required></textarea>
    <textarea name="itinerary" placeholder="Detailed Itinerary" required></textarea>
    <textarea name="includes" placeholder="Cost Includes" required></textarea>
    <textarea name="excludes" placeholder="Cost Excludes" required></textarea>

    <label>Banner Image *</label>
    <input type="file" name="banner" accept="image/*" required>

    <label>Trip PDF</label>
    <input type="file" name="pdf" accept="application/pdf">

    <label>Status</label>
    <select name="status" required>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <button name="submit">Add Tour</button>
</form>
</div>

<?php include 'includes/footer.php'; ?>
