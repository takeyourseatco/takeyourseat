<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if (isset($_POST['submit'])) {

    $from   = $_POST['from_city'];
    $to     = $_POST['to_city'];
    $desc   = $_POST['description'];
    $group_fare  = $_POST['group_fare'];
    $status = $_POST['status'];

    /* IMAGE UPLOAD */
    $imageName = null;

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "uploads/images/flights/" . $imageName
        );
    }

    /* PREPARED STATEMENT */
    $stmt = $conn->prepare(
        "INSERT INTO flights 
        (from_city, to_city, description, image, is_group_fare, status) 
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssii",
        $from,
        $to,
        $desc,
        $imageName,
        $group_fare,
        $status
    );

    if ($stmt->execute()) {
        header("Location: manage-flights");
        exit();
    } else {
        echo "<script>alert('Error adding flight');</script>";
    }

    $stmt->close();
}
?>

<div class="admin-content">
    <h2>Add New Flight Post</h2>

    <form method="POST" enctype="multipart/form-data" class="admin-form">

        <input type="text" name="from_city" placeholder="From City" required>
        <input type="text" name="to_city" placeholder="To City" required>

        <!-- <input type="text" name="price" placeholder="Starting Price"> -->

        <textarea name="description" placeholder="Description"></textarea>

        <label>Flight Image</label>
        <input type="file" name="image" accept="image/*" required>

        <label>Group Fare</label>
        <select name="group_fare" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label>Status</label>
        <select name="status" required>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit" name="submit">Add Flight</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
