<?php
include '../config/db.php';
include 'auth.php';
include 'includes/header.php';
include 'includes/sidebar.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {

    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("CSRF validation failed.");
    }

    $name   = $_POST['name'];
    $status = $_POST['status'];

    $logo = time() . '_' . $_FILES['logo']['name'];
    move_uploaded_file(
        $_FILES['logo']['tmp_name'],
        "uploads/images/clients/" . $logo
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

    <form method="POST" enctype="multipart/form-data" class="admin-form validate-form">

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="form-group">
            <input type="text" name="name" placeholder="Client Name" data-validate="name">
            <small class="error"></small>
        </div>

        <div class="file_input">
            <label>Client Logo</label>
            <input type="file" name="logo" accept="image/*" required>
        </div>

        <select name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>

        <button type="submit" name="submit">Add Client</button>
    </form>

    <script src="assets/js/form-validator.js"></script>
    <?php include 'includes/footer.php'; ?>