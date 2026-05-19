<!-- BANNER -->
<section class="tour-banner"
    style="background-image: url('admin/uploads/images/tours/<?= $tour['banner_image'] ?>');">

    <div class="overlay">
        <div class="container">

            <?php if (isset($_GET['success']) && $_GET['success'] === 'sent'): ?>
                <div class="success-box" id="successBox">
                    <strong>Success!</strong>
                    <?php
                    if ($_GET['success'] === 'sent') echo "Your inquiry has been sent successfully. We’ll contact you soon.";
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="error-box package" id="errorBox">
                    <strong>Error!</strong>
                    <?php
                    if ($_GET['error'] === 'required') echo "Please fill in all required fields.";

                    ?>
                </div>
            <?php endif; ?>

            <h1><?= $tour['title'] ?></h1>
            <p><?= $tour['duration'] ?></p>

            <?php if ($tour['is_popular'] == 1): ?>
                <span class="popular-badge-detail"><i class="fa-solid fa-fire"></i> Popular</span>
            <?php endif; ?>

        </div>
    </div>
</section>

<section class="page-banner">
    <div class="overlay">
        <h1>Book This Package</h1>
        <p>Fill in the details below to book your trip.</p>
    </div>
</section>

<div class="booking-container">
    <div class="booking-form">

        <form method="POST" novalidate>

            <input type="hidden" name="package_id" value="<?php echo $tour['id']; ?>">

            <div class="form-group">
                <input type="date" name="travel_date" id="travel_date">
                <small class="error"></small>
            </div>

            <div class="form-group">
                <input type="number" name="persons" placeholder="Number of People" min="1" id="persons">
                <small class="error"></small>
            </div>

            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" id="name"
                    value="<?php echo $_SESSION['user_name'] ?? ''; ?>">
                <small class="error"></small>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" id="email"
                    value="<?php echo $_SESSION['user_email'] ?? ''; ?>">
                <small class="error"></small>
            </div>

            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone" id="phone"
                    value="<?php echo $_SESSION['user_phone'] ?? ''; ?>">
                <small class="error"></small>
            </div>

            <button type="submit" class="booking-btn" name="book">Proceed to Payment</button>

        </form>
    </div>
</div>

<script src="assets/js/auth-validation.js"></script>
<script src="assets/js/success-errorBox.js"></script>

<?php include 'includes/footer.php'; ?>