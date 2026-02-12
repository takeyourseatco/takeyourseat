<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if (isset($_POST['submit'])) {

    $name    = $_POST['name'];
    $service = $_POST['service'];
    $review  = $_POST['review'];
    $rating  = $_POST['rating'];
    $status  = $_POST['status'];

    $stmt = $conn->prepare("
        INSERT INTO testimonials (name, service, review, rating, status)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sssii", $name, $service, $review, $rating, $status);

    if ($stmt->execute()) {
        header("Location: manage-testimonials");
        exit();
    }
}

?>


<div class="admin-content">
<h2>Add Testimonial</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <input type="text" name="name" placeholder="Client Name" required>
    <input type="text" name="service" placeholder="Service (Tour / Flight / Visa)">
    
    <textarea name="review" placeholder="Client Review" required></textarea>

    <label>Rating</label>
    <select name="rating" class="rating">
        <option value="5">★★★★★</option>
        <option value="4">★★★★</option>
        <option value="3">★★★</option>
        <option value="2">★★</option>
        <option value="1">★</option>
    </select>

    <label>Status</label>
    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <button type="submit" name="submit">Add Testimonial</button>
</form>
