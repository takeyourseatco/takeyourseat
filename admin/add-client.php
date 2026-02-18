<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if (isset($_POST['submit'])) {

    $name   = $_POST['name'];
    $status = $_POST['status'];

    $logo = time().'_'.$_FILES['logo']['name'];
    move_uploaded_file(
        $_FILES['logo']['tmp_name'],
        "uploads/images/clients/".$logo
    );

    $stmt = $conn->prepare("
        INSERT INTO clients (name, logo, status)
        VALUES (?, ?, ?)
    ");
    $stmt->bind_param("ssi", $name, $logo, $status);
    $stmt->execute();

    header("Location: manage-clients");
    exit();
}


?>

<div class="admin-content">
<h2>Add Client</h2>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <input type="text" name="name" placeholder="Client Name" required>

    <label>Client Logo</label>
    <input type="file" name="logo" accept="image/*" required>

    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <button type="submit" name="submit">Add Client</button>
</form>
